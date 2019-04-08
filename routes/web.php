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

Route::get('/teste-pdf/{filename}', function ($filename) {
    $filename = 'temp1554592139.jpg';
    $path = storage_path('app/temp-files/').$filename;

    return response()->file($path);
});
//$file_type, $name
$router->get('/render-file/{file_type}/{name}', 'RenderFileController@renderFile');

Route::get('/phpinfo', function () {
    phpinfo();

    //return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});
