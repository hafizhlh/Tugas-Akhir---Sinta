<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePermissionsTableSeeder extends Seeder
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
            ['username' => 'admin'],
            ['username' => 'developer'],
            ['username' => 'view'],
            ['username' => 'admin2'],
        ];

        $roles = [
            'developer' => 1,
            'admin'     => 2,
            'view'      => 3,
            'admin2'    => 4
        ];

        $temp = array();
        for ($i=1; $i <= 45; $i++) {
            $temp[] = $i;
        }

        $permissions = [
            'admin'     => $temp,
            // [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35],
            'developer' => [1,2],
            'view'      => [2,1],
            'admin2'    => $temp
        ];

        foreach ($users as $key) {
            # code...
            $user = "";
            $user = User::where($key)->first();
            $user->assignRole($roles[$key['username']]);

            $role = Role::where('id', $roles[$key['username']])->first();
            $role->syncPermissions($permissions[$key['username']]);
        }

        $this->command->info('Roles Assign Success !');

    }
}
