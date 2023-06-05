<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {    
        $this->call(UsersTableSeeder::class);
        $this->call(ActionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolePermissionsTableSeeder::class);
        $this->call(RoleHasMenusTableSeeder::class);
        $this->call(RoutesTableSeeder::class);
        $this->call(GlobalVarsTableSeeder::class);
    }
}
