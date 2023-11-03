<?php

namespace App\Infrastructure\User;

use App\Domain\Email;
use App\Domain\IdentifierCode;
use App\Domain\User\Customer;
use App\Domain\User\FinancialEntity;
use App\Domain\User\Shopkeeper;
use App\Domain\User\User;
use App\Domain\User\UserRepository;
use App\Domain\User\UserType;
use Pdo,PDOStatement;

class PdoUserRepository implements UserRepository
{
    private Pdo $pdo;

    public function __construct(Pdo $pdo)
    {
        $this->pdo = $pdo;
    }
    private function hydrateUserList(PDOStatement $statement): array{
        $statementData = $statement->fetchAll();
        $usersList = [];
        foreach ($statementData as $index => $user) {
            $id = $user['id'];
            if(!array_key_exists($id, $usersList)){
                $usersList[$id] = $this->hydrateUser($user);
            }
            if(isset($user['emailId'])){
                $email = Email::make($user['emailId'],$user['email'],(boolean) $user['login']);
                $usersList[$id]->setEmail($email);
            }
        }
        return array_values($usersList);
    }
    private function hydrateUser(array $data): User{
        $userType = new UserType($data['user_type']);
        $type = $userType->getName();
        $user = User::make($data['id'], $data['name'],[],$data['user_type']);
        if(!isset($data['cpf']) && !isset($data['cnpj'])){
            return $user;
        }
        if($type==='CUSTOMER'){
            $user->asCustomer($data['idCustomer'], $data['cpf'], $data['balanceCustomer']);
        }
        if($type==='SHOPKEEPER'){
            $user->asShopkeeper($data['idShopkeeper'], $data['cnpj'], $data['balanceShopkeeper']);
        }
        return $user;
    }
    private function hydrateFinancialEntityList(PDOStatement $statement): array{
        $statementData = $statement->fetchAll();
        $financialEntityList = [];
        foreach ($statementData as $index => $user) {
            $id = $user['id'];
            if(!array_key_exists($id, $financialEntityList)){
                $financialEntityList[$id] = $this->hydrateFinancialEntity($user);
            }
        }
        return array_values($financialEntityList);
    }
    private function hydrateFinancialEntity(array $data): FinancialEntity | null{
        $userType = new UserType($data['user_type']);
        $type = $userType->getName();
        $financialEntity = null;
        if($type==='CUSTOMER'){
            $financialEntity = Customer::make($data['idCustomer'], $data['cpf'], $data['balanceCustomer']);
        }
        if($type==='SHOPKEEPER'){
            $financialEntity = Shopkeeper::make($data['idShopkeeper'], $data['cnpj'], $data['balanceShopkeeper']);
        }

        return $financialEntity;
    }

