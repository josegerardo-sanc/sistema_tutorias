@extends('layouts.body')
@section('css')
<!-- Page -->
<link rel="stylesheet" href="{{asset('dashboard_assets/libs/select2/select2.css')}}">
<link rel="stylesheet" href="{{asset('dashboard_assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{asset('dashboard_assets/css/pages/users.css')}}">
@endsection

@section('contenido_page')


<div class="layout-content">

    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="display-4" style="color:#B16A26">Editar Usuario</h4>

        @include('admin.usuario.navar')

        {{-- <div class="row justify-content-end form-group">
            <div class="col-sm-2">
                <button id="btn_show_modal_preregistroUsuario" class="btn btn-info">PreRegistro</button>
            </div>
        </div> --}}

        {{--  modal PREREGISTRO --}}
        @include('admin.helpers.formularioPreRegistro')
        {{-- end modal PREREGISTRO --}}

        <div class="row">
            <div class="col-sm-12 list_error">
                <!--ampos invalidos o valor-->
            </div>
        </div>
        <div class="nav-tabs-top">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active btn_tab_conte_personal" data-toggle="tab" href="#user-edit-account">Datos
                        Personales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn_tab_conte_dtsAcademicos" data-toggle="tab" href="#user-edit-info"
                        style="display:none">Datos Académicos</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="user-edit-account">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <img src="{{asset('storage').'/'.$usersData[0]->photo}}" alt="upload_image"
                                class="d-block ui-w-80 image_perfil" style="max-width: 80px;">
                            <div class="media-body ml-3">
                                <label class="form-label d-block mb-2">Foto Perfil</label>
                                <label class="btn btn-outline-primary btn-sm">
                                    Buscar
                                    <input type="file" class="user-edit-fileinput file_usuario_image_search"
                                        name="file_perfil_img" accept="image/x-png, image/gif, image/jpeg">
                                </label>&nbsp;
                            </div>
                        </div>
                        <div class="Mensaje_Subida_Image"></div>
                    </div>
                    <hr class="border-light m-0">
                    <form action="#" id="formData_DatosPersonales">
                        {{ csrf_field() }}
                        <div class="card-body pb-2">

                            <div class="row form-group">
                                <div class="col-sm-12 form-group">
                                    <!-- parametros adicionales para el update -->
                                    <input value="{{$usersData[0]->id_user}}" name="id_user" id="id_user" type="hidden"
                                        style="opacity:0;" class="form-control">
                                    <input value="update_user" name="action_user_update" id="action_user_update"
                                        type="hidden" style="opacity:0;" class="form-control">
                                    <!-- nota: el tipo de usuario lo agrego mediante .js -->
                                    <label class="form-label">Tipos De Usuarios</label>
                                    <select class="form-control" name="tipo_usuario" id="tipo_usuario">
                                        <option selected disabled value="0">Seleccione Tipo Usuario</option>
                                        <option value="tutor">Tutor</option>
                                        <option value="asesor">Asesor</option>
                                        <option value="alumno">Alumno</option>
                                        <option value="director">Director Academico</option>
                                        <option value="subdirector">SubDirector Academico</option>
                                        <option value="administrador">Administrador</option>
                                    </select>
                                    <div id="content_error_tipo_usuario"></div>
                                </div>
                            </div>
                            <!-- fin -->
                            <div class="row form-group contenedor_referencia_btn_this">
                                <div class="col-sm-6 form-group">
                                    <label class="form-label">Curp</label>
                                    <input value="{{$usersData[0]->curp}}" name="curp" id="curp" type="text"
                                        class="form-control input_curp_validar " mamaxlength="18">
                                    <div class="content_error_curp">info de validacion de la curp</div>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <label class="form-label">RFC</label>
                                    <input value="{{$usersData[0]->rfc}}" name="rfc" id="rfc" type="text"
                                        class="form-control" maxlength="4">
                                </div>
                                <div class="col-sm-2 display:flex justify-content-end">
                                    <button class="btn btn-sm btn_validar_curp_api"
                                        style="background-color:#336BFF;color:white;">Validar Curp</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nombre Completo</label>
                                <input value="{{$usersData[0]->nombre}}" name="nombre" id="nombre" type="text"
                                    class="form-control mb-1" maxlength="20">
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-6 form-group">
                                    <label class="form-label">Apellido Paterno</label>
                                    <input value="{{$usersData[0]->ap_paterno}}" name="ap_paterno" id="ap_paterno"
                                        type="text" class="form-control" maxlength="15">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="form-label">Apellido Materno</label>
                                    <input value="{{$usersData[0]->ap_materno}}" name="ap_materno" id="ap_materno"
                                        type="text" class="form-control mb-1" maxlength="15">
                                </div>
                            </div>
                            <div class="row form-group mb-3">
                                <div class="col-sm-6 row">
                                    <label for="" class="col-sm-12 col-form-label" style="padding:10px;">Genero</label>
                                    <div class="col-sm-6 form-group">
                                        <label class="custom-control custom-checkbox m-0">
                                            <input name="genero" id="masculino" value="masculino" type="radio"
                                                class="custom-control-input">
                                            <span class="custom-control-label">Masculino</span>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="custom-control custom-checkbox m-0">
                                            <input name="genero" id="femenino" value="femenino" type="radio"
                                                class="custom-control-input">
                                            <span class="custom-control-label">Femenino</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <label for="" class="col-sm-12 col-for-label"  style="padding:10px;">Cuenta</label>
                                    <select name="status_cuenta_user_" id="status_cuenta_user_" class="col-sm-12 form-control">
                                        <option value="1" {{$usersData[0]->active=="1"?'selected':''}} >Activa</option>
                                        <option value="2" {{$usersData[0]->active=="2"?'selected':''}}>Inactiva</option>
                                        <option value="3" {{$usersData[0]->active=="3"?'selected':''}} disabled>Enverificación</option>
                                    </select>

                                    <!--
                                        $cuenta_status="";
                                        $cuenta_text="";

                                        if($usersData[0]->active=="1"){
                                            $cuenta_text="Activa";
                                            $cuenta_status="badge-success";
                                        }else if($usersData[0]->active=="2"){
                                            $cuenta_text="Inactiva";
                                            $cuenta_status="badge-warning";
                                        }else{
                                            $cuenta_text="Pendiente de verificación";
                                            $cuenta_status="badge-danger";
                                        }
                                    ?> -->
                                    <!-- {{-- <small>La cuenta se encuentra <span class="badge {$cuenta_status}" id="status_cuenta_badge">{$cuenta_text}</span></small> --}} -->
                                </div>
                            </div>

                            <div class="row form-group" style="margin-top:30px;">
                                <div class="col-sm-4 form-group">
                                    <label class="form-label">Fecha Nacimiento</label>
                                    <input value="{{$usersData[0]->fecha_nacimiento}}" name="fecha_nacimiento"
                                        id="fecha_nacimiento" type="date" class="form-control">
                                </div>
                                <div class="col-sm-4 form-group contenedor_principal_validar">
                                    <label class="form-label">Telefono</label>
                                    <input value="{{$usersData[0]->telefono}}" name="telefono" id="telefono" type="text"
                                        class="form-control validate_telefono_lada validar_numeric_input"
                                        maxlength="10">
                                    <div class="content_error_validar_lada"></div>
                                </div>
                                <div class="col-sm-4 form-group conte_email_validar">
                                    <label class="form-label">Correo</label>
                                    <input value="{{$usersData[0]->email}}" name="email" id="email" type="email"
                                        class="form-control valid_email_express_regular" maxlength="50">
                                    <div class="content_error_validate_email"></div>
                                </div>
                            </div>
                        </div>
                        {{-- DOMICILIO --}}
                        <div class="card-body ContenedorcodigoPostal_father">
                            <h5>Datos del domicilio</h5>
                            <div class="form-group">
                                <label class="form-label">Código Postal</label>
                                <div class="display:flex">
                                    <input value="{{$usersData[0]->code_postal}}" name="codigo_postal"
                                        id="codigo_postal" type="text" class="form-control mb-1 inputBuscarCodigoPostal"
                                        maxlength="5">
                                    <div class="alert alert-success conte_spiner_codePostal" style="display:none">Espere
                                        <i class="fas fa-spinner fa-spin"></i> ......
                                    </div>
                                    <div class="alert alert-danger conte_spiner_codePostal_error" style="display:none">
                                        <i class="fas fa-exclamation-triangle"></i> Verifique CodigoPostal ,No
                                        encontramos resultados
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 form-group" style="display: inline-block;">
                                    <label class="form-label">Estado</label>
                                    <select class="form-control estado_complete" name="estado" disabled>
                                        <option selected disabled value="0">Estado</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label class="form-label">Municipio</label>
                                    <select class="form-control municipio_complete" name="municipio" disabled>
                                        <option selected disabled value="0">Seleccione Municipio</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label class="col-form-label display:flex ">Localidad
                                        <span class="badge badge-pill badge-secondary tipoAsentamiento">info</span>
                                    </label>
                                    <select class="form-control localidad_complete" name="localidad"
                                        id="localidad_edit">
                                        <option selected disabled value="0">Seleccione Localidad</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="tab-pane fade" id="user-edit-info">
                    {{-- datos del alumno --}}
                    <div class="col-sm-12 alert alert-warning" role="alert" id="conte_informativo_tutor" style="display:none">
                        <i class="fas fa-exclamation-circle"></i> Los datos de asignación no se pueden actualizar ,en este formulario. solo se pueden visualizar </br>
                        <a href="/Admin/Asignacion/create" class="alert-link" style="text-decoration: underline">Actualizar asignación</a>.
                    </div>

                    <form action="#" id="formData_Datos_alumno">
                        <div class="card-body pb-2 ocultar_conte_usuario_ " id="conte_alumno_academico">
                            <div class="row form-group conte_referencs_matricula">
                                <div class="col-sm-12 form-group" id="matricula_escolar_conte">
                                    <label class="form-label">Matricula</label>
                                    <input name="matricula" id="matricula_escolar" type="text"
                                        class="form-control matricula_escolar_validar">
                                    <div class="contenedor_input_matricula_alumno"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-6 form-group">
                                    <label class="form-label">Semestre</label>
                                    <select name="semestre_escolar" id="semestre_escolar" class="form-control">
                                        <option value="0" disabled selected>Seleccione Semestre</option>
                                        <option value="1">1º Semestre</option>
                                        <option value="2">2º Semestre</option>
                                        <option value="3">3º Semestre</option>
                                        <option value="4">4º Semestre</option>
                                        <option value="5">5º Semestre</option>
                                        <option value="6">6º Semestre</option>
                                        <option value="7">8º Semestre</option>
                                        <option value="8">9º Semestre</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="form-label">Carrera <strong class="carreras_select_textError"></strong></label>
                                    <select  name="carrera_escolar" id="carrera_escolar" class="form-control carreras_select">
                                            <option value="0" disabled selected>Seleccione Carrera</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-4 form-group" id="periodo_escolar_conte">
                                    <label class="form-label">Periodo</label>
                                    <select class="form-control" name="periodo_escolar" id="periodo_escolar">
                                        <option value="0" disabled selected>Seleccione Periodo</option>
                                        <option value="1">FEBRERO-JULIO</option>
                                        <option value="2">AGOSTO-DICIEMBRE</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label class="form-label">Turno</label>
                                    <select class="form-control" name="turno_escolar" id="turno_escolar">
                                        <option value="0" disabled selected>Seleccione Turno</option>
                                        <option value="1">Matutino</option>
                                        <option value="2">Vespertino</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label class="form-label">Grupo</label>
                                    <select class="form-control" name="grupo_escolar" id="grupo_escolar">
                                        <option value="0" disabled selected>Seleccione Grupo</option>
                                        <option value="1">A</option>
                                        <option value="2">B</option>
                                    </select>
                                </div>
                            </div>
                            {{-- datos del docente --}}
                        </div>
                    </form>

                    <form action="#" id="formData_Datos_docente">
                        <div class="card-body pb-2 ocultar_conte_usuario_" id="conte_docente_academico">
                            <div class="row form-group">
                                <div class="col-sm-4 form-group">
                                    <label class="form-label">Cedula Profesional</label>
                                    <input name="cedula_profesional" id="cedula_profesioanl" type="text" class="form-control validar_numeric_input" maxlength="10">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-12 form-group">
                                    <label class="form-label">Estudios Académicos</label>
                                    <textarea name="estudio_academicos" id="estudio_academicos" cols="10" rows="10" class="form-control"
                                     style="border:1px solid #dddd" maxlength="150"></textarea>
                                </div>
                            </div>
                            <div class="row form-group" id="contenedor_horario_tutor" style="display: none">
                                <div class="col-sm-12">
                                    <button
                                        title="Horario del tutor"
                                        class="btn btn-info btn-block  float-right"
                                        type="button" id="btn_ver_horario">
                                        <i class="fas fa-clock"></i>
                                        Ver Horario
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-right mt-3">
                <button type="button" class="btn btn-primary" id="Admin_btnRegisterUser">Actualizar Usuario</button>&nbsp;
                <button type="button" class="btn btn-default reset_formulario">Limpiar</button>
            </div>
            @include('admin.asignaciones.horario_tutor')
        </div>
        <!-- [ content ] End -->
    </div>

    @endsection


    @section('script')
    <script src="{{asset('js/helpers/GetCarreras.js')}}"></script>

    <script src="{{asset('js/helpers/verificarLada.js')}}"></script>

    <script src="{{asset('dashboard_assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('dashboard_assets/libs/select2/select2.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/pages/pages_users_edit.js')}}"></script>

    <script src="{{asset('js/helpers/helpersCurpAPI.js')}}"></script>
    <script src="{{asset('js/helpers/codepostal.js')}}"></script>
    <script src="{{asset('js/helpers/ValidarEMAIL_TELEFONO.js')}}"></script>
    <script src="{{asset('js/helpers/ValidarMatriculaAlumno.js')}}"></script>

    <script src="{{asset('js/admin/asignacion_tutor.js')}}"></script>
    <script src="{{asset('js/admin/register_user.js')}}"></script>


    <script>

    let tipo_user_selected = "<?php echo $usersData[0]->tipo_usuario ?>";
    $('#tipo_usuario').val(tipo_user_selected);
    //console.log(tipo_user_selected);

    $('#conte_alumno_academico').hide();
    $('#conte_docente_academico').hide();


    if (tipo_user_selected == "alumno") {

        let periodo_selected = "<?php echo isset($usersData[0]->periodo)?$usersData[0]->periodo:''; ?>"
        //console.log(periodo_selected);
        if (periodo_selected == "FEBRERO-JULIO") {
            periodo_selected = 1;
        } else {
            periodo_selected = 2;
        }
        $('#matricula_escolar').val("<?php echo isset($usersData[0]->matricula)?$usersData[0]->matricula:''; ?>");
        $('#periodo_escolar').val(periodo_selected);
        $('#semestre_escolar').val("<?php echo isset($usersData[0]->semestre)?$usersData[0]->semestre:''; ?>");

        setTimeout(() => {
            $('#carrera_escolar').val("<?php echo isset($usersData[0]->id_carrera)?$usersData[0]->id_carrera:''; ?>");
        }, 1000);


        $('#grupo_escolar').val("<?php echo isset($usersData[0]->grupo)?$usersData[0]->grupo=='A'?'1':'2':''; ?>");
        $('#turno_escolar').val("<?php echo isset($usersData[0]->turno)?$usersData[0]->turno=='Matutino'?'1':'2':''; ?>");


        $('.btn_tab_conte_dtsAcademicos').css({
            'display': ''
        }).html('Datos alumno').show();
        $('#conte_alumno_academico').show();

    } else if (tipo_user_selected == "director" || tipo_user_selected == "subdirector") {

        let cedula_profesioanl =
            "<?php echo isset($usersData[0]->cedula_profesional)?$usersData[0]->cedula_profesional:''; ?>"
        $('#cedula_profesioanl').val(cedula_profesioanl);

        let estudio_academicos =
            "<?php echo isset($usersData[0]->estudios_docente)?$usersData[0]->estudios_docente:''; ?>"
        $('#estudio_academicos').val(estudio_academicos);


        $('.btn_tab_conte_dtsAcademicos').css({
            'display': ''
        }).html('Datos académicos').show();
        $('#conte_docente_academico').show();


    }else if(tipo_user_selected=="tutor"){

        let cedula_profesioanl =
            "<?php echo isset($usersData[0]->cedula_profesional)?$usersData[0]->cedula_profesional:''; ?>"
        $('#cedula_profesioanl').val(cedula_profesioanl);

        let estudio_academicos =
            "<?php echo isset($usersData[0]->estudios_docente)?$usersData[0]->estudios_docente:''; ?>"
        $('#estudio_academicos').val(estudio_academicos);


        $('#semestre_escolar').val("<?php echo isset($usersData[0]->semestre)?$usersData[0]->semestre:''; ?>").attr('disabled','disabled');
        setTimeout(() => {
            $('#carrera_escolar').val("<?php echo isset($usersData[0]->id_carrera)?$usersData[0]->id_carrera:''; ?>").attr('disabled','disabled');
        }, 1000);

        $('#grupo_escolar').val("<?php echo isset($usersData[0]->grupo)?$usersData[0]->grupo=='A'?'1':'2':''; ?>").attr('disabled','disabled');
        $('#turno_escolar').val("<?php echo isset($usersData[0]->turno)?$usersData[0]->turno=='Matutino'?'1':'2':''; ?>").attr('disabled','disabled');


        $('#matricula_escolar_conte').css({'display':'none'});
        $('#periodo_escolar_conte').css({'display':'none'});

        $('#contenedor_horario_tutor').css({'display':''});
        $('#conte_alumno_academico').show();


        $('.btn_tab_conte_dtsAcademicos').css({
            'display': ''
        }).html('Datos tutor').show();
        $('#conte_docente_academico').show();


        $('#conte_informativo_tutor').css({'display':'none'});

        let horario =JSON.parse({!! isset($usersData[0]->horario)?json_encode($usersData[0]->horario):"{}" !!});
        console.log(horario);
        // var horario_asignadas_tutor=horario;
        // console.log(horario)
        Mostrar_Horario_tutor(horario);

    }

    $('.inputBuscarCodigoPostal').keyup();



    let localidad_selected = "<?php echo $usersData[0]->localidad ?>";
    console.log(localidad_selected);
    setTimeout(() => {
        $('#localidad_edit').val(localidad_selected);
    }, 2000);


    let is_genero = "<?php echo $usersData[0]->genero ?>";

    if (is_genero == "masculino") {
        $('#masculino').attr('checked', true);
    } else {
        $('#femenino').attr('checked', true);
    }



    $('#btn_ver_horario').on('click',function(){
        $('.btn_btn_restablecer_horario').css({'display':'none'})
        $('#modal_horario_tutor').modal('show');
    })



    </script>

    @endsection
