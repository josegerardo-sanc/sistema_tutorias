
@extends('layouts.body')
@section('css')

@endsection

@section('contenido_page')
<div class="layout-content">

    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0">Lista de carreras</h4>

        <div class="row">
            {{-- error container --}}
            <div class="col-sm-12 error_alert_container"></div>

            <div class="col-sm-12 form-group"  style="background-color: #ffffff;padding:20px 10px;">
                <div class="form-group">
                    <label for="carrera">Carrera</label>
                    <input type="text" class="form-control" id="carrera_input" aria-describedby="carrera" placeholder="INGRESE LA CARRERA">
                    <small id="error_carrera" class="form-text text-muted"></small>
                  </div>
                  <button type="submit" class="btn btn-primary btn_register_carrera">Guardar</button>
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
                                        <button type="button" class="btn btn-danger"
                                        data-id_carrera="{{$carrera->id_carrera}}"
                                        >Eliminar</button>
                                        <button type="button" class="btn btn-warning"
                                        data-id_carrera="{{$carrera->id_carrera}}"
                                        >Editar</button>
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

$('#carrera_input').on('keypress',function(e){
    var code = (e.keyCode ? e.keyCode : e.which);
    if(code==13){
        $('.btn_register_carrera').click();
    }
});


$('.btn_register_carrera').on('click',function(){

    let carrera=$('#carrera_input').val();

    var btn_close_Alert=` <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>`;

    if(carrera==""){
        $('.error_alert_container').html(`<div class='alert alert-danger alert-dismissible fade show'> <strong>DEBES INGRESAR EL NOMBRE DE LA CARRERA</strong> ${btn_close_Alert}</div>`);
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    }

    let this_element=$(this);
    let texto_button=$(this).text();

    $('.error_alert_container').html('<div class="alert alert-warning"><i class="fas fa-sync fa-spin"></i> Cargando.......</div>');
     $.ajax(
        {
          url :'/Admin/carreras',
          type:'POST',
          headers:{"X-CSRF-Token": csrf_token},
          data :{'carrera':carrera},
          beforeSend:function(){
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



            //    $('#table_carreras_body').html();

            }
            $("html, body").animate({ scrollTop: 0 }, 600);

        }).fail(function(jqXHR,textStatus) {

            console.error(jqXHR.responseJSON);
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
             incluyendo la propiedad jqXHR.status que contiene,
             entre otros posibles, el código de estado HTTP de la respuesta. */
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
             $(this_element).html(texto_button).removeAttr('disabled');

         })
});


$('#table_carreras').DataTable({
    "order": [
        [0, 'desc'],
        [1, 'desc']
    ],
    "language":language
});

</script>

@endsection
