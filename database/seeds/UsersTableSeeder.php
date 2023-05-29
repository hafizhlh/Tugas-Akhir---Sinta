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
            ['username' => 'admin', 'email' => 'admin@company.com', 'password' => Hash::make('admin')],
            ['username' => 'admin2', 'email' => 'admin2@company.com', 'password' => Hash::make('admin2')],
            ['username' => 'developer', 'email' => 'developer@company.com', 'password' => Hash::make('developer')],
            ['username' => 'view', 'email' => 'view@company.com', 'password' => Hash::make('view')],
            ['username' => '2145616','first_name'=>'', 'email' => '2145616@company.com', 'password' => Hash::make('Petrokimia@2023')],
            ['username' => '2166542','first_name'=>'', 'email' => '2166542@company.com', 'password' => Hash::make('Petrokimia@2023')],
            ['username' => '2156220','first_name'=>'', 'email' => '2156220@company.com', 'password' => Hash::make('Petrokimia@2023')],
            ['username' => 'K210085','first_name'=>'', 'email' => 'K210085@company.com', 'password' => Hash::make('Petrokimia@2023')],
            ['username' => 'K210259','first_name'=>'', 'email' => 'K210259@company.com', 'password' => Hash::make('Petrokimia@2023')],
            ['username' => 'K200142','first_name'=>'', 'email' => 'K200142@company.com', 'password' => Hash::make('Petrokimia@2023')],
            ['username' => 'K230108','first_name'=>'', 'email' => 'K230108@company.com', 'password' => Hash::make('Petrokimia@2023')],
            ['username' => 'K230138','first_name'=>'', 'email' => 'K230138@company.com', 'password' => Hash::make('Petrokimia@2023')],

        ];

        User::insert($users);
        $this->command->info('User Seeders SuccessFullt');

    }
}
