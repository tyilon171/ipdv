<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

Route::get('/', 'IpdvController@index')->name('home');

//VIEWS
Route::get('/centroCusto/{id?}', "IpdvController@getCentroCustoView")->name('centroCusto');
Route::get('/departamento/{id?}', "IpdvController@getDepartamentoView")->name('departamento');
Route::get('/cargo/{id?}', "IpdvController@getCargoView")->name('cargo');
Route::get('/usuario/{id?}', "IpdvController@getUserView")->name('usuario');

//ROTAS DE POST
Route::post("/postCentro", "IpdvController@postCentroCusto");
Route::post("/postDepartamento", "IpdvController@postDepartamento");
Route::post("/postCargo", "IpdvController@postCargo");
Route::post("/postUser", "IpdvController@postUser");
Route::post('/importar', "IpdvController@importador");

//ROTAS GET
Route::get('/getUsuarios', "IpdvController@getUser");
Route::get('/getDepartamentos', "IpdvController@getDepartamento");

//ROTA DE DELETE
Route::delete("/delete/{tipo}/{id}", "IpdvController@padraoRespDel");