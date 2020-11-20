@extends('layouts.body')


@section('css')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/pages/account.css')}}">


    <style>
        .genero_femenino{
            background-color:#FF33BE;
            color:white
        }
        .genero_masculino{
            background-color:#3364FF;
            color:white
        }
    </style>
@endsection

@section('contenido_page')

<?php
// print_r($user);
// print_r($domicilio);
?>

<div class="layout-content">

    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0">Configuración Cuenta</h4>
        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Configuración/</li>
            </ol>
        </div>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general"><i class="far fa-eye"></i> información</a>
                        @if ($user->tipo_usuario=="alumno")
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-escolar_alumno"><i class="far fa-eye"></i> Datos alumno</a>
                        @endif
                        @if ($user->tipo_usuario!="alumno" &&$user->tipo_usuario!="administrador")
                          <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-escolar_docente"><i class="far fa-eye"></i> Datos Docente</a>
                        @endif
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password"><i class="fas fa-key"></i> Cambiar contraseña</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="account-general">

                            <div class="card-body media align-items-center">
                            <img src="{{asset('storage').'/'.$user->photo}}" alt="{{$user->photo}}" class="d-block ui-w-80">
                                {{-- <div class="media-body ml-4">
                                    <label class="btn btn-outline-primary">
                                         Subir Imagen
                                        <input type="file" class="account-settings-fileinput">
                                    </label> &nbsp;
                                    <button type="button" class="btn btn-default md-btn-flat">Restablecer</button>
                                    <div class="text-light small mt-1">Permitidos JPG or PNG. Max Peso 2MB</div>
                                </div> --}}
                            </div>
                            <hr class="border-light m-0">

                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label"><strong>Nombre Completo</strong></label>
                                    <input type="text" class="form-control mb-1" value="{{ucwords($user->nombre." ".$user->ap_paterno." ".$user->ap_materno)}}" placeholder="Ingresa tu nombre" disabled>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><strong>CURP</strong></label>
                                    <input type="text" class="form-control mb-1" value="{{$user->curp}}" placeholder="Ingresa tu CURPP" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><strong>Correo</strong></label>
                                    <input type="text" class="form-control mb-1" value="{{$user->email}}" placeholder="Ingresa tu correo" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><strong>Telefono</strong></label>
                                    <input type="text" class="form-control mb-1" value="{{$user->telefono}}" placeholder="Ingresa tu correo" disabled>
                                </div>
                                <div class="form-group" style="display: flex; flex-wrap:wrap;">
                                    <label class="form-label" style="padding: 5px;"><strong>Fecha nacimiento</strong> <span class="badge" style="background-color:#CACACB"> {{$user->fecha_nacimiento}}</span></label>
                                    <?php
                                    $fechas_explode=explode("-",$user->fecha_nacimiento);
                                    $edad=date('Y')-$fechas_explode[0];
                                    ?>

                                    <label class="form-label" style="padding: 5px;"><strong>Edad</strong> <span class="badge badge-success">{{$edad}} años</span></label>
                                <label class="form-label" style="padding: 5px;"><strong>Genero</strong>
                                     <span class="badge {{$user->genero=='femenino'?'genero_femenino':'genero_masculino'}}">{{strtoupper($user->genero)}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" style="display:block;width:100%;"> <i class="fas fa-map-marked-alt"></i> <strong>Dirección</strong></label>
                                    <div class="col-sm-12">
                                        <div class="alert alert-light" role="alert">
                                            {{ucwords($domicilio->municipio.".".$domicilio->estado." ".$domicilio->tipoAsentamiento." ".$domicilio->asentamiento)}} c.p {{$domicilio->codigo}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($user->tipo_usuario=="alumno")
                        <div class="tab-pane fade" id="account-escolar_alumno">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label"><strong>Matricula</strong></label>
                                    <input type="password" class="form-control" placeholder="Ingresa tu matricula" disabled>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><strong>Carrera</strong></label>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><strong>Semestre</strong></label>

                                </div>
                                <div class="form-group">
                                    <label class="form-label"><strong>Turno</strong></label>

                                </div>
                                <div class="form-group">
                                    <label class="form-label"><strong>Periodo</strong></label>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($user->tipo_usuario!="alumno" &&$user->tipo_usuario!="administrador")
                            <div class="tab-pane fade" id="account-escolar_docente">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Cedula Profesional</label>
                                        <input type="text" class="form-control">
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                            </div>
                        @endif
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Contraseña actual</label>
                                    <input type="password" class="form-control">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nueva contraseña</label>
                                    <input type="password" class="form-control">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirmar nueva contraseña</label>
                                    <input type="password" class="form-control">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="text-right mt-3">
                                    <button type="button" class="btn btn-primary">Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ content ] End -->

    <!-- [ Layout footer ] Start -->
    <nav class="layout-footer footer footer-light">
        <div class="container-fluid d-flex flex-wrap justify-content-between text-center container-p-x pb-3">
            <div class="pt-3">
                <span class="float-md-right d-none d-lg-block">&copy; Exclusive on Themeforest | Hand-crafted &amp; Made with <i class="fas fa-heart text-danger mr-2"></i></span>
            </div>
            <div>
                <a href="javascript:" class="footer-link pt-3">About Us</a>
                <a href="javascript:" class="footer-link pt-3 ml-4">Help</a>
                <a href="javascript:" class="footer-link pt-3 ml-4">Contact</a>
                <a href="javascript:" class="footer-link pt-3 ml-4">Terms &amp; Conditions</a>
            </div>
        </div>
    </nav>
    <!-- [ Layout footer ] End -->

</div>
@endsection


@section('script')
<script src="{{asset('dashboard_assets/js/pages/pages_account-settings.js')}}"></script>

@endsection
