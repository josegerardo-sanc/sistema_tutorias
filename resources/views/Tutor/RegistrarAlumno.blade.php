
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
        <h4 class="display-4" style="color:#DF480F">Nuevo Alumno</h4>

        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                <li class="breadcrumb-item" ><a href="{{ url('/tutor')}}">Mis alumnos</a></li>
                @if (count($asignaciones)>0)
                    <li class="breadcrumb-item active open_modal_new_alumno active" >
                        <a href="{{url('/tutor/create')}}">Registrar alumno</a>
                    </li>
                @endif
            </ol>
        </div>

        <div class="row">
            <div class="col-sm-12 list_error">
                <!--ampos invalidos o valor-->
            </div>
        </div>
        <div class="nav-tabs-top">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active btn_tab_conte_personal" data-toggle="tab" href="#user-edit-account">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn_tab_conte_dtsAcademicos" data-toggle="tab" href="#user-edit-info">Datos Académicos</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="user-edit-account">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <img src="{{asset('storage').'/Recursos_sistema/upload_image.png'}}" alt="upload_image"
                            class="d-block ui-w-80 image_perfil"
                            style="max-width: 80px;"
                            >
                                <div class="media-body ml-3">
                                    <label class="form-label d-block mb-2">Foto Perfil</label>
                                    <label class="btn btn-outline-primary btn-sm">
                                        Buscar
                                        <input type="file" class="user-edit-fileinput file_usuario_image_search"  name="file_perfil_img" accept="image/x-png, image/gif, image/jpeg">
                                    </label>&nbsp;
                                </div>
                        </div>
                        <div class="Mensaje_Subida_Image"></div>
                    </div>
                    <hr class="border-light m-0">
                    <form action="#" id="formData_DatosPersonales">
                        {{ csrf_field() }}
                        <div class="card-body pb-2">

                            <div class="form-group" style="display: none;">
                                <label class="form-label">Tipos De Usuarios</label>
                                <input type="text" name="tipo_usuario" id="tipo_usuario" value="alumno">
                                <div id="content_error_tipo_usuario"></div>
                            </div>
                            <div class="row form-group contenedor_referencia_btn_this">
                                <div class="col-sm-6 form-group">
                                    <label class="form-label">Curp</label>
                                    <input name="curp" id="curp" type="text" class="form-control input_curp_validar "  mamaxlength="18">
                                    <div class="content_error_curp">info de validacion de la curp</div>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <label class="form-label" style="display: flex; justify-content:space-between">
                                        <strong>RFC</strong>
                                        <small class="text-muted">Opcional</small>
                                    </label>
                                    <input name="rfc" id="rfc" type="text" class="form-control" maxlength="4">
                                </div>

                                <div class="col-sm-2 form-group">
                                    <button  class="btn btn-sm btn_validar_curp_api" style="background-color:#336BFF;color:white;">Validar Curp</button>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="form-label">Nombre Completo</label>
                                <input name="nombre" id="nombre" type="text" class="form-control mb-1" maxlength="20">
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-6 form-group">
                                    <label class="form-label">Apellido Paterno</label>
                                    <input name="ap_paterno" id="ap_paterno" type="text" class="form-control" maxlength="15">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="form-label">Apellido Materno</label>
                                    <input name="ap_materno" id="ap_materno" type="text" class="form-control mb-1"  maxlength="15">
                                </div>
                            </div>
                            <div class="row form-group mb-3">
                                <label for="" class="col-sm-12 form-label">Genero</label>
                                <div class="col-sm-3 form-group">
                                    <label class="custom-control custom-checkbox m-0">
                                        <input name="genero" id="masculino" value="masculino" type="radio"  class="custom-control-input">
                                        <span class="custom-control-label">Masculino</span>
                                    </label>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label class="custom-control custom-checkbox m-0">
                                        <input name="genero" id="femenino" value="femenino" type="radio" class="custom-control-input">
                                        <span class="custom-control-label">Femenino</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-4 form-group">
                                    <label class="form-label">Fecha Nacimiento</label>
                                    <input name="fecha_nacimiento" id="fecha_nacimiento" type="date" class="form-control">
                                </div>
                                <div class="col-sm-4 form-group contenedor_principal_validar">
                                    <label class="form-label">Telefono</label>
                                    <input name="telefono" id="telefono" type="text" class="form-control validate_telefono_lada validar_numeric_input"  maxlength="10">
                                    <div class="content_error_validar_lada"></div>
                                </div>
                                <div class="col-sm-4 form-group conte_email_validar">
                                    <label class="form-label">Correo</label>
                                    <input name="email" id="email" type="email" class="form-control valid_email_express_regular"  maxlength="50">
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
                                    <input name="codigo_postal" id="codigo_postal" type="text" class="form-control mb-1 inputBuscarCodigoPostal"  maxlength="5">
                                    <div class="alert alert-success conte_spiner_codePostal" style="display:none">Espere <i class="fas fa-spinner fa-spin"></i> ......</div>
                                    <div class="alert alert-danger conte_spiner_codePostal_error" style="display:none"><i class="fas fa-exclamation-triangle"></i> Verifique CodigoPostal ,No encontramos resultados  </div>
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
                                    <select class="form-control municipio_complete" name="municipio"  disabled>
                                        <option selected disabled value="0">Seleccione Municipio</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label class="col-form-label display:flex ">Localidad
                                        <span class="badge badge-pill badge-secondary tipoAsentamiento">info</span>
                                    </label>
                                    <select class="form-control localidad_complete" name="localidad" >
                                        <option selected disabled value="0">Seleccione Localidad</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="tab-pane show" id="user-edit-info">
                     {{-- datos del alumno --}}
                     <form action="#" id="formData_Datos_alumno">
                        <div class="card-body pb-2 ocultar_conte_usuario_ " id="conte_alumno_academico">
                            <div class="row form-group conte_referencs_matricula">
                                <div class="col-sm-12 form-group">
                                    <label class="form-label">Matricula</label>
                                    <input name="matricula" id="matricula_escolar" type="text"  class="form-control matricula_escolar_validar">
                                    <div class="contenedor_input_matricula_alumno"></div>
                                </div>
                            </div>
                                <div class="row form-group">
                                    <div class="col-sm-6 form-group">
                                            <label class="form-label">Semestre</label>
                                            <select  name="semestre_escolar" id="semestre_escolar" class="form-control" disabled>
                                                 <option value="{{$asignaciones[0]->semestre }}" selected>{{$asignaciones[0]->semestre }}º Semestre</option>
                                            </select>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form-label">Carrera <strong class="carreras_select_textError"></strong></label>
                                        <select  name="carrera_escolar" id="carrera_escolar" class="form-control carreras_select" disabled>
                                            <option value="{{$asignaciones[0]->id_carrera }}" selected> {{$asignaciones[0]->name_carrera }}</option>
                                        </select>
                                     </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-sm-4 form-group">
                                        <label class="form-label">Periodo {{date('Y')}}</label>
                                        <select class="form-control" name="periodo_escolar" id="periodo_escolar">
                                            <option value="0" disabled selected>Seleccione Periodo</option>
                                            <option value="1">FEBRERO-JULIO</option>
                                            <option value="2">AGOSTO-DICIEMBRE</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label class="form-label">Turno</label>
                                        <select class="form-control" name="turno_escolar" id="turno_escolar" disabled>
                                            <option value="{{$asignaciones[0]->turno }}" selected> {{$asignaciones[0]->turno }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label class="form-label">Grupo</label>
                                        <select class="form-control" name="grupo_escolar" id="grupo_escolar" disabled>
                                            <option value="{{$asignaciones[0]->grupo }}" selected> {{$asignaciones[0]->grupo }}</option>
                                        </select>
                                    </div>
                                </div>
                            {{-- datos del docente --}}
                        </div>
                    </form>
                </div>
        </div>
        <div class="text-right mt-3">
            <button type="button" class="btn btn-primary btn_alumno_send_db">Registar Alumno</button>&nbsp;
            <button type="button" class="btn btn-default reset_formulario">Limpiar</button>
        </div>

    </div>
    <!-- [ content ] End -->
</div>

@endsection


@section('script')


{{-- <script src="{{asset('js/helpers/GetCarreras.js')}}"></script> --}}
<script src="{{asset('dashboard_assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('dashboard_assets/libs/select2/select2.js')}}"></script>
<script src="{{asset('dashboard_assets/js/pages/pages_users_edit.js')}}"></script>

{{-- recursos propios --}}
<script src="{{asset('js/helpers/verificarLada.js')}}"></script>
<script src="{{asset('js/helpers/helpersCurpAPI.js')}}"></script>
<script src="{{asset('js/helpers/codepostal.js')}}"></script>
<script src="{{asset('js/helpers/ValidarEMAIL_TELEFONO.js')}}"></script>
<script src="{{asset('js/helpers/ValidarMatriculaAlumno.js')}}"></script>
<script src="{{asset('js/tutor/alumno.js')}}"></script>


@endsection