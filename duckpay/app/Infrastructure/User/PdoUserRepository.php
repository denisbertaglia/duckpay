<?php

namespace App\Infrastructure\User;

use App\Domain\IdentifierCode;
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
    private function hydrateList(PDOStatement $statement): array{
        $statementData = $statement->fetchAll();
        $usersList = [];
        foreach ($statementData as $user) {
            $usersList[] = new User(
                new IdentifierCode((string)$user['id']),
                new UserType((int) $user['user_type']),
                $user['name']
            );
        }
        return $usersList;
    }
    public function add(User $user): User
    {
        $datetime = date_create()->format('Y-m-d H:i:s');
        if($password = password_hash($user->getPassword(),PASSWORD_BCRYPT,['cost'=>10])){
            $statement  = $this->pdo
                ->prepare(
                "INSERT INTO users (user_type,name,password,created_at,updated_at )VALUES (:user_type,  :name, :password, :created_at, :updated_at )"
                );
            $data = $statement->execute([
                ':user_type' => $user->getType(),
                ':name' => $user->getName(),
                ':password' => $password,
                ':created_at' => $datetime,
                ':updated_at' => $datetime
            ]);
            $user->setId($this->pdo->lastInsertId());
            return $user;
        }
        throw new \DomainException('Bad config algorithm');
    }

    public function findByIdCode(IdentifierCode $id): User | null
    {
        $statement = $this->pdo
            ->prepare(
                "SELECT id,user_type,name,password,created_at,updated_at FROM users WHERE id = ?"
            );
        $id = $id->code();
        $statement->bindParam(1, $id);
        $statement->execute();

        $users = $this->hydrateList($statement);
        return array_shift( $users);
    }

    public function findAll(): array
    {
        $statement = $this->pdo->query("SELECT id,user_type,name,password,created_at,updated_at FROM users");
        return  $this->hydrateList($statement);
    }
}
