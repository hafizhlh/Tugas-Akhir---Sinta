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
            ['username' => 'view', 'email' => 'view@company.com', 'password' => Hash::make('view'), 'status' => ' y', 'company_code' => 'BA00'],
            ['username' => '2145616', 'email' => '2145616@company.com', 'password' => 'Petrokimia@2023', 'status' => ' y', 'company_code' => '2145616'],
            ['username' => '2166542', 'email' => '2166542@company.com', 'password' => 'Petrokimia@2023', 'status' => ' y', 'company_code' => '2166542'],
            ['username' => '2156220', 'email' => '2156220@company.com', 'password' => 'Petrokimia@2023', 'status' => ' y', 'company_code' => '2156220'],
            ['username' => 'K210085', 'email' => 'K210085@company.com', 'password' => 'Petrokimia@2023', 'status' => ' y', 'company_code' => 'K210085'],
            ['username' => 'K210259', 'email' => 'K210259@company.com', 'password' => 'Petrokimia@2023', 'status' => ' y', 'company_code' => 'K210259'],
            ['username' => 'K200142', 'email' => 'K200142@company.com', 'password' => 'Petrokimia@2023', 'status' => ' y', 'company_code' => 'K200142'],
            ['username' => 'K230108', 'email' => 'K230108@company.com', 'password' => 'Petrokimia@2023', 'status' => ' y', 'company_code' => 'K230108'],
            ['username' => 'K230138', 'email' => 'K230138@company.com', 'password' => 'Petrokimia@2023', 'status' => ' y', 'company_code' => 'K230138'],

        ];

        User::insert($users);
        $this->command->info('User Seeders SuccessFullt');

    }
}
