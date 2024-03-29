<?php


// Route::get('/generar/pdf/pruebas','PDF\pdfController@pruebas_pdf');


Route::post('/generar_pdf','PDF\pdfController@usuarios');
Route::post('/generar_pdf/evaluacion','PDF\pdfController@evaluacion');

Route::get('/modificar_archivo_env','PDF\pdfController@modif_env');


Route::get('/plantilla/correo', function () {
    // return "plantilla de correo";
    return view('Correos.nuevo_password');
});

Route::get('/', function () {
    //return view('welcome');
    return view('inicio');
})->name('inicio');

// Auth::routes();


Route::get('login/{driver}', 'loginController@redirectToProvider');
Route::get('login/{driver}/callback', 'loginController@handleProviderCallback');

Route::get('/seguimientoActividad/tutorial/','Admin\evaluaciones\evaluacionController@seguimientoActividadTutorial');
Route::get('/downloadFormato/{id}', 'UploadsFormatosController@download_archivo');
Route::post('/pdftutor','PDF\pdfController@Evaluaciontutor');
// graficar
Route::get('/evaluacion','Admin\evaluaciones\evaluacionController@index');
// Route::get('/seguimientoActividad/tutorial/','Admin\evaluaciones\evaluacionController@seguimientoActividadTutorial');
Route::post('/seguimientoActividad/tutorial/enviarData','Admin\evaluaciones\evaluacionController@seguimientoActividadTutorialStore');
Route::post('/obtenerlistaSegumiento/tutorial','Admin\evaluaciones\evaluacionController@obtenerlistaSegumiento');

Route::group(['middleware' => ['role:Administrador','auth']], function () {



    // carreras

    Route::resource('/Admin/carreras','Admin\carreraController');
    Route::resource('/Admin/user','Admin\Usuario\UsuarioController');
    Route::post('/Admin/user/cuenta', 'Admin\Usuario\UsuarioController@cuentaUser');
    Route::post('/Admin/user/actualizar/{id}', 'Admin\Usuario\UsuarioController@actualizar');
    Route::get('/Admin/user/{id}/eliminar', 'Admin\Usuario\UsuarioController@eliminar_usuario');
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
    // Route::get('/downloadFormato/{id}', 'UploadsFormatosController@download_archivo');

    // REPORTES ENVIADOS POR LOS TUTORES
    Route::get('/reportes/reportes_enviados', 'UploadsFormatosController@reportes_enviados');
    Route::get('/reportes/{id_tutor}/tutor/{id_carrera}', 'UploadsFormatosController@listar_reportes_tutor_selecionado');
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


//helpers
Route::post('/Admin/carreras/getCarreras','Admin\carreraController@getCarreras');
// helpers
Route::post('/helpers/codePostal', 'helpers\CodepostalController@GetCodePostal');
Route::post('/carrera/tutoresAsignados/{id}', 'helpers\CodepostalController@tutoresAsignados');

// login
Route::post('/IniciarSesion', 'loginController@IniciarSesion');
Route::post('/cerrarSesion', 'loginController@cerrarSesion');

//restablecer password



Route::get('/recuperar/password', function () {

    // 1.-vista para enviar correo con el enlace
    return view('Correos.formulario_resetPassword');

});
# 2.-esta ruta es la que envia el correo generando el enlace
Route::post('/enviarCorreo_resetPassword', 'loginController@enviarCorreo_resetPassword');


#3.-esta ruta es la qie valida el enlace y te redirecciona ala vista de ingresar las nueva contraseña
Route::get('/password_reset/user/{id}', 'loginController@redirect_view_password_reset_user');

# 4.- guardar la contraseña que ingreso el usuario
Route::post('/NuevoPassword_user/update', 'loginController@NuevoPassword_user');
Route::post('/SocialProfile', 'loginController@SocialProfile');



Route::get('/account_settings/{nombre}', 'loginController@perfil_account_settings_view');//authenticate
Route::post('/change_password_user', 'loginController@change_password_user');//authenticate
Route::post('/change_cuentas_social', 'loginController@change_cuentas_social');//authenticate
Route::get('/ConfirmCorreo/{token}', 'loginController@ConfirmCorreo');//debe existir un id


