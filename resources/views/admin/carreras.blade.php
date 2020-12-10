
@extends('layouts.body')
@section('css')

@endsection

@section('contenido_page')
<div class="layout-content">

    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="display-4" style="color:#DF480F">Lista de carreras</h4>

        <div class="row">
            {{-- error container --}}
            <div class="col-sm-12 error_alert_container"></div>

            <div class="col-sm-12 form-group"  style="background-color: #ffffff;padding:20px 10px;">
                <div class="form-group">
                    <label for="carrera">Carrera</label>
                    <input type="text" class="form-control" id="carrera_input" aria-describedby="carrera" placeholder="INGRESE LA CARRERA">
                    <small id="error_carrera" class="form-text text-muted"></small>
                  </div>
                  <input type="hidden" id="id_carrera_edit_input" style="display: none">
                  <button type="submit" class="btn btn-primary btn_register_carrera">Guardar</button>
                  <button type="submit" class="btn btn-danger btn_cancelar_actualizacion" style="display:none">Cancelar Actualización</button>
            </div>

            <div class="col-sm-12 form-group" style="background-color: #ffffff;padding:20px 10px;">

                <table id="table_carreras" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Carrera</th>
                            <th>N# Alumnos</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table_carreras_body">
                        @foreach ($Listcarreras as $carrera)
                            <tr>
                                <td>
                                    {{$carrera->carrera}}
                                </td>
                                <td>
                                    {{$carrera->numero_alumnos}}
                                </td>
                                <td>
                                    <div>
                                        <button
                                            type="button" class="btn btn-danger btn_delete_carrera"
                                            data-id_carrera="{{$carrera->id_carrera}}"
                                            data-numero_alumnos="{{$carrera->numero_alumnos}}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button
                                            type="button" class="btn btn-info btn_edit_carrera"
                                            data-id_carrera="{{$carrera->id_carrera}}"
                                            data-carrera="{{$carrera->carrera}}">
                                            <i class="fas fa-edit"></i>
                                       </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- fin del col --}}
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
<script src="{{asset('js/helpers/idiomaEspañolDataTable.js')}}"></script>

<script>

var btn_close_Alert=` <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>`;


$('.btn_cancelar_actualizacion').on('click',function(){
    $('#id_carrera_edit_input').val('');
    $('.btn_register_carrera').html("Guardar");
    $('.btn_cancelar_actualizacion').css({'display':'none'});
    $('#carrera_input').val('');

});

$('#carrera_input').on('keypress',function(e){
    var code = (e.keyCode ? e.keyCode : e.which);
    if(code==13){
        $('.btn_register_carrera').click();
    }
});


$(document).on('click','.btn_edit_carrera',function(){

    let id_carrera=$(this).data('id_carrera');
    let name_carrera=$(this).data('carrera');
    $('#id_carrera_edit_input').val(id_carrera);
    $('.btn_register_carrera').html("Actualizar");
    $('.btn_cancelar_actualizacion').css({'display':''});

    $('#carrera_input').val(name_carrera);
});


$(document).on('click','.btn_delete_carrera',function(){

    let this_element=$(this);
    var text_this_element=$(this).html();
    console.log(text_this_element)

    let numero_alumnos=$(this).data('numero_alumnos');
    if(numero_alumnos>0){

        $('.error_alert_container').html(`<div class='alert alert-warning alert-dismissible fade show'>NOTA:CUANDO LA CARRERA TIENE ALUMNOS ASIGNADOS NO SE PUEDE ELIMINAR..</div>`);
        $("html, body").animate({ scrollTop: 0 }, 600);
        // return false;
    }

    let id_carrera=$(this).data('id_carrera');
    console.log(id_carrera)


    $.ajax({
          url :`/Admin/carreras/${id_carrera}`,
          type:'DELETE',
          headers:{"X-CSRF-Token": csrf_token},
          data :{},
          beforeSend:function(){
             $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
            }
        })
        .done(function(respuesta) {

            console.log(respuesta);

            $(this_element).html(text_this_element).removeAttr('disabled');
            var data=JSON.parse(respuesta);
            console.log(data);

            if(data.status=="400"){
               $('.error_alert_container').html(`<div class='alert alert-danger alert-dismissible fade show'>${data.info} ${btn_close_Alert}</div>`);
            }
            if(data.status=="200"){
                pintarTablaCarrera(data.data)
                $('.error_alert_container').html(`<div class='alert alert-success alert-dismissible fade show'>${data.info} ${btn_close_Alert}</div>`);
            }
            $("html, body").animate({ scrollTop: 0 }, 600);

        }).fail(function(jqXHR,textStatus) {

            console.error(jqXHR.responseJSON);
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
             incluyendo la propiedad jqXHR.status que contiene,
             entre otros posibles, el código de estado HTTP de la respuesta. */
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
             $(this_element).html(text_this_element).removeAttr('disabled');

         })
});



