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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'web'], function () {
    Route::get(env('LARAVUE_PATH'), 'LaravueController@index')->where('any', '.*')->name('laravue');
});
Route::get('/ordentrabajo', 'OrdenTrabajoController@all')->name('ordentrabajo.all');
Route::get('/ordenesdashboard', 'OrdenTrabajoController@ordenes_dashboard')->name('ordentrabajo.ordenes_dashboard');
Route::post('/updateOrdenTrabajodashboard','OrdenTrabajoController@updatesdesdedash');

Route::get('/material-en-ordenes/{id}', 'MaterialController@MaterialesEnOrdendes')->name('material.MaterialesEnOrdendes');
Route::get('/trear_ordenes_materiales/{id}', 'OrdenTrabajoMaterialController@ordenes_para_un_material')->name('ordenestrabajomateriales.trear_ordenes_materiales');
