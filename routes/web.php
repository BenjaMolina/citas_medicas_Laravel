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
    return view('app');
})->name('dashboard');


Route::resource('areas', 'AreasController');
Route::resource('clinicas', 'ClinicasController');
Route::resource('doctores', 'DoctoresController');
Route::resource('pacientes', 'PacientesController');
Route::resource('empleados', 'EmpleadosController');
Route::resource('citas', 'CitasController');
