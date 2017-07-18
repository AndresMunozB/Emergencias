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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/quienes', function () {
    return view('quienes-somos');
});

// AUTENTICACIÓN
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//PARA CATASTROFES
Route::name('catastrofes_path')->get('/catastrofes','CatastrofeController@index');
Route::name('create_catastrofe_path')->get('/catastrofes/create', 'CatastrofeController@create');
Route::name('store_catastrofe_path')->post('/catastrofes', 'CatastrofeController@store');
Route::name('catastrofe_path')->get('/catastrofes/{catastrofe}','CatastrofeController@show');
Route::name('edit_catastrofe_path')->get('/catastrofes/{catastrofe}/edit', 'CatastrofeController@edit');
Route::name('update_catastrofe_path')->put('/catastrofes/{catastrofe}', 'CatastrofeController@update');
Route::name('delete_catastrofe_path')->delete('catastrofes/{catastrofe}','CatastrofeController@delete');
Route::name('catastrofes_resumen')->get('/_catastrofes','CatastrofeController@index2');


//PARA MEDIDAS
Route::name('medidas_path')->get('/medidas','MedidaController@index');
Route::name('store_medida_path')->post('/medidas/store', 'MedidaController@store');
Route::name('aprobar_medida_path')->post('/medidas/{medida}', 'MedidaController@approve');
Route::name('medida_path')->get('/medidas/{medida}','MedidaController@show');
Route::name('delete_medida_path')->delete('medidas/{medida}','MedidaController@delete');
Route::name('create_medida_path')->get('/medidas/create/{catastrofe_id}', 'MedidaController@create');
// APORTES
Route::name('add_material')->post('/medidas/material/{material}','MedidaController@addMaterial');
Route::name('update_evento')->post('/medidas/evento/{evento}','MedidaController@updateActividades');
Route::name('add_aporte_monetario')->post('/medidas/apoyo/{apoyo}','MedidaController@addApoyo');

// ENTIDADES
Route::name('entidades_path')->get('/entidades','EntidadController@index');
Route::name('create_entidad_path')->get('/entidades/create', 'EntidadController@create');
Route::name('store_entidad_path')->post('/entidades/store', 'EntidadController@store');
Route::name('entidad_path')->get('/entidades/{entidad}','EntidadController@show');


// USUARIOS

Route::name('usuarios_path')->get('/usuarios','UserController@index');
Route::name('usuario_path')->get('/usuarios/{usuarios}','UserController@index');
Route::name('usuario_gob_path')->get('/usuarios/{usuario}','UserController@gob');
Route::name('delete_usuario_path')->delete('/usuarios/{usuario}','UserController@delete');
Route::name('desabilitar_usuario_path')->post('/usuarios','UserController@disable');


Route::name('somos')->get('/somos','SomosController@index');
