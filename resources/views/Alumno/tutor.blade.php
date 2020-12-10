
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
            <h4 class="display-4" style="color:#DF480F">Mi tutor</h4>
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="feather icon-user"></i></a></li>
                    <li class="breadcrumb-item active">Datos del tutor</li>
                </ol>
            </div>
            @if (count($tutor)>0)
            <div class="card">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-sm-6 pb-4">
                            <div class="media align-items-center mb-4">
                                <a href="index.html" class="navbar-brand app-brand demo py-0 mr-4">
                                    <span class="app-brand-logo demo">
                                        {{-- <img src="assets/img/logo-dark.png" alt="Brand Logo" class="img-fluid"> --}}
                                        <img  src="{{asset('storage').'/Recursos_sistema/itss.jpg'}}" style="height:80px;object-fit: cover;" alt="logo">
                                    </span>
                                    <span class="app-brand-text demo font-weight-bold text-dark ml-2">Instituto Tecnológico Superior de la Región Sierra.</span>
                                </a>
                            </div>
                            {{-- <div class="mb-1">Office 154, 330 North Brand Boulevard</div>
                            <div class="mb-1">Glendale, CA 91203, USA</div>
                            <div>+0 (123) 456 7891, +9 (876) 543 2198</div> --}}
                        </div>
                        <div class="col-sm-6 text-right pb-4">
                            {{--
                            <div class="mb-1">Date:
                                <strong class="font-weight-semibold">January 12, 2015</strong>
                            </div>
                            <div>Due date:
                                <strong class="font-weight-semibold">May 12, 2015</strong>
                            </div> --}}
                            <h6 class="text-big text-large font-weight-bold mb-3">Tutor</h6>
                            <img  src="{{asset('storage').'/'.$tutor[0]->photo}}" style="height:100px;object-fit: cover;border-radius:7px;" alt="imagenPerfil">
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="row">

                        <div class="col-sm-12 col-md-12">
                            <div class="row col-sm-12">
                                <div class="col-sm-12 font-weight-bold mb-2"><i class="sidenav-icon fas fa-user"></i> Datos:</div>
                                <div class="col-sm-4">
                                    <strong style="display:block;color:#DF480F">Nombre completo:</strong> {{ucwords($tutor[0]->nombre.' '.$tutor[0]->ap_paterno.' '.$tutor[0]->ap_materno)}}
                                </div>
                                <div class="col-sm-3">
                                    <strong style="display:block;color:#DF480F">Correo</strong> {{ucwords($tutor[0]->email)}}
                                </div>
                                <div class="col-sm-3">
                                    <strong style="display:block;color:#DF480F">Telefono</strong> {{ucwords($tutor[0]->telefono)}}
                                </div>
                                <div class="col-sm-2">
                                    <strong style="display:block;color:#DF480F">Genero</strong> {{ucwords($tutor[0]->genero)}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mb-4">

                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th class="py-3" colspan="5">
                                        <i class="sidenav-icon fas fa-tags"></i>  Asignación
                                    </th>
                                </tr>
                                <tr>
                                    <th class="py-3">
                                        <strong style="color:#FF5733">Carrera</strong>
                                       {{$tutor[0]->name_carrera}}
                                    </th>
                                    <th class="py-3">
                                        {{$tutor[0]->semestre}} °
                                        <strong style="color:#FF5733">Semestre</strong>

                                    </th>
                                    <th class="py-3">
                                        <strong style="color:#FF5733">Turno</strong>
                                        {{$tutor[0]->turno}}
                                    </th>
                                    <th class="py-3">
                                        <strong style="color:#FF5733">Grupo</strong>
                                        ({{$tutor[0]->grupo}})
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $horario=json_decode($tutor[0]->horario,true)

                                ?>
                                <tr>
                                    <th class="py-3" colspan="5">
                                        <i class="sidenav-icon fas fa-clock"></i> Horario
                                    </th>
                                </tr>
                                <tr>
                                    <td class="py-3">
                                        Lunes
                                        <?php
                                        echo $horario['lunes']=="true"
                                        ?'<strong style="color:green;font-size:20px;"> <i class="far fa-check-square"></i></strong>'
                                        :'<strong style="color:red;font-size:20px;"> <i class="far fa-times-circle"></i></strong>'
                                        ?>
                                        <div>
                                            <strong>Hrs.</strong> {{$horario['lunes_hora']}}
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        Martes
                                        <?php echo
                                            $horario['martes']=="true"
                                            ?'<strong style="color:green;font-size:20px;"> <i class="far fa-check-square"></i></strong>'
                                            :'<strong style="color:red;font-size:20px;"> <i class="far fa-times-circle"></i></strong>'
                                        ?>
                                        <div>
                                            <strong>Hrs.</strong> {{$horario['martes_hora']}}
                                        </div>
                                    <td class="py-3">
                                        Miercoles
                                        <?php echo
                                            $horario['miercoles']=="true"
                                            ?'<strong style="color:green;font-size:20px;"> <i class="far fa-check-square"></i></strong>'
                                            :'<strong style="color:red;font-size:20px;"> <i class="far fa-times-circle"></i></strong>'
                                        ?>
                                        <div>
                                            <strong>Hrs.</strong> {{$horario['miercoles_hora']}}
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        Jueves
                                        <?php echo
                                            $horario['jueves']=="true"
                                            ?'<strong style="color:green;font-size:20px;"> <i class="far fa-check-square"></i></strong>'
                                            :'<strong style="color:red;font-size:20px;"> <i class="far fa-times-circle"></i></strong>'
                                        ?>
                                        <div>
                                            <strong>Hrs.</strong> {{$horario['jueves_hora']}}
                                        </div>

                                    </td>
                                    <td class="py-3">
                                        Viernes
                                        <?php echo
                                            $horario['viernes']=="true"
                                            ?'<strong style="color:green;font-size:20px;"> <i class="far fa-check-square"></i></strong>'
                                            :'<strong style="color:red;font-size:20px;"> <i class="far fa-times-circle"></i></strong>'
                                        ?>
                                        <div>
                                            <strong>Hrs.</strong> {{$horario['viernes_hora']}}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <?php
                                            $horas_totales=$horario['lunes_hora']+$horario['martes_hora']+$horario['miercoles_hora']+$horario['jueves_hora']+$horario['viernes_hora'];
                                        ?>
                                        <strong>Total Horas</strong> <span class="badge badge-warning" style="padding:5px 10px;"> <?php echo $horas_totales?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="text-muted">
                        <strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras laoreet, dolor id dapibus dapibus, neque mi tincidunt quam, quis congue ligula risus vitae magna. Curabitur ultrices nisi massa,
                        nec viverra lorem feugiat sed.
                        Mauris non porttitor nunc. Integer eu orci in magna auctor vestibulum.
                    </div> --}}
                </div>
                {{-- <div class="card-footer text-right">
                    <a href="pages_invoice-print.html" target="_blank" class="btn btn-default"><i class="ion ion-md-print"></i>&nbsp; Print</a>
                    <button type="button" class="btn btn-primary ml-2"><i class="ion ion-ios-paper-plane"></i>&nbsp; Send</button>
                </div> --}}
            </div>
            @else
            <div class="card">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-sm-6 pb-4">
                            <div class="media align-items-center mb-4">
                                <a href="index.html" class="navbar-brand app-brand demo py-0 mr-4">
                                    <span class="app-brand-logo demo">
                                        {{-- <img src="assets/img/logo-dark.png" alt="Brand Logo" class="img-fluid"> --}}
                                        <img  src="{{asset('storage').'/Recursos_sistema/itss.jpg'}}" style="height:80px;object-fit: cover;" alt="logo">
                                    </span>
                                    <span class="app-brand-text demo font-weight-bold text-dark ml-2">Instituto Tecnológico Superior de la Región Sierra.</span>
                                </a>
                            </div>

                        </div>
                        <div class="col-sm-12 d-flex justify-content-center">
                            <h1 class="display-4" ><i class="fas fa-grimace"></i>
                                <strong style="color: #DF480F">No tienes tutor asignado.</strong>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            @endif
        </div>
        <!-- [ content ] End -->
    </div>
    <!-- [ Layout content ] Start -->
@endsection


@section('script')

<script>


</script>

@endsection
