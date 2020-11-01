@extends('layouts.body')

@section('css')
    <style>

        .selected_tipo_usuario{
            border: 1px solid #cdcdcd;
            border-radius:10px !important;
            padding: 10px !important;
        }
        .selected_tipo_usuario>option{
            color:red;
        }
        .label_tipo_usuario{
            padding: 10px;
            font-weight: bold;
        }
    </style>

@endsection


@section('contenido_page')
<div class="layout-content">

    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0">Nuevo Asignacion</h4>

        {{-- @include('admin.usuario.navar') --}}

        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-4 form-group">
                    <label for="" class="col-form-label label_tipo_usuario">Tipo de usuario</label>
                        <select class="form-control selected_tipo_usuario" name="asignacion_users" id="asignacion_users">
                        <option selected disabled value="0">Seleccione  Tipo  Usuario</option>
                        <option value="tutor">Tutor</option>
                        <option value="asesor">Asesor</option>
                        <option value="alumno">Alumno</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 form-group">
                <div class="form-group">
                    <label for="" class="col-form-label">Asignar grupo</label>
                </div>
            </div>
            <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Lunes</th>
                            <th scope="col">Martes</th>
                            <th scope="col">Miercoles</th>
                            <th scope="col">Jueves</th>
                            <th scope="col">Viernes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                  </table>

            </div>
        </div>

    </div>
    <!-- [ content ] End -->
</div>
@endsection


@section('script')

<script>

    let tipo_user_asignacion="";
    $('#asignacion_users').on('change',function(){


    });


</script>
    
@endsection