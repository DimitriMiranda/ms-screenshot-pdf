<?php
header('Access-Control-Allow-Origin: *');
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

//$file_type, $name
$router->get('/render-file/{file_type}/{name}', 'RenderFileController@renderFile');

Route::get('/phpinfo', function () {
    phpinfo();
});

Route::get('/', function () {
    return view('welcome');
});


$router->get('/consulta-processo-pje/{numeroProcesso}', 'SoapController@consultarProcessoPje');

$router->get('/consulta-itempublico-cnj/{tipoTabela}/{tipoPesquisa}/{valorPesquisa}', 'SoapController@consultarItemPublicoCnj');
