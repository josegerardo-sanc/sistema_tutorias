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

Route::group(['middleware' => ['role:Administrador','auth']], function () {
    // carreras
    Route::resource('/Admin/carreras','Admin\carreraController');
    Route::resource('/Admin/user','Admin\Usuario\UsuarioController');
    Route::post('/Admin/user/cuenta', 'Admin\Usuario\UsuarioController@cuentaUser');
    Route::post('/Admin/user/actualizar/{id}', 'Admin\Usuario\UsuarioController@actualizar');
    // asignacion grupal
    Route::resource('/Admin/Asignacion', 'Admin\Usuario\AsignacionesController');
    Route::post('/Admin/Asignacion/getListaAlumnos', 'Admin\Usuario\AsignacionesController@getListaAlumnos');

    // asignacion individual
    Route::resource('/Admin/AsignacionIndividual', 'Admin\Usuario\asignacionIndividualController');
    Route::post('/Admin/AsignacionIndividual/tipoUsuarioData', 'Admin\Usuario\asignacionIndividualController@tipoUsuarioData');

    // formatos
    Route::get('/formatos', 'UploadsFormatosController@formatosIndex');
    Route::post('/subirFormato', 'UploadsFormatosController@SubirFormato');
    Route::post('/DeleteFormato', 'UploadsFormatosController@DeleteArchivo');
    Route::get('/downloadFormato/{id}', 'UploadsFormatosController@download_archivo');
});


Route::group(['middleware' => ['role:Tutor','auth']], function () {
        // alumnos
        Route::resource('/tutor', 'Tutor\AlumnosController');
        Route::resource('/tutor/registerAlumno', 'Tutor\AlumnosController@registerAlumnos');
        Route::resource('/tutor/actualizarAlumno/{id}', 'Tutor\AlumnosController@actualizarAlumnos');
        //reportes
        Route::get('/reportes', 'ArchivosUploadsController@reportesIndex');
        Route::post('/subirReporte', 'ArchivosUploadsController@SubirReporte');
        Route::post('/DeleteArchivo', 'ArchivosUploadsController@DeleteArchivo');
        Route::get('/download_archivo/{id}', 'ArchivosUploadsController@download_archivo');
});

Route::group(['middleware' => ['role:Alumno','auth']], function () {

});

Route::group(['middleware' => ['role:Asesor','auth']], function () {

});

Route::group(['middleware' => ['role:Director','auth']], function () {

});
Route::group(['middleware' => ['role:SubDirector','auth']], function () {

});




// helpers
Route::post('/Admin/carreras/getCarreras','Admin\carreraController@getCarreras');
Route::post('/helpers/codePostal', 'helpers\CodepostalController@GetCodePostal');

// login
Route::post('/IniciarSesion', 'loginController@IniciarSesion');
Route::post('/cerrarSesion', 'loginController@cerrarSesion');

Route::get('/account_settings/{nombre}', 'loginController@perfil_account_settings_view');//authenticate
Route::post('/change_password_user', 'loginController@change_password_user');//authenticate
Route::get('/ConfirmCorreo/{token}', 'loginController@ConfirmCorreo');//debe existir un id