$('.btn_register_carrera').on('click',function(){

    let carrera=$('#carrera_input').val();
    let id_carrera=$('#id_carrera_edit_input').val();

    if(carrera==""){
        $('.error_alert_container').html(`<div class='alert alert-danger alert-dismissible fade show'> <strong>DEBES INGRESAR EL NOMBRE DE LA CARRERA</strong> ${btn_close_Alert}</div>`);
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    }
    let this_element=$(this);
    let texto_button=$(this).html();
    $('.error_alert_container').html('<div class="alert alert-warning"><i class="fas fa-sync fa-spin"></i> Cargando.......</div>');


    let formData={
        'carrera':carrera,
        'id_carrera':'',
        'action':'store'
    }

    if(id_carrera!=""){
        formData={
            'carrera':carrera,
            'id_carrera':id_carrera,
            'action':'update'
        }
    }


    $.ajax(
        {
          url :'/Admin/carreras',
          type:'POST',
          headers:{"X-CSRF-Token": csrf_token},
          data :formData,
          beforeSend:function(){

            $('.error_alert_container').html('');
             $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
            }
        })
        .done(function(respuesta) {

            $(this_element).html(texto_button).removeAttr('disabled');
            var data=JSON.parse(respuesta);
            console.log(data);


            if(data.errors){
                let list_errors="";
                for (const key in data.errors) {
                    list_errors+=`<li>${data.errors[key]}</li>`;
                    console.log(list_errors);
                }
                $('.error_alert_container').html(`<div class='alert alert-danger alert-dismissible fade show'><ul>${list_errors}</ul> ${btn_close_Alert}</div>`);
                $("html, body").animate({ scrollTop: 0 }, 600);
                return false;
            }

            if(data.status=="400"){
               $('.error_alert_container').html(`<div class='alert alert-danger alert-dismissible fade show'>${data.info} ${btn_close_Alert}</div>`);
            }
            if(data.status=="200"){
               $('.error_alert_container').html(`<div class='alert alert-success alert-dismissible fade show'>${data.info} ${btn_close_Alert}</div>`);

               pintarTablaCarrera(data.data)

            //    $('#table_carreras_body').html();

            }
            $("html, body").animate({ scrollTop: 0 }, 600);

        }).fail(function(jqXHR,textStatus) {
            $('.error_alert_container').html('');
            console.error(jqXHR.responseJSON);
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
             incluyendo la propiedad jqXHR.status que contiene,
             entre otros posibles, el código de estado HTTP de la respuesta. */
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
             $(this_element).html(texto_button).removeAttr('disabled');

         })
});


function pintarTablaCarrera(data){

let filas="";

// iterator.matricula
for (const iterator of data) {
    filas+=`
    <tr>
        <td>${iterator.carrera}</td>
        <td>${iterator.numero_alumnos}</td>
        <td>
            <div>
                <button
                    data-id_carrera="${iterator.id_carrera}"
                    data-numero_alumnos="${iterator.numero_alumnos}"
                    type="button"
                    class="btn btn-block btn-danger btn_delete_carrera">
                    <i class="fas fa-trash-alt"></i>
                </button>
                <button
                    data-id_carrera="${iterator.id_carrera}"
                    data-carrera="${iterator.carrera}"
                    type="button"
                    class="btn btn-block btn-info btn_edit_carrera">
                    <i class="fas fa-edit"></i>
                </button>
            </div>
        </td>
    </tr>
    `;
}

$('#table_carreras').DataTable().clear().destroy();
$('#table_carreras_body').html(filas);
$('#table_carreras').DataTable({
    "order": [
        [0, 'desc'],
        [1, 'desc']
    ],
    "language":language
});

}


$('#table_carreras').DataTable({
    "order": [
        [0, 'desc'],
        [1, 'desc']
    ],
    "language":language
});

</script>

@endsection
