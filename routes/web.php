<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Routes;

// Route::get('/', function () {
//     return view('dashboard');
// });

// Route::get('/login', 'LoginController@index');
// Route::POST('/login/store', 'LoginController@store');
// Route::GET('/logout','LoginController@destroy');

// Route::get('/dashboard', 'DashboardController@index')->middleware('authz');



try {
    $routes= Routes::where('guard','web')->get()->toArray();
    
    foreach ($routes as $key ) {
        # code...
            
        $arr=explode(',', $key['middleware']);
        $method=$key['method'];
        $url=$key['url'];
        $path=$key['route'];
        if ($key['permission']!='') {
            # code...
            $perm="permissionAccess:";
            if($key['type']!='data')
            {
                $perm='permission:';
            }
            array_push($arr, $perm.$key['permission']);
        }
        Route::$method($url,$path)->middleware($arr);
    }
    // dd($routes);
} catch (Exception $e) {
    
}
