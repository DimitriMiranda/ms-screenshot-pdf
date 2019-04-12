<?php
header('Access-Control-Allow-Origin: *');

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


$router->post('/teste', function (Request $request) {
    return '$request->user()';
});

$router->post('/screen-shot-from-pdf/', 'ScreenShotController@screenShotFromPdf');

$router->post('/create-temp-file/', 'RenderFileController@createTempFile');