    public function add(User $user): User
    {
        $datetime = date_create()->format('Y-m-d H:i:s');
        if($password = password_hash($user->getPassword(),PASSWORD_BCRYPT,['cost'=>10])){
            $statement  = $this->pdo
                ->prepare(
                "INSERT INTO users (user_type,name,password,created_at,updated_at )VALUES (:user_type,  :name, :password, :created_at, :updated_at )"
                );
            $statement->execute([
                ':user_type' => $user->getType()->getCode(),
                ':name' => $user->getName(),
                ':password' => $password,
                ':created_at' => $datetime,
                ':updated_at' => $datetime
            ]);
            $user->setId($this->pdo->lastInsertId());
            $this->addEmails($user);
            $type = $user->getType()->getName();
            if($type==='CUSTOMER'){
                $this->addAsCustomer($user);
            }
            if($type==='SHOPKEEPER'){
                $this->addAsShopkeeper($user);
            }
            return $user;
        }
        throw new \DomainException('Bad config algorithm');
    }
    private function addEmails(User $user): void{
        $datetime = date_create()->format('Y-m-d H:i:s');
        $userId = (string) $user->getId();
        $statement = $this->pdo->prepare(
            "INSERT INTO emails (email,login,user_id,created_at,updated_at)
                    VALUES (:email,:login,:userId,:datetime,:datetime)"
        );

        $statement->bindValue('userId', $userId);
        $statement->bindValue('datetime', $datetime);
        foreach ($user->getEmails() as $index => $email) {
            $statement->bindValue('email',(string) $email->email());
            $statement->bindValue('login',$email->isLogin());
            $statement->execute();
            $email->setId($this->pdo->lastInsertId());
        }
    }
    private function addAsCustomer(User $user): void{
        $datetime = date_create()->format('Y-m-d H:i:s');
        $financialEntity = $user->getFinancialEntity();
        $cpf = $financialEntity->getTaxpayer();
        $balance = $financialEntity->getAccount()->getBalance();
        $statement = $this->pdo->prepare(
            "INSERT INTO customers (cpf,balance,user_id,created_at,updated_at)
                    VALUES (:cpf,:balance,:user_id, :datetime,:datetime)"
        );
        $statement->bindValue('cpf',$cpf);
        $statement->bindValue('balance', $balance);
        $statement->bindValue('user_id',$user->getId());
        $statement->bindValue('datetime',$datetime);
        $statement->execute();
        $lastId = $this->pdo->lastInsertId();
        $financialEntity->setId($lastId);
    }
    private function addAsShopkeeper(User $user): void{
        $datetime = date_create()->format('Y-m-d H:i:s');
        $financialEntity = $user->getFinancialEntity();
        $cnpj = $financialEntity->getTaxpayer();
        $balance = $financialEntity->getAccount()->getBalance();

        $statement = $this->pdo->prepare(
            "INSERT INTO shopkeepers (cnpj,balance,user_id,created_at,updated_at)
                    VALUES (:cnpj,:balance,:user_id, :datetime,:datetime)"
        );
        $statement->bindValue('cnpj',(string) $cnpj);
        $statement->bindValue('balance', (string) $balance);
        $statement->bindValue('user_id',$user->getId());
        $statement->bindValue('datetime',$datetime);
        $statement->execute();
        $lastId = $this->pdo->lastInsertId();
        $financialEntity->setId($lastId);
    }
    public function findByIdCode(IdentifierCode $id): User | null
    {
        $statement = $this->pdo->query(
            "SELECT
                        users.id,user_type,name,password, users.created_at, users.updated_at,
                        e.login, e.email, e.id as emailId,
                        s.id as idShopkeeper,c.id as idCustomer,
                        s.balance as balanceShopkeeper, s.cnpj as cnpj,
                        c.balance as balanceCustomer, c.cpf as cpf
                    FROM users
                        LEFT JOIN emails e on users.id = e.user_id
                        LEFT JOIN shopkeepers s on users.id = s.user_id
                        LEFT JOIN customers c on users.id = c.user_id
                    WHERE users.id = ?");

        $id = $id->code();
        $statement->bindParam(1, $id);
        $statement->execute();

        $users = $this->hydrateUserList($statement);
        return array_shift( $users);
    }
    public function findAll(): array
    {
        $statement = $this->pdo->query(
            "SELECT
                        users.id,user_type,name,password, users.created_at, users.updated_at,
                        e.login, e.email, e.id as emailId,
                        s.id as idShopkeeper,c.id as idCustomer,
                        s.balance as balanceShopkeeper, s.cnpj as cnpj,
                        c.balance as balanceCustomer, c.cpf as cpf
                    FROM users
                        LEFT JOIN emails e on users.id = e.user_id
                        LEFT JOIN shopkeepers s on users.id = s.user_id
                        LEFT JOIN customers c on users.id = c.user_id
                    ORDER BY users.id,e.id");


        return $this->hydrateUserList($statement);
    }

    public function findFinancialEntityByIdCode(IdentifierCode $idUser): null|FinancialEntity
    {
        $statement = $this->pdo->prepare(
            "SELECT
                        users.id,user_type,
                        s.id as idShopkeeper,c.id as idCustomer,
                        s.balance as balanceShopkeeper, s.cnpj as cnpj,
                        c.balance as balanceCustomer, c.cpf as cpf
                    FROM users
                        LEFT JOIN shopkeepers s on users.id = s.user_id
                        LEFT JOIN customers c on users.id = c.user_id
                    WHERE users.id = ?");

        $id = $idUser->code();
        $statement->bindParam(1, $id ,PDO::PARAM_INT);
        $statement->execute();

        $financialEntity = $this->hydrateFinancialEntityList($statement);
        return array_shift( $financialEntity);
    }

    public function findFilterAndPaginatedActiveUsers(UserType $userType, int $offset = 0, int $limit = 10): array
        {
        $sql = "
        SELECT users.id, users.user_type, users.name
        FROM users
        WHERE
            (EXISTS (SELECT 1 FROM customers WHERE customers.user_id = users.id)
           OR EXISTS (SELECT 1 FROM shopkeepers WHERE shopkeepers.user_id = users.id))
        ";
        $filterType = $userType->getCode() != UserType::TYPE['LOGIN'];
        if($filterType){
            $sql .= "AND users.user_type = :user_type ";
        }
        $sql .= "LIMIT :limit OFFSET :offset ";
        $statement =  $this->pdo->prepare($sql);

        if($filterType){
            $statement->bindValue( ':user_type' ,$userType->getCode(),PDO::PARAM_INT);
        }
        $statement->bindValue( ':limit' , $limit,PDO::PARAM_INT);
        $statement->bindValue( ':offset' , $offset,PDO::PARAM_INT);
        $statement->execute();
        return $this->hydrateUserList($statement);;
    }
}
