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

// Route::get('/plantilla/correo', function () {
//     // return "plantilla de correo";
//     return view('correos.RegistroUsuario_new');
// });


Route::get('/', function () {
    //return view('welcome');
    return view('inicio');
});

// Auth::routes();

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


    // REPORTES ENVIADOS POR LOS TUTORES
    Route::get('/reportes/reportes_enviados', 'UploadsFormatosController@reportes_enviados');
    Route::post('/reportes/reportes_enviados/list', 'UploadsFormatosController@reportes_enviadosListar');

});


Route::group(['middleware' => ['role:Tutor','auth']], function () {
        // alumnos
        Route::resource('/tutor', 'Tutor\AlumnosController');

        Route::post('/tutor/registerAlumno', 'Tutor\AlumnosController@registerAlumnos');
        Route::post('/tutor/actualizarAlumno/{id}', 'Tutor\AlumnosController@actualizarAlumnos');

        //formatosTutores
        Route::resource('/formatosTutores', 'Tutor\FormatosTutoresController');
        Route::post('/formatosTutores/formatos', 'Tutor\FormatosTutoresController@formatosIndex');
        Route::get('/formatosTutores/downloadFormato/{id}', 'Tutor\FormatosTutoresController@downloadFormato');

        //reportes
        Route::get('/reportes', 'ArchivosUploadsController@reportesIndex');
        Route::post('/subirReporte', 'ArchivosUploadsController@SubirReporte');
        Route::post('/DeleteArchivo', 'ArchivosUploadsController@DeleteArchivo');
        Route::get('/download_archivo/{id}', 'ArchivosUploadsController@download_archivo');
});

Route::group(['middleware' => ['role:Alumno','auth']], function () {
    Route::get('/alumno', 'Alumno\AlumnoController@index');
    Route::get('/alumno/miTutor', 'Alumno\AlumnoController@miTutor');


    //formatosAlumno
    Route::get('/formatosAlumnos', 'Alumno\AlumnoController@page_formatos_alumnos');
    Route::post('/formatosAlumnos/formatos', 'Alumno\AlumnoController@formatosIndex');
    Route::get('/formatosAlumnos/formatos/downloadFormato/{id}', 'Alumno\AlumnoController@downloadFormato');


    // cuestionario grupal
    Route::get('/alumnoCuestionario/grupal', 'Alumno\CuestionarioController@pageCuestionarioGrupal');
    Route::post('/alumnoCuestionario/Registrar', 'Alumno\CuestionarioController@RegistrarMi_CuestionarioGrupal');

    // Cuestionarioindividual
    Route::get('/alumnoCuestionario/individual', 'Alumno\CuestionarioController@pageCuestionarioIndividual');
    Route::post('/alumnoCuestionario/RegistrarCuestioarioIndividual', 'Alumno\CuestionarioController@RegistrarMi_CuestionarioIndividual');

});


Route::group(['middleware' => ['role:Director','auth']], function () {

    // REPORTES
    Route::get('/director', 'Director\FormatosController@reportes_enviados');
    Route::post('/director/reportes_enviados/list', 'Director\FormatosController@reportes_enviadosListar');
    Route::get('/director/downloadFormato/{id}', 'Director\FormatosController@download_archivo');

    Route::get('/director/formatos', 'Director\FormatosController@formatos_enviados');
    Route::post('/director/formatosListar', 'Director\FormatosController@formatos_enviadosListar');



});

Route::group(['middleware' => ['role:Subdirector','auth']], function () {

    Route::get('/subdirector', 'Subdirector\archivosController@reportes_enviados');
    Route::post('/subdirector/reportes_enviados/list', 'Subdirector\archivosController@reportes_enviadosListar');
    // Route::get('/subdirector/downloadFormato/{id}', 'Subdirector\archivosController@download_archivo');

    Route::get('/subdirector/formatos', 'Subdirector\archivosController@formatos_enviados');
    Route::post('/subdirector/formatosListar', 'Subdirector\archivosController@formatos_enviadosListar');
});


// helpers
Route::post('/Admin/carreras/getCarreras','Admin\carreraController@getCarreras');
// helpers
Route::post('/helpers/codePostal', 'helpers\CodepostalController@GetCodePostal');
Route::post('/carrera/tutoresAsignados/{id}', 'helpers\CodepostalController@tutoresAsignados');

// login
Route::post('/IniciarSesion', 'loginController@IniciarSesion');
Route::post('/cerrarSesion', 'loginController@cerrarSesion');

Route::get('/account_settings/{nombre}', 'loginController@perfil_account_settings_view');//authenticate
Route::post('/change_password_user', 'loginController@change_password_user');//authenticate
Route::get('/ConfirmCorreo/{token}', 'loginController@ConfirmCorreo');//debe existir un id


