<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//ruta home con DashboardController
Route::get('/home', 'App\Http\Controllers\DashboardController@index')->name('home');
/*RUTA DIRECTORES */
Route::get('/director', 'App\Http\Controllers\DirectorController@index')->name('ScreenDirector');
Route::post('/director/eliminar/{id}', 'App\Http\Controllers\DirectorController@eliminar')->name('director.eliminar');
Route::get('/director/{id}', 'App\Http\Controllers\DirectorController@show')->name('director.show');
Route::post('/director/actualizar/{id}', 'App\Http\Controllers\DirectorController@actualizar')->name('director.actualizar');
Route::post('/director/agregar', 'App\Http\Controllers\DirectorController@guardar')->name('director.agregar');
//FIN RUTA DIRECTORES

