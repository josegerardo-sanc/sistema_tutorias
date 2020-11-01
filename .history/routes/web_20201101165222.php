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
    //return view('welcome');
    return redirect('/Admin/user');

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// admin-form-usuaurio-register



#Route::get('/Admin/user','Admin\Usuario\UsuarioController@index');
Route::resource('/Admin/user','Admin\Usuario\UsuarioController');
Route::post('/Admin/user/cuenta', 'Admin\Usuario\UsuarioController@cuentaUser');
Route::post('/Admin/user/actualizar/{id}', 'Admin\Usuario\UsuarioController@actualizar');

Route::resource('/Admin/Asignacion', 'Admin\Usuario\UsuarioController');



// helpers
Route::post('/helpers/codePostal', 'helpers\CodepostalController@GetCodePostal');
