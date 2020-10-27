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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// admin-form-usuaurio-register
Route::get('Admin/Usuario/Nuevo', function () {
    return view('admin.usuario.create');
});


Route::get('/Admin/user','Admin\Usuario\UsuarioController@index');
Route::post('/Admin/user/Register', 'Admin\Usuario\UsuarioController@create');



// helpers
Route::post('/helpers/codePostal', 'helpers\CodepostalController@GetCodePostal');
