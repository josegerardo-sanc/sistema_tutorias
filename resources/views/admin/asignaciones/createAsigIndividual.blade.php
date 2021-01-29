@extends('layouts.body')

@section('css')
    <style>

    </style>
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">


     <link rel="stylesheet" href="{{asset('dashboard_assets/libs/select2/select2.css')}}">
     <link rel="stylesheet" href="{{asset('dashboard_assets/libs/bootstrap-select/bootstrap-select.css')}}">
@endsection


@section('contenido_page')
<div class="layout-content">

    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="display-4" style="color:#DF480F" id="titulo_module_asignacion">Asignacion individual</h4>

        <div class="row">
            <div class="col-sm-12 error_alert_container">

            </div>
            <div class="col-sm-12 form-row"  style="background-color: #ffffff;padding:20px 10px;">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label">Lista de carreras <strong class="carreras_select_textError"></strong></label>
                    <select   name="filtro_carrera_escolar" id="filtro_carrera_escolar" class="form-control carreras_select init_selecte_carreras_list" style="width: 100%" data-allow-clear="true" disabled>
                        <option value="0" disabled selected>Seleccione Carrera</option>
                    </select>
                </div>

                <div class="col-sm-4 form-group">
                    <label class="col-form-label label_filter">Lista de tutores   <strong id="conte_init_selecte_tutores" class="text-muted"></strong></label>
                    <select class="form-control init_selecte_tutores" name="" id="init_selecte_tutores" style="width: 100%" data-allow-clear="true">
                         <?php
                            $list_tutores=false;
                            ?>
                            @forelse ($users_tutores as $user)
                                @if ($list_tutores== false)
                                    <option value="0" selected disabled>Seleccione un tutor</option>
                                    <?php $list_tutores=true;?>
                                @endif
                            <option value="{{$user->id}}">{{ucwords($user->nombre." ".$user->ap_paterno)}}</option>
                            @empty
                                <option selected disabled ="no_found_selected">No se encontrarón registros</option>
                            @endforelse
                    </select>
                    <div class="error_select_tutor"></div>
                </div>

                <div class="form-group col-sm-4">
                        <label for="" class="col-form-label">Lista de alumnos</label>
                        <select class="form-control init_selecte_alumnos" name="" id="init_selecte_alumnos" style="width: 100%" data-allow-clear="true">
                            <?php
                            $list_alumnos=false;
                            ?>
                            @forelse ($users_alumnos as $user)
                                @if ($list_alumnos== false)
                                    <option value="0" selected disabled>Seleccione un alumno</option>
                                    <?php $list_alumnos=true;?>
                                @endif
                            <option value="{{$user->id_users}}">{{ucwords($user->nombre." ".$user->ap_paterno." ".$user->matricula)}}</option>
                            @empty
                                <option selected disabled ="no_found_selected">No se encontrarón registros</option>
                            @endforelse
                        </select>
                        <div class="error_select_alumno"></div>
                </div>
                <div class="form-group col-sm-2">
                    <label for="" class="col-form-label" style="display: block; opacity:0">Opción</label>
                    <button type="button" class="btn btn-primary btn_register_asignacion_individual btn-block">Registrar</button>
                </div>
            </div>
            {{-- fin col --}}
            <div class="mt-2 col-sm-12 form-row"  style="background-color: #ffffff;padding:20px 10px;">
                <div class="col-sm-12">
                    <table id="table_asignacion_individuales" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%; background-color:white;">
                        <thead>
                            <tr>
                                <th>Fech.asignación</th>
                                <th>Tutor</th>
                                <th>alumno</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="table_asignacion_individuales_body">
                            @foreach ($asignacionIndividuales as $user)
                                <tr>
                                    <td>{{$user->fecha_created}}</td>
                                    <td>
                                        <button type="button" class="btn btn-link btn_ver_tutor_AsigIndividual"
                                        data-id_tutor="{{$user->idTutor}}">
                                        {{ucwords($user->nombre_tutor." ".$user->paterno_tutor)}}
                                        </button>
                                    </td>
                                    <td><button type="button" class="btn btn-link btn_ver_alumno_AsigIndividual"
                                        data-id_alumno="{{$user->idAlumno}}">
                                        {{ucwords($user->nombre_alumno." ".$user->paterno_alumno." ".$user->matricula)}}
                                        </button>
                                    </td>
                                    <td>
                                        <div>
                                            <button
                                            data-id="{{$user->idAsignacionIndividual}}"
                                            data-id_alumno="{{$user->idTutor}}"
                                            data-id_tutor="{{$user->idAlumno}}"
                                            type="button" class="btn btn-block btn-danger btn_delete_asignacion_individual">
                                                    <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- fin col --}}

            {{-- row --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="modal" tabindex="-1" role="dialog" id="modal_lista_alumnos_ASIGNACION_INDIVIDUAL">
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
                              <table class="table table-responsive" style="width: 100%;overflow-x:auto;">
                                    <thead>
                                        <tr>
                                            <th>Fec.Registro</th>
                                            <th>Nombre Completo</th>
                                            <th>Matricula</th>
                                            <th>Curp</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody id="lista_alumnoAsignacionIndividual_table" style="width: 100%">

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

        </div>
    </div>
    <!-- [ content ] End -->
</div>
@endsection


@section('script')
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<link rel="stylesheet" href="{{asset('dashboard_assets/libs/bootstrap-select/bootstrap-select.css')}}">
<script src="{{asset('dashboard_assets/libs/select2/select2.js')}}"></script>
<script src="{{asset('js/helpers/GetCarreras.js')}}"></script>
<script src="{{asset('js/helpers/idiomaEspañolDataTable.js')}}"></script>
<script src="{{asset('js/helpers/Ajax_fail.js')}}"></script>

<script>


let init_selecte_tutores=0;
let init_selecte_alumnos=0;



$('#filtro_carrera_escolar').on('change',function(){

        let id_carrera=$('#filtro_carrera_escolar option:selected').val();
        console.log(id_carrera);

        $.ajax(
            {
            url :`/carrera/tutoresAsignados/${id_carrera}`,
            type:'POST',
            headers:{"X-CSRF-Token": csrf_token},
            data :{'buscar_alumnos':true},
            beforeSend:function(){

                $('#init_selecte_tutores').attr('disabled','disabled')
                $('#conte_init_selecte_tutores').html('<i class="fas fa-sync fa-spin"></i> Cargando.......');
            }
            })
            .done(function(respuesta) {

                $('#init_selecte_tutores').removeAttr('disabled')
                $('#conte_init_selecte_tutores').html('');

                var json=JSON.parse(respuesta);
                console.log(json);

                if(json.status=="400"){
                $('.error_alert_container').html(`<div class='alert alert-danger alert-dismissible fade show'>${json.info} ${btn_close_Alert}</div>`);
                }
                if(json.status=="200"){
                    let tutoresOptions="";
                    // console.log(json.data.length);

                    if(json.data.length>0){
                        tutoresOptions="<option value='0' disabled selected>Seleccione un tutor</option>";
                        for (const iterator of json.data) {
                            tutoresOptions+=`<option value='${iterator.id}'>${iterator.nombre} ${iterator.ap_paterno!=""?iterator.ap_paterno:""} ${iterator.ap_materno!=""?iterator.ap_materno:""}</option>`;
                        }
                        $('#init_selecte_tutores').html(tutoresOptions).removeAttr('disabled');
                    }else{
                        tutoresOptions="<option value='0' disabled selected style='color:red;'>NO SE ENCONTRARÓN REGISTROS</option>"
                        $('#init_selecte_tutores').html(tutoresOptions).attr('disabled','disabled');
                    }

                    // alumnos
                    if(json.alumnos.length>0){
                        alumnosOptions="<option value='0' disabled selected>Seleccione un alumno</option>";
                        for (const iterator of json.alumnos) {
                            alumnosOptions+=`<option value='${iterator.id}'>${iterator.nombre} ${iterator.ap_paterno!=""?iterator.ap_paterno:""} ${iterator.ap_materno!=""?iterator.ap_materno:""} --${iterator.matricula}</option>`;
                        }
                        $('#init_selecte_alumnos').html(alumnosOptions).removeAttr('disabled');
                    }else{
                        alumnosOptions="<option value='0' disabled selected style='color:red;'>NO SE ENCONTRARÓN REGISTROS</option>"
                        $('#init_selecte_alumnos').html(alumnosOptions).attr('disabled','disabled');
                    }





                }
                $("html, body").animate({ scrollTop: 0 }, 600);


            }).fail(function(jqXHR,textStatus) {
                console.error(jqXHR.responseJSON);
                $('#init_selecte_tutores').removeAttr('disabled')
                $('#conte_init_selecte_tutores').html('');

            })

});


function validarSelectAsignacionTutor(){

    $('.error_select_alumno').html('');
    $('.error_select_tutor').html('');

    init_selecte_tutores=$("#init_selecte_tutores option:selected").val();
    init_selecte_alumnos=$("#init_selecte_alumnos option:selected").val();

    let bool_select=true;


    if(!(init_selecte_alumnos!=0&&init_selecte_alumnos!="no_found_selected")){
        $('.error_select_alumno').addClass('text-danger p-2').html('<strong>Opción Invalida</strong>');
        bool_select=false;
    }
    if(!(init_selecte_tutores!=0&&init_selecte_tutores!="no_found_selected")){
        $('.error_select_tutor').addClass('text-danger p-2').html('<strong>Opción Invalida</strong>');
        bool_select=false;
    }

    if(bool_select){
        return true;
    }else{
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    }
}


$(document).on('click','.btn_ver_tutor_AsigIndividual',function(){
    let id_tutor=$(this).data('id_tutor');
    let this_element=$(this);
    console.log(id_tutor)

    let Object_dataAsignacionIndividual={
        'id_tutor':id_tutor,
        'tipo_usuario':'tutor'
    };

    tipoUsuario_mostrarInfo(Object_dataAsignacionIndividual,this_element);

});
$(document).on('click','.btn_ver_alumno_AsigIndividual',function(){
    let id_alumno=$(this).data('id_alumno');
    let this_element=$(this);
    console.log(id_alumno);

    let Object_dataAsignacionIndividual={
        'id_alumno':id_alumno,
        'tipo_usuario':'alumno'
    };

    tipoUsuario_mostrarInfo(Object_dataAsignacionIndividual,this_element);

});

function tipoUsuario_mostrarInfo(Object_dataAsignacionIndividual,this_element){

    let texto=$(this_element).text();

    $.ajax(
        {
            url :'/Admin/AsignacionIndividual/tipoUsuarioData',
            type:'POST',
            headers:{"X-CSRF-Token": csrf_token},
            data :Object_dataAsignacionIndividual,
            beforeSend:function(){
                $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
            }
        })
        .done(function(respuesta) {
            $(this_element).html(texto).removeAttr('disabled');
            var data=JSON.parse(respuesta);
            console.log(data);

            var btn_close_Alert=` <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>`;

            if(data.status=="400"){
                $('.error_alert_container').html(`<div class='alert alert-danger alert-dismissible fade show'>${data.info} ${btn_close_Alert}</div>`);

            }
            if(data.status=="200"){
                if(Object_dataAsignacionIndividual.tipo_usuario=="alumno"){
                    tipoUsuarioALUMNO(data.data);
                }else if(Object_dataAsignacionIndividual.tipo_usuario=="tutor"){
                    tipoUsuarioTUTOR(data.data);
                }
            }
            $("html, body").animate({ scrollTop: 0 }, 600);

        }).fail(function(jqXHR,textStatus) {

            console.error(jqXHR.responseJSON);
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
                incluyendo la propiedad jqXHR.status que contiene,
                entre otros posibles, el código de estado HTTP de la respuesta. */
                ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
                $(this_element).html(texto).removeAttr('disabled');

            })
}

function tipoUsuarioTUTOR(data){
    let row="";
    for (const iterator of data) {
        row=`tutor`;
    }
}

function tipoUsuarioALUMNO(data){
    let row="";
    if(data.length>0){
        for (const iterator of data) {

        $('#carrera_alumno_table').html(`${iterator.carrera}`);
        $('#carrera_semestre_table').html(`${iterator.semestre} º Semestre`);

        $('#carrera_turno_table').html(`${iterator.turno} Grupo ${iterator.grupo}`);
        row+=`<tr>
            <th>${iterator.fecha_registro}</th>
            <th>${iterator.nombre+" "+iterator.ap_materno+" "+iterator.ap_materno}</th>
            <th>${iterator.matricula}</th>
            <th>${iterator.curp}</th>
            <th>${iterator.email}</th>
        </tr>`;
    }
    }else{
        row="<tr><td colspan='4' style='text-align:center'>NO SE ENCONTRARON REGISTROS</td></tr>";
    }
    $('#lista_alumnoAsignacionIndividual_table').html(row);
    $('#modal_lista_alumnos_ASIGNACION_INDIVIDUAL').modal('show');

}

// fin de mostrar tipo de usuario seleccionado

$(document).on('click','.btn_delete_asignacion_individual',function(){

    let id_asignacionIndividual=$(this).data('id');
    let id_alumno=$(this).data('id_alumno');
    let id_tutor=$(this).data('id_tutor');


    let Object_dataAsignacionIndividual={
        'id_alumno':init_selecte_alumnos,
        'id_tutor':init_selecte_tutores,
        'action':'delete'
     };

     console.log(Object_dataAsignacionIndividual);

     let this_element=$(this);
     $('.error_alert_container').html('<div class="alert alert-warning"><i class="fas fa-sync fa-spin"></i> Cargando.......</div>');
     $.ajax(
        {
          url :`/Admin/AsignacionIndividual/${id_asignacionIndividual}`,
          type:'DELETE',
          headers:{"X-CSRF-Token": csrf_token},
          data :Object_dataAsignacionIndividual,
          beforeSend:function(){
             $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
            }
        })
        .done(function(respuesta) {
            console.log(respuesta)
            $(this_element).html('<i class="fas fa-trash-alt">').removeAttr('disabled');
            var data=JSON.parse(respuesta);
            console.log(data);

            var btn_close_Alert=` <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>`;

            if(data.status=="400"){
            $('.error_alert_container').html(`<div class='alert alert-danger alert-dismissible fade show'>${data.info} ${btn_close_Alert}</div>`);

            }
            if(data.status=="200"){
            $('.error_alert_container').html(`<div class='alert alert-success alert-dismissible fade show'>${data.info} ${btn_close_Alert}</div>`);
              CrearTablaAsignacionIndividual(data.data)
            }
            $("html, body").animate({ scrollTop: 0 }, 600);

        }).fail(function(jqXHR,textStatus) {

            console.error(jqXHR.responseJSON);
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
             incluyendo la propiedad jqXHR.status que contiene,
             entre otros posibles, el código de estado HTTP de la respuesta. */
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
             $(this_element).html('<i class="fas fa-trash-alt">').removeAttr('disabled');

         })
});


$('.btn_register_asignacion_individual').on('click',function(){

     let statusSelect=validarSelectAsignacionTutor();
     console.log(statusSelect);

     if(statusSelect==false){
         return false;
     }
     let Object_dataAsignacionIndividual={
        'id_alumno':init_selecte_alumnos,
        'id_tutor':init_selecte_tutores,
        'action':'save'
     };

     console.log(Object_dataAsignacionIndividual);

     let this_element=$(this);
     $('.error_alert_container').html('<div class="alert alert-warning"><i class="fas fa-sync fa-spin"></i> Cargando.......</div>');
     $.ajax(
        {
          url :'/Admin/AsignacionIndividual',
          type:'POST',
          headers:{"X-CSRF-Token": csrf_token},
          data :Object_dataAsignacionIndividual,
          beforeSend:function(){
             $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
            }
        })
        .done(function(respuesta) {
            console.log(respuesta)
            $(this_element).html('Registar').removeAttr('disabled');
            var data=JSON.parse(respuesta);
            console.log(data);

            var btn_close_Alert=` <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>`;

            if(data.status=="400"){
            $('.error_alert_container').html(`<div class='alert alert-danger alert-dismissible fade show'>${data.info} ${btn_close_Alert}</div>`);

            }
            if(data.status=="200"){
            $('.error_alert_container').html(`<div class='alert alert-success alert-dismissible fade show'>${data.info} ${btn_close_Alert}</div>`);
              CrearTablaAsignacionIndividual(data.data)
            }
            $("html, body").animate({ scrollTop: 0 }, 600);

        }).fail(function(jqXHR,textStatus) {

            console.error(jqXHR.responseJSON);
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
             incluyendo la propiedad jqXHR.status que contiene,
             entre otros posibles, el código de estado HTTP de la respuesta. */
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
             $(this_element).html('Registar').removeAttr('disabled');

         })


});

function CrearTablaAsignacionIndividual(data){

    let filas="";

    // iterator.matricula
    for (const iterator of data) {
        filas+=`
        <tr>
            <td>${iterator.fecha_created}</td>
            <td><button type="button" class="btn btn-link btn_ver_tutor_AsigIndividual"
                data-id_tutor="${iterator.idTutor}">
                ${iterator.nombre_tutor+" "+iterator.paterno_tutor}
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-link btn_ver_alumno_AsigIndividual"
                data-id_alumno="${iterator.idAlumno}">
                ${iterator.nombre_alumno+" "+iterator.paterno_alumno+" "+iterator.matricula}
                </button>
            </td>
            <td>
                <div>
                    <button
                    data-id="${iterator.idAsignacionIndividual}"
                    data-id_alumno="${iterator.idAlumno}"
                    data-id_tutor="${iterator.idTutor}"
                    type="button" class="btn btn-block btn-danger btn_delete_asignacion_individual">
                            <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </td>
        </tr>
        `;
    }

    $('#table_asignacion_individuales').DataTable().clear().destroy();
    $('#table_asignacion_individuales_body').html(filas);
    $('#table_asignacion_individuales').DataTable({
        "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
    });

}

// $('#subcategorias_select').on('change',function(){
//        var option=$("#subcategorias_select option:selected").data('categoria');
//         $(this).val();
//         console.log(option);
//         $('#categorias_producto option').each(function() {
//             if($(this).val()==option){
//                 $("#categorias_producto option[value="+option+"]").attr("selected",true);
//                 $(this).val(option);
//                 $(this).trigger('change.select2');
//              }
//           });

//      });


$('#table_asignacion_individuales').DataTable({
    "order": [
        [0, 'desc'],
        [1, 'desc']
    ],
    "language":language
});

$('.init_selecte_carreras_list').each(function() {
    $(this)
    .wrap('<div class="position-relative"></div>')
    .select2({
    placeholder: 'Select value',
    dropdownParent: $(this).parent()
    });
})
$('.init_selecte_tutores').each(function() {
    $(this)
    .wrap('<div class="position-relative"></div>')
    .select2({
    placeholder: 'Select value',
    dropdownParent: $(this).parent()
    });
})
$('.init_selecte_alumnos').each(function() {
    $(this)
    .wrap('<div class="position-relative"></div>')
    .select2({
    placeholder: 'Select value',
    dropdownParent: $(this).parent()
    });
})
</script>

@endsection
