<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $datas = [
            ['type'=> 'dashboard', 'icon' => 'fa fa-tachometer-alt text-success mr-5', 'name' => 'Dashboard', 'url' => 'dashboard', 'permission' => 'dashboard'],
            // ['type'=> 'dashboard', 'icon' => 'fa fa-server text-success mr-5', 'name' => 'Master Data', 'url' => '#', 'permission' => 'masterdata'],
            ['type'=> 'dashboard', 'icon' => 'fa fa-home text-primary mr-5', 'name' => 'Home ', 'url' => '#', 'permission' => 'home'],
            ['type'=> 'dashboard', 'icon' => 'fa fa-cog text-danger mr-5', 'name' => 'Web Settings', 'url' => '#', 'permission' => 'websettings'],
        ];
        
        // Menu::insert($datas);        
        foreach ($datas as $k_datas => $v_datas){
            $check = Menu::where($v_datas)->first();
            if(!$check)
            Menu::create($v_datas);

        }

        $childrens = [
            //websettings
            ['type'=> 'dashboard', 'icon' => "fa fa-caret-square-down text-danger", 'name' => 'Menu', 'parent_id' => 3, 'url' => 'menusetting', 'permission' => 'menusetting'],
            ['type'=> 'dashboard', 'icon' => "fa fa-house-user text-danger", 'name' => 'Role', 'parent_id' => 3, 'url' => 'rolesetting', 'permission' => 'rolesetting'],
            ['type'=> 'dashboard', 'icon' => "fa fa-route text-danger", 'name' => 'Route Settings', 'parent_id' => 3, 'url' => 'routesetting', 'permission' => 'routesetting'],
            ['type'=> 'dashboard', 'icon' => "fa fa-users text-danger", 'name' => 'Users Management', 'parent_id' => 3, 'url' => 'usersetting', 'permission' => 'usersetting'],
            ['type'=> 'dashboard', 'icon' => "fa fa-user-shield text-danger", 'name' => 'Permission', 'parent_id' => 3, 'url' => 'permissionsetting', 'permission' => 'permission'],
            ['type'=> 'dashboard', 'icon' => "fas fa-th-large text-primary", 'name' => 'Kategori', 'parent_id' => 2, 'url' => 'kategori', 'permission' => 'kategori'],
            ['type'=> 'dashboard', 'icon' => "fas fa-th-large text-primary", 'name' => 'Barang', 'parent_id' => 2, 'url' => 'barang', 'permission' => 'barang'],
            ['type'=> 'dashboard', 'icon' => "fas fa-th-large text-primary", 'name' => 'Return Barang', 'parent_id' => 2, 'url' => 'returnbarang', 'permission' => 'returnbarang'],
            ['type'=> 'dashboard', 'icon' => "fas fa-th-large text-primary", 'name' => 'Barang Keluar', 'parent_id' => 2, 'url' => 'barangkeluar', 'permission' => 'barangkeluar'],
            ['type'=> 'dashboard', 'icon' => "fas fa-th-large text-primary", 'name' => 'Barang Masuk', 'parent_id' => 2, 'url' => 'barangmasuk', 'permission' => 'barangmasuk'],
            
            // ['type'=> 'dashboard', 'icon' => "fa fa-upload text-success", 'name' => 'Company', 'parent_id' => 2, 'url' => 'company', 'permission' => 'company'],
            //master data

            //report

        ];

        // Menu::insert($childrens);             
        foreach ($childrens as $k_data => $v_data){
            $check = Menu::where($v_data)->first();
            if(!$check)
            Menu::create($v_data);

        }

        $this->command->info("Success insert Menu Seeder");
    }
}
