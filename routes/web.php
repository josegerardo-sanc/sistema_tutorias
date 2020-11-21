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
    return view('inicio');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// admin-form-usuaurio-register



#Route::get('/Admin/user','Admin\Usuario\UsuarioController@index');
Route::resource('/Admin/user','Admin\Usuario\UsuarioController');
Route::post('/Admin/user/cuenta', 'Admin\Usuario\UsuarioController@cuentaUser');
Route::post('/Admin/user/actualizar/{id}', 'Admin\Usuario\UsuarioController@actualizar');
Route::resource('/Admin/Asignacion', 'Admin\Usuario\AsignacionesController');
Route::post('/Admin/Asignacion/getListaAlumnos', 'Admin\Usuario\AsignacionesController@getListaAlumnos');



// helpers
Route::post('/helpers/codePostal', 'helpers\CodepostalController@GetCodePostal');

// login
Route::post('/IniciarSesion', 'loginController@IniciarSesion');
Route::post('/cerrarSesion', 'loginController@cerrarSesion');
Route::get('/account_settings/{nombre}', 'loginController@perfil_account_settings_view');
Route::post('/change_password_user', 'loginController@change_password_user');
