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

        Routes::create([
            'method' => 'POST',
            'url' => '/login/store',
            'route' => 'LoginController@store',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang',
            'permission' => '',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/logout',
            'route' => 'LoginController@destroy',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => '',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/forgetpassword',
            'route' => 'ForgotPasswordController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang',
            'permission' => '',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/forgetpassword/store',
            'route' => 'ForgotPasswordController@submitForgetPasswordForm',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang',
            'permission' => '',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/dashboard',
            'route' => 'DashboardController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'dashboard-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/menusetting/list',
            'route' => 'WEBSETTING\MenuController@datatables',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'menusetting-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/menusetting/{id}',
            'route' => 'WEBSETTING\MenuController@show',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'menusetting-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/menusetting',
            'route' => 'WEBSETTING\MenuController@store',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'menusetting-C',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/menusetting/{id}',
            'route' => 'WEBSETTING\MenuController@update',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'menusetting-U',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'DELETE',
            'url' => '/menusetting/{id}',
            'route' => 'WEBSETTING\MenuController@destroy',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'menusetting-D',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/rolesetting',
            'route' => 'WEBSETTING\RoleController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'rolesetting-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/rolesetting/list',
            'route' => 'WEBSETTING\RoleController@datatables',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'rolesetting-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/rolesetting/{id}',
            'route' => 'WEBSETTING\RoleController@show',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'rolesetting-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'DELETE',
            'url' => '/rolesetting/{id}',
            'route' => 'WEBSETTING\RoleController@destroy',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'rolesetting-D',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/rolesetting/{id}',
            'route' => 'WEBSETTING\RoleController@update',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'rolesetting-U',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/rolesetting',
            'route' => 'WEBSETTING\RoleController@store',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'rolesetting-C',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/rolesetting/showpermission/{id}',
            'route' => 'WEBSETTING\RoleController@access',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'rolesetting-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/rolesetting/{id}/syncrnpermission',
            'route' => 'WEBSETTING\RoleController@sycrnaccess',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'rolesetting-U',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/routesetting',
            'route' => 'WEBSETTING\RouteController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'routesetting-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/routesetting/list',
            'route' => 'WEBSETTING\RouteController@datatables',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'routesetting-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/routesetting/{id}',
            'route' => 'WEBSETTING\RouteController@show',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'routesetting-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'DELETE',
            'url' => '/routesetting/{id}',
            'route' => 'WEBSETTING\RouteController@destroy',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'routesetting-D',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/routesetting/{id}',
            'route' => 'WEBSETTING\RouteController@update',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'routesetting-U',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/routesetting',
            'route' => 'WEBSETTING\RouteController@store',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'routesetting-C',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/usersetting',
            'route' => 'WEBSETTING\UserController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'usersetting-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/usersetting/list',
            'route' => 'WEBSETTING\UserController@datatables',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'usersetting-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/templateuser',
            'route' => 'WEBSETTING\UserController@template',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'usersetting-C',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/uploaduser',
            'route' => 'WEBSETTING\UserController@upload',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'usersetting-C',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/usersetting/{uuid}',
            'route' => 'WEBSETTING\UserController@show',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'usersetting-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'DELETE',
            'url' => '/usersetting/destroy/{uuid}',
            'route' => 'WEBSETTING\UserController@destroy',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'usersetting-D',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/usersetting',
            'route' => 'WEBSETTING\UserController@store',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'usersetting-C',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/usersetting/resetpassword/{uuid}',
            'route' => 'WEBSETTING\UserController@resetpassword',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'usersetting-U',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/usersetting/synronroles/{uuid}',
            'route' => 'WEBSETTING\UserController@syncronRole',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'usersetting-U',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/usersetting/{uuid}',
            'route' => 'WEBSETTING\UserController@update',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'usersetting-U',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/permissionsetting',
            'route' => 'WEBSETTING\PermissionController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'permission-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/permissionsetting/list',
            'route' => 'WEBSETTING\PermissionController@datatables',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'permission-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/permissionsetting/{uuid}',
            'route' => 'WEBSETTING\PermissionController@show',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'permission-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'DELETE',
            'url' => '/permissionsetting/destroy/{uuid}',
            'route' => 'WEBSETTING\PermissionController@destroy',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'permission-D',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/permissionsetting',
            'route' => 'WEBSETTING\PermissionController@store',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'permission-C',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/permissionsetting/{uuid}',
            'route' => 'WEBSETTING\PermissionController@update',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'permission-U',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/landingpage',
            'route' => 'LandingPageController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'landingPage-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/landingpage/list',
            'route' => 'LandingPageController@datatables',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'landingPage-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/landingpage/{uuid}',
            'route' => 'LandingPageController@show',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'landingPage-R',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'DELETE',
            'url' => '/landingpage/destroy/{uuid}',
            'route' => 'LandingPageController@destroy',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'landingPage-D',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/landingpage',
            'route' => 'LandingPageController@store',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'landingPage-C',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/landingpage/{uuid}',
            'route' => 'LandingPageController@update',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'landingPage-U',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/changepassword',
            'route' => 'WEBSETTING\UserController@changePassword',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => '',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/usersetting/simulate/{id}',
            'route' => 'WEBSETTING\UserController@simulate',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'usersetting-A',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/usersetting/leaveSimulate',
            'route' => 'WEBSETTING\UserController@leaveSimulate',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'usersetting-A',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/tentang-TI',
            'route' => 'Landing\TentangTIController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang',
            'permission' => '',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/security-awareness',
            'route' => 'Landing\SecurityAwarenessController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang',
            'permission' => '',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/tautan',
            'route' => 'Landing\TautanController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang',
            'permission' => '',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/it-agent',
            'route' => 'Landing\ITAgentController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang',
            'permission' => '',
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/barang',
            'route' => 'BarangController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'barang-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-04-06 11:58:31',
            'updated_at' => '2023-04-06 11:58:31'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/barang/list',
            'route' => 'BarangController@datatables',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'barang-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-04-06 11:59:20',
            'updated_at' => '2023-04-06 11:59:20'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/barang/{id}',
            'route' => 'BarangController@show',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barang-U',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-04-06 12:00:57',
            'updated_at' => '2023-04-06 12:00:57'
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/barang',
            'route' => 'BarangController@store',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barang-C',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-04-06 12:02:33',
            'updated_at' => '2023-04-06 12:02:33'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/',
            'route' => 'LoginController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang',
            'permission' => NULL,
            'created_by' => NULL,
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => NULL,
            'updated_at' => '2023-05-29 14:09:06'
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/barang/{id}/update',
            'route' => 'BarangController@update',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barang-U',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-04-06 13:49:52',
            'updated_at' => '2023-04-06 13:49:52'
        ]);

        Routes::create([
            'method' => 'DELETE',
            'url' => '/barang/{id}',
            'route' => 'BarangController@destroy',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barang-D',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-04-06 12:01:56',
            'updated_at' => '2023-04-06 13:53:11'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/barangkeluar/{id}',
            'route' => 'BarangKeluarController@show',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barangkeluar-U',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-04-14 10:09:18',
            'updated_at' => '2023-04-14 10:09:18'
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/barangkeluar',
            'route' => 'BarangKeluarController@store',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barangkeluar-C',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-04-14 10:11:23',
            'updated_at' => '2023-04-14 10:11:23'
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/barangkeluar/{id}/update',
            'route' => 'BarangKeluarController@update',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barangkeluar-U',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-04-14 10:13:10',
            'updated_at' => '2023-04-14 10:13:37'
        ]);

        Routes::create([
            'method' => 'DELETE',
            'url' => '/barangkeluar/{id}',
            'route' => 'BarangKeluarController@destroy',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barangkeluar-D',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-04-14 10:14:41',
            'updated_at' => '2023-04-14 10:14:41'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/BarangKeluar/list',
            'route' => 'BarangKeluarController@datatables',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barangkeluar-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-04-14 10:05:50',
            'updated_at' => '2023-04-18 16:01:43'
        ]);

        Routes::create([
            'method' => 'DELETE',
            'url' => '/barangmasuk/{id}',
            'route' => 'BarangMasukController@destroy',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barangmasuk-D',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-04-14 10:29:07',
            'updated_at' => '2023-04-14 10:33:41'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/barangmasuk',
            'route' => 'BarangMasukController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'barangmasuk-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-04-14 10:17:55',
            'updated_at' => '2023-04-14 10:34:03'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/BarangMasuk/list',
            'route' => 'BarangMasukController@datatables',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'dashboard-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-04-14 10:21:34',
            'updated_at' => '2023-05-03 09:06:24'
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/barangmasuk/{id}/update',
            'route' => 'BarangMasukController@update',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barangmasuk-U',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-04-14 10:26:50',
            'updated_at' => '2023-04-14 10:35:10'
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/barangmasuk',
            'route' => 'BarangMasukController@store',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barangmasuk-C',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-04-14 10:27:56',
            'updated_at' => '2023-04-14 10:35:26'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/barangmasuk/{id}',
            'route' => 'BarangMasukController@show',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barangmasuk-U',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-04-14 10:24:24',
            'updated_at' => '2023-04-16 21:51:48'
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/returnbarang',
            'route' => 'ReturnBarangController@store',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'returnbarang-C',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-05-04 20:36:47',
            'updated_at' => '2023-05-04 20:36:47'
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/returnbarang/{id}/update',
            'route' => 'ReturnBarangController@update',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'returnbarang-U',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-05-04 20:38:55',
            'updated_at' => '2023-05-04 20:38:55'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/returnbarang',
            'route' => 'ReturnBarangController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'returnbarang-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-05-04 20:57:27',
            'updated_at' => '2023-05-04 20:57:27'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/barangkeluar',
            'route' => 'BarangKeluarController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'barangkeluar-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-04-14 10:07:17',
            'updated_at' => '2023-04-18 15:35:08'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/getBarangKeluar/{id}',
            'route' => 'BarangKeluarController@update',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => NULL,
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-05-05 09:49:44',
            'updated_at' => '2023-05-05 10:27:26'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/returnbarang/{id}',
            'route' => 'ReturnBarangController@show',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'returnbarang-U',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-05-04 20:33:07',
            'updated_at' => '2023-05-08 09:21:31'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/data-returnbarang',
            'route' => 'ReturnBarangController@datatables',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'returnbarang-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-05-04 20:54:11',
            'updated_at' => '2023-05-10 11:26:10'
        ]);

        Routes::create([
            'method' => 'DELETE',
            'url' => '/returnbarang/{id}',
            'route' => 'ReturnBarangController@destroy',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'returnbarang-D',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-05-04 20:48:08',
            'updated_at' => '2023-05-11 08:54:08'
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/kategori/{id}/update',
            'route' => 'KategoriController@update',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'kategori-U',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-05-25 11:36:19',
            'updated_at' => '2023-05-25 11:41:24'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/getkategori/{id}',
            'route' => 'KategoriController@getkategori',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => NULL,
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-05-30 21:24:32',
            'updated_at' => '2023-05-30 21:24:32'
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/barangmasuk-export',
            'route' => 'BarangMasukController@exportTanggalBarangMasuk',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang.authz',
            'permission' => 'barangmasuk-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-05-16 15:57:23',
            'updated_at' => '2023-05-16 16:10:39'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/menusetting',
            'route' => 'WEBSETTING\MenuController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'menusetting-R',
            'created_by' => NULL,
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => NULL,
            'updated_at' => '2023-05-16 16:11:17'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/barangmasuk-export-tahunan',
            'route' => 'BarangMasukController@exportTahunBarangMasuk',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barangmasuk-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-05-16 16:07:28',
            'updated_at' => '2023-05-16 16:13:02'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/barangkeluar-export-tahunan',
            'route' => 'BarangKeluarController@exportTahunBarangKeluar',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barangkeluar-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-05-17 07:42:36',
            'updated_at' => '2023-05-17 07:42:36'
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/barangkeluar-export',
            'route' => 'BarangKeluarController@exportTanggalBarangKeluar',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'barangkeluar-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-05-17 07:44:18',
            'updated_at' => '2023-05-17 07:44:18'
        ]);

        Routes::create([
            'method' => 'DELETE',
            'url' => '/kategori/{id}',
            'route' => 'KategoriController@destroy',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'kategori-D',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-05-25 11:31:58',
            'updated_at' => '2023-05-25 11:31:58'
        ]);

        Routes::create([
            'method' => 'POST',
            'url' => '/kategori',
            'route' => 'KategoriController@store',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'kategori-C',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => NULL,
            'created_at' => '2023-05-25 11:35:35',
            'updated_at' => '2023-05-25 11:35:35'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/kategori',
            'route' => 'KategoriController@index',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'kategori-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-05-25 11:32:48',
            'updated_at' => '2023-05-25 11:40:39'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/kategori/{id}',
            'route' => 'KategoriController@show',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => 'kategori-U',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-05-25 11:34:26',
            'updated_at' => '2023-05-25 11:40:54'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/kategori/list',
            'route' => 'KategoriController@datatables',
            'guard' => 'web',
            'type' => 'view',
            'middleware' => 'lang,authz',
            'permission' => 'kategori-R',
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-05-25 11:33:39',
            'updated_at' => '2023-05-25 11:41:12'
        ]);

        Routes::create([
            'method' => 'GET',
            'url' => '/getBarang/{kategori_id}',
            'route' => 'BarangKeluarController@getBarang',
            'guard' => 'web',
            'type' => 'data',
            'middleware' => 'lang,authz',
            'permission' => NULL,
            'created_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'updated_by' => '79946b5a-670a-4802-80b2-ee8273fc1080',
            'created_at' => '2023-04-14 11:04:07',
            'updated_at' => '2023-05-30 21:42:59'
        ]);
    }
}
