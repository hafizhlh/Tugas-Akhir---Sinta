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
use Illuminate\Support\Facades\Route;



Route::post('/postKategori', 'KategoriController@store');
Route::get('/getKategori', 'KategoriController@datatables');
Route::get('/getStok/{id}', 'KategoriController@getStok');



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
