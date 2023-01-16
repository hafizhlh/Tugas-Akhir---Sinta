<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // Permission::truncate();

        $permissions = [
            /*Roles Permission*/
            array('name' => 'dashboard-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => 1),
            array('name' => 'dashboard-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => 1),
            array('name' => 'dashboard-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => 1),
            array('name' => 'dashboard-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => 1),
            array('name' => 'dashboard-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => 1),

            array('name' => 'websettings-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => 3),
            array('name' => 'websettings-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => 3),
            array('name' => 'websettings-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => 3),
            array('name' => 'websettings-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => 3),
            array( 'name' => 'websettings-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => 3),

            array( 'name' => 'menusetting-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => 4),
            array( 'name' => 'menusetting-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => 4),
            array( 'name' => 'menusetting-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => 4),
            array( 'name' => 'menusetting-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => 4),
            array( 'name' => 'menusetting-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => 4),

            array( 'name' => 'rolesetting-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => 5),
            array( 'name' => 'rolesetting-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => 5),
            array( 'name' => 'rolesetting-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => 5),
            array( 'name' => 'rolesetting-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => 5),
            array( 'name' => 'rolesetting-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => 5),

            array( 'name' => 'usersetting-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => 6),
            array( 'name' => 'usersetting-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => 6),
            array( 'name' => 'usersetting-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => 6),
            array( 'name' => 'usersetting-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => 6),
            array( 'name' => 'usersetting-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => 6),

            array( 'name' => 'routesetting-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => 7),
            array( 'name' => 'routesetting-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => 7),
            array( 'name' => 'routesetting-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => 7),
            array( 'name' => 'routesetting-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => 7),
            array( 'name' => 'routesetting-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => 7),

            array( 'name' => 'permission-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => 8),
            array( 'name' => 'permission-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => 8),
            array( 'name' => 'permission-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => 8),
            array( 'name' => 'permission-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => 8),
            array( 'name' => 'permission-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => 8),

            array( 'name' => 'home-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => 2),
            array( 'name' => 'home-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => 2),
            array( 'name' => 'home-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => 2),
            array( 'name' => 'home-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => 2),
            array( 'name' => 'home-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => 2),

            array( 'name' => 'landigPage-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => 9),
            array( 'name' => 'landigPage-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => 9),
            array( 'name' => 'landigPage-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => 9),
            array( 'name' => 'landigPage-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => 9),
            array( 'name' => 'landigPage-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => 9),
        ];

        foreach ($permissions as $k_data => $v_data){
            $check = Permission::where($v_data)->first();
            if(!$check)
            Permission::create($v_data);

        }

        $this->command->info("Permission Seeder Success");
    }
}
