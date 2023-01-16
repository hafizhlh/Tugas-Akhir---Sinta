<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            ['username' => 'admin', 'email' => 'admin@company.com', 'password' => Hash::make('admin'), 'status' => 'y', 'company_code' => 'A000'],
            ['username' => 'admin2', 'email' => 'admin2@company.com', 'password' => Hash::make('admin2'), 'status' => 'y', 'company_code' => 'B000'],
            ['username' => 'developer', 'email' => 'developer@company.com', 'password' => Hash::make('developer'), 'status' => 'y', 'company_code' => 'B000'],
            ['username' => 'view', 'email' => 'view@company.com', 'password' => Hash::make('view'), 'status' => 'y', 'company_code' => 'BA00'],
        ];

        User::insert($users);
        $this->command->info('User Seeders SuccessFullt');

    }
}
