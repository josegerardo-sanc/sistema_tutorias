
@extends('layouts.body')

@section('css')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/quill/typography.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/quill/editor.css')}}">
@endsection

@section('contenido_page')
    <!-- [ Layout content ] Start -->
    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <h4 class="font-weight-bold py-3 mb-0">User Management</h4>
            @include('admin.usuario.navar')


            <div class="col-sm-12 contenedor_exception">

            </div>
            <div class="row justify-content-center">
                <!--1 liveline-section -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6 text-left">
                                    <h5>Filtrar Busqueda</h5>
                                </div>
                                <div class="col-sm-12 row">
                                    <div class="col-sm-4 form-group">
                                        <label for="" class="col-form-label d-flex justify-content-start" style="color:#1D62D3;">Tipo de usuario</label>
                                        <select class="form-control" name="tipo_usuario_search" id="tipo_usuario_search">
                                            <option selected disabled value="0">Seleccione  Tipo  Usuario</option>
                                            <option value="tutor">Tutor</option>
                                            <option value="asesor">Asesor</option>
                                            <option value="alumno">Alumno</option>
                                            <option value="director">Director Academico</option>
                                            <option value="subdirector">SubDirector Academico</option>
                                            <option value="administrador">Administrador</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8 row form-group">
                                        <div class="col-sm-6">
                                            <label for="" class="col-form-label d-flex justify-content-start" style="color:#1D62D3;width:100%">Fecha desde</label>
                                            <input type="date" class="form-control">
                                        </div>
                                        <div class="col-sm-6 ">
                                            <label for="" class="col-form-label d-flex justify-content-start" style="color:#1D62D3;width:100%">Fecha hasta</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group" style="display:none">
                                        <label for="" class="col-form-label d-flex justify-content-start" style="color:#1D62D3;">"Matricula"</label>
                                        <input type="text" class="form-control" name="clave_search" id="clave_search">
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                        <button class="btn float-right" style="background-color:#1050B9;color:white">Consultar</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!--2 liveline-section start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6 text-left">
                                    <h5>Lista Usuario</h5>
                                </div>
                                {{-- <div class="col-sm-6 text-right">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-report"><i class="feather icon-plus"></i>New User</button>
                                </div> --}}
                            </div>
                            {{-- <ul class="list-inline">
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> Sorting Options </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 font-weight-bolder"> Reset </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> Membership </a></li>
                                <li class="list-inline-item"><a href="#!" class="text-muted"> Username </a></li>
                            </ul> --}}
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="a" class="pr-2 pl-1 text-muted btn_search_abc"> A </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="b" class="pr-2 pl-1 text-muted btn_search_abc"> B </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="c" class="pr-2 pl-1 text-muted btn_search_abc"> C </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="d" class="pr-2 pl-1 text-muted btn_search_abc"> D </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="e" class="pr-2 pl-1 text-muted btn_search_abc"> E </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="f" class="pr-2 pl-1 text-muted btn_search_abc"> F </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="g" class="pr-2 pl-1 text-muted btn_search_abc"> G </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="h" class="pr-2 pl-1 text-muted btn_search_abc"> H </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="i" class="pr-2 pl-1 text-muted btn_search_abc"> I </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="j" class="pr-2 pl-1 text-muted btn_search_abc"> J </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="k" class="pr-2 pl-1 text-muted btn_search_abc"> K </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="l" class="pr-2 pl-1 text-muted btn_search_abc"> L </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="m" class="pr-2 pl-1 text-muted btn_search_abc"> M </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="n" class="pr-2 pl-1 text-muted btn_search_abc"> N </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="o" class="pr-2 pl-1 text-muted btn_search_abc"> O </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="p" class="pr-2 pl-1 text-muted btn_search_abc"> P </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="q" class="pr-2 pl-1 text-muted btn_search_abc"> Q </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="r" class="pr-2 pl-1 text-muted btn_search_abc"> R </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="s" class="pr-2 pl-1 text-muted btn_search_abc"> S </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="t" class="pr-2 pl-1 text-muted btn_search_abc"> T </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="u" class="pr-2 pl-1 text-muted btn_search_abc"> U </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="v" class="pr-2 pl-1 text-muted btn_search_abc"> V </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="w" class="pr-2 pl-1 text-muted btn_search_abc"> W </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="x" class="pr-2 pl-1 text-muted btn_search_abc"> X </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="y" class="pr-2 pl-1 text-muted btn_search_abc"> Y </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" data-letra="z" class="pr-2 pl-1 text-muted btn_search_abc"> Z </a></li>
                                <li class="list-inline-item"><a href="#!"   data-letra="all" class="font-weight-bolder btn_search_abc"> All </a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                @foreach ($users as $usuario)

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
                                    <div class="col"><img class="img-radius img-fluid wid-80" src="{{asset('storage').'/'.$usuario->photo}}" alt="Foto de perfil"></div>
                                    <div class="col text-right pb-3">
                                        <div class="dropdown">
                                            <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">History</a>
                                                <a class="dropdown-item" href="#">Trash</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#!" data-toggle="modal" data-target="#modal-report">
                                    <h4 class="mb-1 mt-3">{{ ucwords($usuario->nombre)}}</h4>
                                </a>

                                <?php
                                    $fecha_registro =date('d-m-Y',strtotime($usuario->created_at));
                                ?>
                                <p class="mb-3 text-muted"><i class="feather icon-calendar"> </i>{{$usuario->fecha_nacimiento}}</p>
                                <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">{{$usuario->email }}</a></p>
                                <p class="mb-0"><b>Usuario : </b>{{$usuario->tipo_usuario}} <span class="badge badge-warning"></span></p>

                                <small>Fecha de ingreso {{$fecha_registro }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- liveline-section end -->
            </div>
        </div>
        <!-- [ content ] End -->
    </div>
    <!-- [ Layout content ] Start -->
@endsection


@section('script')

<script src="{{asset('js/admin/usuario.js')}}"></script>
<script>

    $('.btn_search_abc').on('click',function(){

        var letra=$(this).data('letra');

        alert(letra);

    });





</script>

@endsection
