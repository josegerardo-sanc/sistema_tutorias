
@extends('layouts.body')

@section('css')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/quill/typography.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/quill/editor.css')}}">

     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">


     <link rel="stylesheet" href="{{asset('dashboard_assets/libs/select2/select2.css')}}">
     <link rel="stylesheet" href="{{asset('dashboard_assets/libs/bootstrap-select/bootstrap-select.css')}}">
     <link rel="stylesheet" href="{{asset('dashboard_assets/css/pages/users.css')}}">

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
            {{-- <h4 class="font-weight-bold py-3 mb-0">Modals</h4> --}}
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item" >Mis alumnos</li>
                        @if (count($asignaciones)>0)
                        <li class="breadcrumb-item active open_modal_new_alumno" >
                            <a href="{{url('/tutor/create')}}">Registrar alumno</a>
                        </li>
                        @endif
                </ol>
            </div>
            @if(session('status_confirm'))
                <div class="col-sm-12 conte_confirm_success" style="margin:15px 0px;">
                    <div class="alert alert-success">
                        {{ session('status_confirm') }} <i class="fas fa-grin-stars"></i>
                        </div>
                </div>
            @endif
            <div clas="row form-group" style="padding:20px 10px; background-color:white;">
                <div class="col-sm-12">
                    @if (!count($asignaciones)>0)
                        <div class="card" style="border:1px solid red;">
                            <div class="card-body">
                                <h4 class="card-title">No cuentas con asignación</h4>
                                <p class="card-text">Porfavo acercate con el área de control escolar para mayor información o con el administrador de la plataforma.</p>
                            </div>
                        </div>
                    @endif
                </div>
                <div clas="col-sm-12 form-group" style="margin-bottom:20px;">
                    <h3 class="display-4" style="color: #B16A26">
                        Lista de alumnos
                        @if (count($asignaciones)>0)
                           <a class="mr-2 open_modal_new_alumno btn btn-primary" href="{{url('/tutor/create')}}">Registrar Alumno</a>
                        @endif
                    </h3>
                </div>
                @if (count($asignaciones)>0)
                <div class="col-sm-12 form-group">
                    <ul style="display: flex;flex-wrap:wrap; justify-content:space-around;list-style:none;">
                        <li data-carrera_escolar_data="{{$asignaciones[0]->name_carrera}}">
                            <strong style="color:#FF5733">Carrera</strong>
                            <strong>{{$asignaciones[0]->name_carrera}}</strong>
                         </li>
                          <li data-semestre_escolar_data="{{$asignaciones[0]->semestre}}">
                            <strong>{{$asignaciones[0]->semestre}} °</strong>
                            <strong style="color:#FF5733">Semestre</strong>

                         </li>
                        <li data-grupo_escolar_data="{{$asignaciones[0]->grupo}}">
                            <strong style="color:#FF5733">Grupo</strong>
                            <strong>{{$asignaciones[0]->grupo}}</strong>
                        </li>
                        <li data-turno_escolar_data="{{$asignaciones[0]->turno}}">
                            <strong style="color:#FF5733">Turno</strong>
                            <strong>{{$asignaciones[0]->turno}}</strong>
                        </li>
                    </ul>
                </div>
                @endif
                <div class="col-sm-12">
                    <table id="table_asignacion_individuales" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%; background-color:white;">
                        <thead>
                            <tr>
                                <th>Matricula</th>
                                <th>Nombre</th>
                                <th>Genero</th>
                                <th>Curp</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="table_asignacion_individuales_body">
                            @foreach ($alumnos as $alumno)
                                <tr>
                                    <td>{{$alumno->matricula}}</td>
                                    <td>{{ucwords($alumno->nombre)}}</td>
                                    <td>{{ucwords($alumno->genero)}}</td>
                                    <td>{{$alumno->curp}}</td>
                                    <td>{{$alumno->telefono}}</td>
                                    <td>{{$alumno->email}}</td>
                                    <td>
                                        <div>
                                            <a
                                               href="{{url('/tutor/'.$alumno->id_user_principal.'/edit')}}"
                                               data-id_alumno="{{$alumno->id_user_principal}}"
                                               type="button"
                                               class="btn btn-info btn_ver_data_alumno">Ver más datos
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- row --}}
        </div>
        <!-- [ content ] End -->
    </div>
    <!-- [ Layout content ] Start -->
@endsection


@section('script')


<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('js/helpers/idiomaEspañolDataTable.js')}}"></script>


<script>
$('#table_asignacion_individuales').DataTable({
    "order": [
        [0, 'desc'],
        [1, 'desc']
    ],
    "language":language
});

</script>

@endsection
