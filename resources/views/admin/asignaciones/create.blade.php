@extends('layouts.body')

@section('css')
    <style>

    </style>
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">

@endsection


@section('contenido_page')
<div class="layout-content">

    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="display-4" style="color:#B16A26" id="titulo_module_asignacion">Nueva Asignacion</h4>
        {{-- @include('admin.usuario.navar') --}}

        <div class="row">
            <div class="col-sm-12 error_alert_container">

            </div>
            <div class="col-sm-12 col-md-3"  style="background-color: #ffffff;padding:20px 10px;">
                <div class="col-sm-12 form-group">
                    <label for="" class="col-form-label">Lista de tutores</label>
                    <select class="form-control" name="tutor_asignacion" id="tutor_asignacion">
                        <?php
                          $list_tutores=false;
                        ?>
                      @forelse ($users_tutores as $user)
                          @if ($list_tutores== false)
                              <option value="0" selected disabled>Seleccione un tutor</option>
                            <?php $list_tutores=true;?>
                          @endif

                      <option
                      {{$user->id_asignacion!=null?'disabled':''}}

                      style="{{$user->id_asignacion!=null?'color:red':''}}"
                      value="{{$user->id}}">{{ucwords($user->nombre." ".$user->ap_paterno)}}</option>
                      @empty
                          <option selected disabled ="no_found_selected">No se encontrarón registros</option>
                      @endforelse
                    </select>
                </div>
                <div class="col-sm-12 form-group">
                    <label for="" class="col-form-label">Semestre</label>
                    <select  class="form-control" name="semestre_asignacion" id="semestre_asignacion">
                        <option value="0" disabled selected>Seleccione Semestre</option>
                        <option value="1">1º Semestre</option>
                        <option value="2">2º Semestre</option>
                        <option value="3">3º Semestre</option>
                        <option value="4">4º Semestre</option>
                        <option value="5">5º Semestre</option>
                        <option value="6">6º Semestre</option>
                        <option value="7">7º Semestre</option>
                        <option value="8">8º Semestre</option>
                        <option value="9">9º Semestre</option>
                    </select>
                </div>
                <div class="col-sm-12 form-group">
                    <label for="" class="col-form-label">Carrera <strong class="carreras_select_textError"></strong></label>
                    <select class="form-control carreras_select"  name="carrera_asignacion" id="carrera_asignacion">
                        <option value="0" disabled selected>Seleccione Carrera</option>
                    </select>
                </div>
                 <div class="col-sm-12 form-group">
                    <label class="form-label label_filter">Turno</label>
                    <select class="form-control" name="turno_asignacion" id="turno_asignacion">
                        <option value="0" disabled selected>Seleccione Turno</option>
                        <option value="Matutino">Matutino</option>
                        <option value="Vespertino">Vespertino</option>
                    </select>
                </div>
                <div class="col-sm-12 form-group">
                    <label class="form-label label_filter">Grupo</label>
                    <select class="form-control" name="grupo_asignacion" id="grupo_asignacion">
                        <option value="0" disabled selected>Seleccione Grupo</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>
                </div>
                <div class="form-group">
                    <button
                        title="Horario del tutor"
                        class="btn btn-info btn-block btn_asignarHorario_tutor"
                        type="button">
                        <i class="fas fa-clock"></i>
                        Asignar Horario</button>
                </div>
                <div class="d-flex justify-content-end flex-column">
                    <div class="form-group">
                        <input type="hidden" id="input_action_update" value="STORE_SAVE">
                        <input type="hidden" id="id_asignacion_input" value="">
                    </div>
                    <div class="form-group">
                        <button
                        title="registrar nueva asignacion"
                        class="btn btn-primary btn-block " id="btn_register_asignacion_tutor" type="button">
                        <i class="fas fa-bookmark"></i> Nueva asignación
                        </button>
                    </div>
                    <div class="form-group" id="conte_cancelar_actualizacion_asignacion" style="display:none">
                        <button
                        title="Cancelar actualización"
                        class="btn btn-danger btn-block btn_cancelar_actualizacion" type="button">
                        <i class="fas fa-ban"></i> Cancelar Actualización
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-9"  style="background-color: #ffffff;padding:20px 10px;">
                <table id="table_tutores" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fec.asignacion</th>
                            <th>Tutor</th>
                            <th>Carrera</th>
                            <th>Semestre</th>
                            <th>Turno</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="body_tutores">
                        @foreach ($users_tutores as $user)
                           @if ($user->id_asignacion!=null && $user->id_asignacion!="")
                                <tr>
                                    <td>{{$user->fecha_created}}</td>
                                    <td><a href="#">{{ucwords($user->nombre." ".$user->ap_paterno)}}</a></td>
                                    <td>{{$user->carrera}}</td>
                                    <td>{{$user->semestre}}º Semestre</td>
                                    <td>{{$user->turno." Grupo ".$user->grupo}}</td>
                                    <td>
                                        <div>
                                            <button class="btn btn-info ver_lista_de_alumnos" type="button"
                                                data-count_alumnos="{{$user->COUNT_ALUMNOS}}"
                                                data-semestre="{{$user->semestre}}"
                                                data-id_carrera="{{$user->id_carrera}}"
                                                data-carrera_text="{{$user->carrera}}"
                                                data-turno="{{$user->turno}}"
                                                data-grupo="{{$user->grupo}}"
                                                title="Lista de alumnos"
                                                {{$user->COUNT_ALUMNOS<=0?'disabled':''}}
                                                >
                                                <a href="#" style="color:white;">Ver alumnos</a>
                                                <span class="badge badge-light">{{$user->COUNT_ALUMNOS}}</span>
                                            </button>
                                            <button class="btn btn-danger btn_eliminar_asignacion" type="button"
                                                data-id_asignacion="{{$user->id_asignacion}}"
                                                title="Eliminar registro">Eliminar
                                            </button>
                                            <button class="btn btn-warning btn_editar_asignacion"
                                                data-count_alumnos="{{$user->COUNT_ALUMNOS}}"
                                                data-semestre="{{$user->semestre}}"
                                                data-id_carrera="{{$user->id_carrera}}"
                                                data-carrera_text="{{$user->carrera}}"
                                                data-turno="{{$user->turno}}"
                                                data-grupo="{{$user->grupo}}"
                                                data-id="{{$user->id}}"
                                                data-id_asignacion="{{$user->id_asignacion}}"
                                                data-user_id_asignacion="{{$user->user_id_asignado}}"
                                              title="Editar registro">Editar
                                            </button>
                                             <button class="btn btn-link btn_ver_horario_tutor"
                                                data-id="{{$user->id}}"
                                                data-id_asignacion="{{$user->id_asignacion}}"
                                              title="Ver Horario"><i class="fas fa-user-clock"></i> Ver Horario
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Fec.asignacion</th>
                            <th>Tutor</th>
                            <th>Carrera</th>
                            <th>Semestre</th>
                            <th>Turno</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        {{-- row --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="modal" tabindex="-1" role="dialog" id="modal_lista_alumnos">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Lista de alumnos</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <ul style="display: flex; justify-content:space-around; list-style:none;">
                            <li><strong style="color:#FF5733">Carrera</strong> <p id="carrera_alumno_table"></p></li>
                            <li><strong style="color:#FF5733">Semestre</strong> <p id="carrera_semestre_table"></p></li>
                            <li><strong style="color:#FF5733">Turno</strong> <p id="carrera_turno_table"></p></li>
                          </ul>
                          <table class="table table-responsive ">
                                <thead>
                                    <tr>
                                        <th>Fec.Registro</th>
                                        <th>Nombre Completo</th>
                                        <th>Matricula</th>
                                        <th>Curp</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody id="lista_alumnos_table" style="width: 100%">
                                </tbody>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
         {{-- end row --}}
        {{-- row --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="modal" tabindex="-1" role="dialog" id="modal_horario_tutor">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Horario</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <table class="table table-responsive ">
                                <thead>
                                    <tr>
                                        <th>Lunes <input type="checkbox" class="check_lunes"></th>
                                        <th>Marte <input type="checkbox" class="check_martes"></th>
                                        <th>Miercoles <input type="checkbox" class="check_miercoles"></th>
                                        <th>Jueves <input type="checkbox" class="check_jueves"></th>
                                        <th>Viernes <input type="checkbox" class="check_viernes"></th>
                                        <th>Horas asignadas.</th>
                                    </tr>
                                </thead>
                                <tbody style="width: 100%">
                                    <tr>
                                        <th colspan="5"><i class="fas fa-clock"></i> Horas</th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="form-control input_check_lunes input_keyup_horario validar_numeric_input" maxlength="1" style="border: 1px solid #ddd;  text-align: center;" disabled></td>
                                        <td><input type="text" class="form-control input_check_martes input_keyup_horario validar_numeric_input" maxlength="1" style="border: 1px solid #ddd; text-align: center;" disabled></td>
                                        <td><input type="text" class="form-control input_check_miercoles input_keyup_horario validar_numeric_input" maxlength="1" style="border: 1px solid #ddd; text-align: center;" disabled></td>
                                        <td><input type="text" class="form-control input_check_jueves input_keyup_horario validar_numeric_input" maxlength="1"style="border: 1px solid #ddd; text-align: center;" disabled></td>
                                        <td><input type="text" class="form-control input_check_viernes input_keyup_horario validar_numeric_input" maxlength="1" style="border: 1px solid #ddd; text-align: center;" disabled></td>
                                        <td>
                                            <input type="text" class="form-control total_hrs_asignadas_tutor" disabled>
                                        </td>
                                    </tr>
                                </tbody>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary btn_btn_restablecer_horario">Restablecer</button>
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
         {{-- end row --}}
    </div>
    <!-- [ content ] End -->
</div>
@endsection


@section('script')
<script src="{{asset('js/helpers/GetCarreras.js')}}"></script>

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('js/helpers/idiomaEspañolDataTable.js')}}"></script>


<script>
var users_tutores=[];
    users_tutores=<?php echo json_encode($users_tutores) ?>;
    console.log(users_tutores)
</script>
<script src="{{asset('js/helpers/Ajax_fail.js')}}"></script>
<script src="{{asset('js/admin/asignacion_tutor.js')}}"></script>
@endsection
