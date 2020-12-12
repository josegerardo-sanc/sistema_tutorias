
@extends('layouts.body')

@section('css')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/quill/typography.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/quill/editor.css')}}">

    <style>
        .label_filter{
            display:flex;
            justify-content:start;
            color:hsl(215, 76%, 52%);
            padding:10px;

        }

        .selected_tipo_user{
            display: block;
            padding:10px;
            border:1px solid #E3E3E5;
            border-radius:8px;
        }

        .pagination_a_event{
           background-color:white;
        }

    </style>
@endsection

@section('contenido_page')
    <!-- [ Layout content ] Start -->
    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <h4 class="display-4" style="color:#DF480F">Lista de compañeros</h4>
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="feather icon-user"></i></a></li>
                    <li class="breadcrumb-item active">Compañeros</li>
                </ol>
            </div>
            <div class="col-sm-12 contenedor_exception">

            </div>
            @if(session('status_confirm'))
                <div class="col-sm-12 conte_confirm_success" style="margin:15px 0px;">
                    <div class="alert alert-success">
                        {{ session('status_confirm') }} <i class="fas fa-grin-stars"></i>
                        </div>
                </div>
            @endif
            <div class="card">
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-sm-6 pb-4">
                            <div class="media  mb-4">
                                <a href="index.html" class="navbar-brand app-brand demo py-0 mr-4">
                                    <span class="app-brand-logo demo">
                                        {{-- <img src="assets/img/logo-dark.png" alt="Brand Logo" class="img-fluid"> --}}
                                        <img  src="{{asset('storage').'/Recursos_sistema/itss.jpg'}}" style="height:80px;object-fit: cover;" alt="logo">
                                    </span>
                                    <span class="app-brand-text demo font-weight-bold text-dark ml-2">Instituto Tecnológico Superior de la Región Sierra.</span>
                                </a>
                            </div>
                        </div>
                        <!--1 liveline-section -->
                        <div class="col-sm-12 row contenedor_card_users" style="width:!00%;">
                         @forelse  ($alumnos as $usuario)

                            <?php
                            $cuenta_status="";
                            $cuenta_text="";

                            if($usuario->active==1){
                               $cuenta_text="Activo";
                               $cuenta_status="badge-success";
                            }else if($usuario->active==2){
                                $cuenta_text="Inactivo";
                                $cuenta_status="badge-warning";
                            }else{
                                $cuenta_text="Pendiente";
                                $cuenta_status="badge-danger";
                            }

                            ?>

                            <div class="col-lg-4 col-md-6">
                                <div class="card user-card user-card-1 mt-4">
                                    <div class="card-body conte_user" data-id_user="{{$usuario->id}}" data-status_cuenta="{{ $cuenta_text}}" data-user_name="{{ $usuario->nombre }}">
                                        <div class="user-about-block text-center">
                                            <div class="row align-items-start">
                                                <div class="col text-left pb-3">
                                                    <span class="badge {{ $cuenta_status}} btn_cuenta_user">{{$cuenta_text}}</span>
                                                </div>
                                                <div class="col"><img class="img-radius img-fluid wid-80"
                                                  src="{{asset('storage').'/'.$usuario->photo}}" style="height:80px;object-fit: cover;"
                                                  alt="Foto de perfil"></div>
                                                <div class="col text-right pb-3">
                                                    {{-- <div class="dropdown">
                                                        <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item btn_editar_user_index" href="{{url('/Admin/user/'.$usuario->id.'/edit')}}">Edit</a>

                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <a href="#!" data-toggle="modal" data-target="#modal-report">
                                                <!-- {{strlen($usuario->nombre)}} -->
                                                <h4 class="mb-1 mt-3">
                                                  {{ ucwords(strlen($usuario->nombre)>20
                                                    ?substr($usuario->nombre,0,20).'..'
                                                    :$usuario->nombre)
                                                  }}
                                                </h4>
                                            </a>

                                            <p class="mb-3 text-muted"><i class="fas fa-user-tag"></i> </i>{{$usuario->tipo_usuario}} </p>
                                            <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">{{$usuario->email }}</a></p>
                                            <p class="mb-1"><b>Matricula : </b><a href="mailto:dummy@example.com">{{$usuario->matricula }}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @empty
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h4 class="display-4 text-muted">No se han encontrado resultados.</h4>
                                    </div>
                                </div>
                            </div>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ content ] End -->
    </div>
    <!-- [ Layout content ] Start -->
@endsection


@section('script')

<script>


</script>

@endsection
