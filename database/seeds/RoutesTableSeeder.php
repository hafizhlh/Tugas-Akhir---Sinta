<?php

use Illuminate\Database\Seeder;
use App\Models\Routes;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Routes::whereNotNull('id')->delete();
        
        $data = [
            /*Login*/
            // ['permission' => '', 'middleware' => 'lang', 'type' => 'view', 'method' => 'GET', 'url' => '/', 'route' => 'Landing\LandingPageController@index', 'guard' => 'web'],
            ['permission' => '', 'middleware' => 'lang', 'type' => 'view', 'method' => 'GET', 'url' => '/', 'route' => 'LoginController@index', 'guard' => 'web'],
            ['permission' => '', 'middleware' => 'lang', 'type' => 'view', 'method' => 'POST', 'url' => '/login/store', 'route' => 'LoginController@store', 'guard' => 'web'],
            ['permission' => '', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/logout', 'route' => 'LoginController@destroy', 'guard' => 'web'],
            /*Forget Password*/             
            ['permission' => '', 'middleware' => 'lang', 'type' => 'view', 'method' => 'GET', 'url' => '/forgetpassword', 'route' => 'ForgotPasswordController@index', 'guard' => 'web'],
            ['permission' => '', 'middleware' => 'lang', 'type' => 'view', 'method' => 'POST', 'url' => '/forgetpassword/store', 'route' => 'ForgotPasswordController@submitForgetPasswordForm', 'guard' => 'web'],
            /*Dashboard*/
            ['permission' => 'dashboard-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/dashboard', 'route' => 'DashboardController@index', 'guard' => 'web'],
            // Menu Setting
            ['permission' => 'menusetting-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/menusetting', 'route' => 'WEBSETTING\MenuController@index', 'guard' => 'web'],
            ['permission' => 'menusetting-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/menusetting/list', 'route' => 'WEBSETTING\MenuController@datatables', 'guard' => 'web'],
            ['permission' => 'menusetting-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/menusetting/{id}', 'route' => 'WEBSETTING\MenuController@show', 'guard' => 'web'],
            ['permission' => 'menusetting-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/menusetting', 'route' => 'WEBSETTING\MenuController@store', 'guard' => 'web'],
            ['permission' => 'menusetting-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/menusetting/{id}', 'route' => 'WEBSETTING\MenuController@update', 'guard' => 'web'],
            ['permission' => 'menusetting-D', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'DELETE', 'url' => '/menusetting/{id}', 'route' => 'WEBSETTING\MenuController@destroy', 'guard' => 'web'],
            // Role Setting
            ['permission' => 'rolesetting-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/rolesetting', 'route' => 'WEBSETTING\RoleController@index', 'guard' => 'web'],
            ['permission' => 'rolesetting-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/rolesetting/list', 'route' => 'WEBSETTING\RoleController@datatables', 'guard' => 'web'],
            ['permission' => 'rolesetting-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/rolesetting/{id}', 'route' => 'WEBSETTING\RoleController@show', 'guard' => 'web'],
            ['permission' => 'rolesetting-D', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'DELETE', 'url' => '/rolesetting/{id}', 'route' => 'WEBSETTING\RoleController@destroy', 'guard' => 'web'],
            ['permission' => 'rolesetting-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/rolesetting/{id}', 'route' => 'WEBSETTING\RoleController@update', 'guard' => 'web'],
            ['permission' => 'rolesetting-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/rolesetting', 'route' => 'WEBSETTING\RoleController@store', 'guard' => 'web'],
            ['permission' => 'rolesetting-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/rolesetting/showpermission/{id}', 'route' => 'WEBSETTING\RoleController@access', 'guard' => 'web'],
            ['permission' => 'rolesetting-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/rolesetting/{id}/syncrnpermission', 'route' => 'WEBSETTING\RoleController@sycrnaccess', 'guard' => 'web'],
            // Route Setting
            ['permission' => 'routesetting-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/routesetting', 'route' => 'WEBSETTING\RouteController@index', 'guard' => 'web'],
            ['permission' => 'routesetting-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/routesetting/list', 'route' => 'WEBSETTING\RouteController@datatables', 'guard' => 'web'],
            ['permission' => 'routesetting-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/routesetting/{id}', 'route' => 'WEBSETTING\RouteController@show', 'guard' => 'web'],
            ['permission' => 'routesetting-D', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'DELETE', 'url' => '/routesetting/{id}', 'route' => 'WEBSETTING\RouteController@destroy', 'guard' => 'web'],
            ['permission' => 'routesetting-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/routesetting/{id}', 'route' => 'WEBSETTING\RouteController@update', 'guard' => 'web'],
            ['permission' => 'routesetting-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/routesetting', 'route' => 'WEBSETTING\RouteController@store', 'guard' => 'web'],
            // User Setting
            ['permission' => 'usersetting-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/usersetting', 'route' => 'WEBSETTING\UserController@index', 'guard' => 'web'],
            ['permission' => 'usersetting-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/usersetting/list', 'route' => 'WEBSETTING\UserController@datatables', 'guard' => 'web'],

            ['permission' => 'usersetting-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/templateuser', 'route' => 'WEBSETTING\UserController@template', 'guard' => 'web'],
            ['permission' => 'usersetting-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/uploaduser', 'route' => 'WEBSETTING\UserController@upload', 'guard' => 'web'],

            ['permission' => 'usersetting-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/usersetting/{uuid}', 'route' => 'WEBSETTING\UserController@show', 'guard' => 'web'],
            ['permission' => 'usersetting-D', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'DELETE', 'url' => '/usersetting/destroy/{uuid}', 'route' => 'WEBSETTING\UserController@destroy', 'guard' => 'web'],
            ['permission' => 'usersetting-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/usersetting', 'route' => 'WEBSETTING\UserController@store', 'guard' => 'web'],
            ['permission' => 'usersetting-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/usersetting/resetpassword/{uuid}', 'route' => 'WEBSETTING\UserController@resetpassword', 'guard' => 'web'],
            ['permission' => 'usersetting-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/usersetting/synronroles/{uuid}', 'route' => 'WEBSETTING\UserController@syncronRole', 'guard' => 'web'],
            ['permission' => 'usersetting-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/usersetting/{uuid}', 'route' => 'WEBSETTING\UserController@update', 'guard' => 'web'],

            // Permission Setting
            ['permission' => 'permission-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/permissionsetting', 'route' => 'WEBSETTING\PermissionController@index', 'guard' => 'web'],
            ['permission' => 'permission-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/permissionsetting/list', 'route' => 'WEBSETTING\PermissionController@datatables', 'guard' => 'web'],
            ['permission' => 'permission-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/permissionsetting/{uuid}', 'route' => 'WEBSETTING\PermissionController@show', 'guard' => 'web'],
            ['permission' => 'permission-D', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'DELETE', 'url' => '/permissionsetting/destroy/{uuid}', 'route' => 'WEBSETTING\PermissionController@destroy', 'guard' => 'web'],
            ['permission' => 'permission-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/permissionsetting', 'route' => 'WEBSETTING\PermissionController@store', 'guard' => 'web'],
            ['permission' => 'permission-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/permissionsetting/{uuid}', 'route' => 'WEBSETTING\PermissionController@update', 'guard' => 'web'],
            // Barang Setting
            ['permission'=>'barang-R','middleware'=> 'lang,authz','type'=>'view','method'=>'GET','url'=>'/barang','route'=>'BarangController@index','guard'=>'web'],
            ['permission'=>'barang-R','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/barang/list','route'=>'BarangController@datatables','guard'=>'web'],
            ['permission'=>'barang-C','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/barang','route'=>'BarangController@store','guard'=>'web'],
            ['permission'=>'barang-U','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/barang/{id}','route'=>'BarangController@show','guard'=>'web'],
            ['permission'=>'barang-U','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/barang/{id}/update','route'=>'BarangController@update','guard'=>'web'],
            ['permission'=>'barang-D','middleware'=> 'lang,authz','type'=>'data','method'=>'DELETE','url'=>'/barang/{id}','route'=>'BarangController@destroy','guard'=>'web'],
            // Barang Keluar Setting
            ['permission'=>'barangkeluar-R','middleware'=> 'lang,authz','type'=>'view','method'=>'GET','url'=>'/barangkeluar','route'=>'BarangKeluarController@index','guard'=>'web'],
            ['permission'=>'barangkeluar-R','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/barangkeluar/list','route'=>'BarangKeluarController@datatables','guard'=>'web'],
            ['permission'=>'barangkeluar-C','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/barangkeluar','route'=>'BarangKeluarController@store','guard'=>'web'],
            ['permission'=>'barangkeluar-U','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/barangkeluar/{id}','route'=>'BarangKeluarController@show','guard'=>'web'],
            ['permission'=>'barangkeluar-U','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/barangkeluar/{id}/update','route'=>'BarangKeluarController@update','guard'=>'web'],
            ['permission'=>'barangkeluar-D','middleware'=> 'lang,authz','type'=>'data','method'=>'DELETE','url'=>'/barangkeluar/{id}','route'=>'BarangKeluarController@destroy','guard'=>'web'],
            //Barang Masuk Setting
            ['permission'=>'barangmasuk-R','middleware'=> 'lang,authz','type'=>'view','method'=>'GET','url'=>'/barangmasuk','route'=>'BarangMasukController@index','guard'=>'web'],
            ['permission'=>'barangmasuk-R','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/barangmasuk/list','route'=>'BarangMasukController@datatables','guard'=>'web'],
            ['permission'=>'barangmasuk-C','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/barangmasuk','route'=>'BarangMasukController@store','guard'=>'web'],
            ['permission'=>'barangmasuk-U','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/barangmasuk/{id}','route'=>'BarangMasukController@show','guard'=>'web'],
            ['permission'=>'barangmasuk-U','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/barangmasuk/{id}/update','route'=>'BarangMasukController@update','guard'=>'web'],
            ['permission'=>'barangmasuk-D','middleware'=> 'lang,authz','type'=>'data','method'=>'DELETE','url'=>'/barangmasuk/{id}','route'=>'BarangMasukController@destroy','guard'=>'web'],

            //Return Barang Setting
            ['permission'=>'returnbarang-C','middleware'=>'lang.authz','type'=>'data','method'=>'POST','url'=>'/returnbarang','route'=>'ReturnBarangController@store','guard'=>'web'],
            ['permission'=>'returnbarang-U','middleware'=>'lang.authz','type'=>'data','method'=>'GET','url'=>'/returnbarang/{id}','route'=>'ReturnBarangController@show','guard'=>'web'],          
            

            //get barang 
            ['middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/getBarang/{jenis_code}','route'=>'BarangKeluarController@getBarang','guard'=>'web'],
            ['middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/getBarangKeluar/{id}','route'=>'BarangKeluarController@update','guard'=>'web'],
            
            //Landing Page
            ['permission' => 'landingPage-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/landingpage', 'route' => 'LandingPageController@index', 'guard' => 'web'],
            ['permission' => 'landingPage-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/landingpage/list', 'route' => 'LandingPageController@datatables', 'guard' => 'web'],
            ['permission' => 'landingPage-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/landingpage/{uuid}', 'route' => 'LandingPageController@show', 'guard' => 'web'],
            ['permission' => 'landingPage-D', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'DELETE', 'url' => '/landingpage/destroy/{uuid}', 'route' => 'LandingPageController@destroy', 'guard' => 'web'],
            ['permission' => 'landingPage-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/landingpage', 'route' => 'LandingPageController@store', 'guard' => 'web'],
            ['permission' => 'landingPage-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/landingpage/{uuid}', 'route' => 'LandingPageController@update', 'guard' => 'web'],


            ['permission'=>'','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/changepassword','route'=>'WEBSETTING\UserController@changePassword','guard'=>'web'],
            //master Data
            // COMPANY0
            // ['permission'=>'company-R','middleware'=> 'lang,authz','type'=>'view','method'=>'GET','url'=>'/company','route'=>'CompanyController@index','guard'=>'web'],
            // ['permission'=>'company-R','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/company/list','route'=>'CompanyController@datatables','guard'=>'web'],
            // ['permission'=>'company-C','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/company','route'=>'CompanyController@store','guard'=>'web'],
            // ['permission'=>'company-U','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/company/{id}','route'=>'CompanyController@show','guard'=>'web'],
            // ['permission'=>'company-U','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/company/{id}/update','route'=>'CompanyController@update','guard'=>'web'],
            // ['permission'=>'company-D','middleware'=> 'lang,authz','type'=>'data','method'=>'DELETE','url'=>'/company/{id}','route'=>'CompanyController@destroy','guard'=>'web'],

            // 

            // Kikik Add Simulate User
            ['permission'=>'usersetting-A','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/usersetting/simulate/{id}','route'=>'WEBSETTING\UserController@simulate','guard'=>'web'],
            ['permission'=>'usersetting-A','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/usersetting/leaveSimulate','route'=>'WEBSETTING\UserController@leaveSimulate','guard'=>'web'],

            // Landing Page
            ['middleware'=> 'lang','type'=>'view','method'=>'GET','url'=>'/tentang-TI','route'=>'Landing\TentangTIController@index','guard'=>'web'],
            ['middleware'=> 'lang','type'=>'view','method'=>'GET','url'=>'/security-awareness','route'=>'Landing\SecurityAwarenessController@index','guard'=>'web'],
            ['middleware'=> 'lang','type'=>'view','method'=>'GET','url'=>'/tautan','route'=>'Landing\TautanController@index','guard'=>'web'],
            ['middleware'=> 'lang','type'=>'view','method'=>'GET','url'=>'/it-agent','route'=>'Landing\ITAgentController@index','guard'=>'web'],

            //Barang Get
            ['permission'=>'barang-R','middleware'=> 'lang,authz','type'=>'view','method'=>'GET','url'=>'/barang','route'=>'BarangController@index','guard'=>'web'],
            ['permission'=>'barang-R','middleware'=> 'lang,authz','type'=>'view','method'=>'GET','url'=>'/barang/list','route'=>'BarangController@datatables','guard'=>'web'],
            ['permission'=>'barang-U','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/barang/{id}','route'=>'BarangController@show','guard'=>'web'],
            ['permission'=>'barangkeluar-U','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/barangkeluar/{id}','route'=>'BarangKeluarController@show','guard'=>'web'],
            ['middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/getBarang/{jenis_code}','route'=>'BarangKeluarController@getBarang','guard'=>'web'],
            ['permission'=>'barangkeluar-R','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/BarangKeluar/list','route'=>'BarangKeluarController@datatables','guard'=>'web'],
            ['permission'=>'barangmasuk-R','middleware'=> 'lang,authz','type'=>'view','method'=>'GET','url'=>'/barangmasuk','route'=>'BarangMasukController@index','guard'=>'web'],
            ['permission'=>'dashboard-R','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/BarangMasuk/list','route'=>'BarangMasukController@datatables','guard'=>'web'],
            ['permission'=>'barangmasuk-U','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/barangmasuk/{id}','route'=>'BarangMasukController@show','guard'=>'web'],
            ['permission'=>'returnbarang-R','middleware'=> 'lang,authz','type'=>'view','method'=>'GET','url'=>'/returnbarang','route'=>'ReturnBarangController@index','guard'=>'web'],
            ['permission'=>'barangkeluar-R','middleware'=> 'lang,authz','type'=>'view','method'=>'GET','url'=>'/barangkeluar','route'=>'BarangKeluarController@index','guard'=>'web'],
            ['middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/getBarangKeluar/{id}','route'=>'BarangKeluarController@update','guard'=>'web'],
            ['permission'=>'returnbarang-U','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/returnbarang/{id}','route'=>'ReturnBarangController@show','guard'=>'web'],
            ['permission'=>'returnbarang-R','middleware'=> 'lang,authz','type'=>'data','method'=>'GET','url'=>'/data-returnbarang','route'=>'ReturnBarangController@datatables','guard'=>'web'],

            //Barang POST
            ['permission'=>'barang-C','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/barang','route'=>'BarangController@store','guard'=>'web'],
            ['permission'=>'barang-U','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/barang/{id}/update','route'=>'BarangController@update','guard'=>'web'],
            ['permission'=>'barangkeluar-C','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/barang/{id}','route'=>'BarangKeluarController@store','guard'=>'web'],
            ['permission'=>'barangkeluar-U','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/barang/{id}/update','route'=>'BBarangKeluarController@update','guard'=>'web'],
            ['permission'=>'barangmasuk-U','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/barangmasuk/{id}/update','route'=>'BarangMasukController@update','guard'=>'web'],
            ['permission'=>'barangmasuk-C','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/barangmasuk','route'=>'BarangMasukController@store','guard'=>'web'],
            ['permission'=>'returnbarang-C','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/returnbarang','route'=>'ReturnBarangController@store','guard'=>'web'],
            ['permission'=>'returnbarang-U','middleware'=> 'lang,authz','type'=>'data','method'=>'POST','url'=>'/returnbarang/{id}/update','route'=>'ReturnBarangController@update','guard'=>'web'],

            //Barang Delete
            ['permission'=>'barang-D','middleware'=> 'lang,authz','type'=>'data','method'=>'DELETE','url'=>'/barang/{id}','route'=>'BarangController@destroy','guard'=>'web'],
            ['permission'=>'barangkeluar-D','middleware'=> 'lang,authz','type'=>'data','method'=>'DELETE','url'=>'/barangkeluar/{id}','route'=>'BarangKeluarController@destroy','guard'=>'web'],
            ['permission'=>'barangmasuk-D','middleware'=> 'lang,authz','type'=>'data','method'=>'DELETE','url'=>'/barangmasuk/{id}','route'=>'BarangMasukController@destroy','guard'=>'web'],
            ['permission'=>'returnbarang-D','middleware'=> 'lang,authz','type'=>'data','method'=>'DELETE','url'=>'/returnbarang/{id}','route'=>'ReturnBarangController@destroy','guard'=>'web'],

            //Tidak ada permission
            ['permission' => '', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'POST', 'url' => '/login/store', 'route' => 'LoginController@store', 'guard' => 'web'],
            ['permission' => '', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/forgetpassword', 'route' => 'ForgotPasswordController@index', 'guard' => 'web'],
            ['permission' => '', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'POST', 'url' => '/forgetpassword/store', 'route' => 'ForgotPasswordController@submitForgetPasswordForm', 'guard' => 'web'],
            ['permission' => '', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/changepassword', 'route' => 'WEBSETTING\UserController@changePassword', 'guard' => 'web'],
            ['permission' => '', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/tentang-TI', 'route' => 'Landing\TentangTIController@index', 'guard' => 'web'],
            ['permission' => '', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/security-awareness', 'route' => 'Landing\SecurityAwarenessController@index', 'guard' => 'web'],
            ['permission' => '', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/tautan', 'route' => 'Landing\TautanController@index', 'guard' => 'web'],
            ['permission' => '', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/it-agent', 'route' => 'Landing\ITAgentController@index', 'guard' => 'web'],

            //Kategori
            ['permission' => 'kategori-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/kategori', 'route' => 'KategoriController@store', 'guard' => 'web'],
            ['permission' => 'kategori-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/kategori/{id}/update', 'route' => 'KategoriController@update', 'guard' => 'web'],
            ['permission' => 'kategori-D', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'DELETE', 'url' => '/kategori/{id}', 'route' => 'KategoriController@destroy', 'guard' => 'web'],
            ['permission' => 'kategori-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/kategori/list', 'route' => 'KategoriController@datatables', 'guard' => 'web'],
            ['permission' => 'kategori-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/kategori', 'route' => 'KategoriController@index', 'guard' => 'web'],
            ['permission' => 'kategori-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/kategori/{id}', 'route' => 'KategoriController@show', 'guard' => 'web'],
            ['permission' => '', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/getBarang/{jenis_code}/{kategori_id}', 'route' => 'BarangKeluarController@getBarang', 'guard' => 'web'],
        ];

        foreach($data as $k_data => $v_data){
            $check = Routes::where($v_data)->first();
            if(!$check)
                Routes::insert($v_data);
        }
        // Routes::insert($data);
        $this->command->info("Routes Seeder Success !");
    }
}
