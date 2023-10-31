<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $dataUsers = [];
        $dataShopkeepers = [];
        $dataCustomers = [];

        for ($i = 0; $i < 200; $i++) {
            $userId = $i +1;
            $balance = 0.00;
            $userType = rand(0,2);
            $date = fake()->date('Y-m-d H:i:s');
            $name = fake()->name();
            $password = fake()->password();
            $cpf = fake()->numerify('###.###.###-##');
            $cnpj = fake()->numerify('##.###.###/####-##');

            $dataUsers[] =[
                'id' => $userId,
                'user_type' => $userType,
                'name' => $name,
                'password' => $password,
                'created_at' => $date,
                'updated_at' => $date,
            ];
            if($userType==1){
                $dataCustomers[] = [
                    'cpf' => $cpf,
                    'balance' => (string)$balance,
                    'user_id' => (string)$userId,
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            }

            if($userType==2){
                $dataShopkeepers[] = [
                    'cnpj' => $cnpj,
                    'balance' => (string)$balance,
                    'user_id' => (string)$userId,
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            }


        }

        DB::table('users')->insert($dataUsers);
        DB::table('shopkeepers')->insert($dataShopkeepers);
        DB::table('customers')->insert($dataCustomers);
    }
}
