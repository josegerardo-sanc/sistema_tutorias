
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
            <h4 class="display-4" style="color:#DF480F">Cuestionario Individual</h4>
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
                            {{-- <h6 class="text-big text-large font-weight-bold mb-3">Tutor</h6> --}}
                            <img  src="{{asset('storage').'/'.$tutor[0]->photo}}" style="height:100px;object-fit: cover;border-radius:7px;" alt="imagenPerfil">
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="row">
                        <div class="col-sm-12 conte_msg_errors_success">

                         </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="row col-sm-12">
                                <div class="col-sm-12 font-weight-bold mb-2"><i class="sidenav-icon fas fa-user"></i> Datos del tutor:</div>
                                <div class="col-sm-4">
                                    <strong style="display:block;color:#DF480F">Nombre completo:</strong> {{ucwords($tutor[0]->nombre.' '.$tutor[0]->ap_paterno.' '.$tutor[0]->ap_materno)}}
                                </div>
                                <div class="col-sm-3">
                                    <strong style="display:block;color:#DF480F">Correo</strong> {{ucwords($tutor[0]->email)}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">
                    <div class="col-sm-12 font-weight-bold mb-2 mt-4">
                        <a href="#" class="text-muted">Instrucciones: selecciona la respuesta correcta, de acuerdo al desempeño del docente tutor del grupo mostrado durante el semestre</a>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th class="py-3" colspan="2">
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
                        </table>

                        @if (count($preguntas)>0)

                            @if (count($cuestionario)>0)
                                <div class="col-sm-12">
                                    <div class="alert alert-success" role="alert">
                                        Muchas gracias por tu participación
                                      </div>
                                     <span class="badge badge-warning">Periodo: {{$cuestionario[0]->periodo}}</span>
                                     <span class="badge badge-success">Fecha: {{$cuestionario[0]->fecha_created_cuestionario}}</span>

                                </div>
                                <table class="table mt-4">
                                    <thead>
                                    <tr>
                                            <th class="py-3">
                                                <i class="sidenav-icon fas fa-tags"></i>  Indicadores
                                            </th>
                                            <th class="py-3">Siempre</th>
                                            <th class="py-3">Casi siempre</th>
                                            <th class="py-3">A veces</th>
                                            <th class="py-3">Nunca</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            $respuestas_cuestionario=json_decode($cuestionario[0]->respuestas_cuestionario,true);

                                            foreach ($preguntas as $key => $pregunta) {
                                                # code...
                                                foreach ($respuestas_cuestionario as $key => $respuesta) {
                                                    # code...
                                                    if($pregunta->id_pregunta==$respuesta['id_pregunta']){
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                {{ $pregunta->pregunta}}
                                                            </td>
                                                            <th class="py-3">
                                                                <input type="radio" class="btn_seleccinar_respuesta" data-respuesta="siempre"
                                                                  <?php echo $respuesta['respuesta']=="siempre"?'checked':''; ?>
                                                                disabled>
                                                            </th>

                                                            <th class="py-3">
                                                                <input type="radio" class="btn_seleccinar_respuesta" data-respuesta="casi_siempre"
                                                                <?php echo $respuesta['respuesta']=="casi_siempre"?'checked':''; ?>
                                                                disabled>
                                                            </th>

                                                            <th class="py-3">
                                                                <input type="radio" class="btn_seleccinar_respuesta" data-respuesta="a_veces"
                                                                <?php echo $respuesta['respuesta']=="a_veces"?'checked':''; ?>
                                                                disabled>
                                                            </th>
                                                            <th class="py-3">
                                                                <input type="radio" class="btn_seleccinar_respuesta" data-respuesta="nunca"
                                                                <?php echo $respuesta['respuesta']=="nunca"?'checked':''; ?>
                                                                disabled>
                                                            </th>
                                                        </tr>

                                                    <?php
                                                    }
                                                }
                                            }

                                        ?>
                                        <tr>
                                            <td colspan="5">
                                                <label for="" class="col-form-label"><strong>Observaciones</strong></label>
                                                <textarea disabled name="observaciones" id="observaciones" cols="5" rows="5" class="form-control">{{$cuestionario[0]->observacion}}</textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <table class="table mt-4">
                                    <thead>
                                    <tr>
                                            <th class="py-3">
                                                <i class="sidenav-icon fas fa-tags"></i>  Indicadores
                                            </th>
                                            <th class="py-3">Siempre</th>
                                            <th class="py-3">Casi siempre</th>
                                            <th class="py-3">A veces</th>
                                            <th class="py-3">Nunca</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $numero_pregunta=1;
                                        ?>
                                        @foreach ($preguntas as $item)
                                            <tr data-id="{{$item->id_pregunta}}">
                                                    <td>
                                                        {{ $item->pregunta}}
                                                    </td>
                                                    <th class="py-3">
                                                        <input type="radio" name="pregunta_{{$numero_pregunta}}" class="btn_seleccinar_respuesta" data-respuesta="siempre">
                                                    </th>

                                                    <th class="py-3">
                                                        <input type="radio" name="pregunta_{{$numero_pregunta}}" class="btn_seleccinar_respuesta" data-respuesta="casi_siempre">
                                                    </th>

                                                    <th class="py-3">
                                                        <input type="radio" name="pregunta_{{$numero_pregunta}}" class="btn_seleccinar_respuesta" data-respuesta="a_veces">
                                                    </th>
                                                    <th class="py-3">
                                                        <input type="radio" name="pregunta_{{$numero_pregunta}}" class="btn_seleccinar_respuesta" data-respuesta="nunca">
                                                    </th>
                                            </tr>
                                        <?php
                                            $numero_pregunta=$numero_pregunta+1;
                                        ?>
                                        @endforeach

                                        <tr>
                                            <td colspan="5">
                                                <label for="" class="col-form-label"><strong>Observaciones</strong></label>
                                                <textarea name="observaciones" id="observaciones" cols="5" rows="5" class="form-control"></textarea>
                                                <input type="hidden" name="" id="tipo_cuestionario" value="individual">
                                                <input type="hidden" name="" id="id_user_tutor" value="{{$tutor[0]->user_id_asignado}}">
                                                <button class="btn btn-primary btn-block" id="btn_register_cuestionario">Guardar</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        @else
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="display-4 text-muted">No se han encontrado Preguntas.</h4>
                                </div>
                            </div>
                         </div>
                        @endif
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

    var preguntasArreglo=[];
    var list_errors_preguntas=[];

    var PREGUNTAS_ARREGLO_DB=<?php echo json_encode($preguntas)?>;
    console.log(PREGUNTAS_ARREGLO_DB);



    $('#btn_register_cuestionario').on('click',function(){
        list_errors_preguntas=[];
        $('.conte_msg_errors_success').html('');

        console.log(preguntasArreglo);

        let lista_preguntas_faltantes=[];

        for (let index = 0; index < PREGUNTAS_ARREGLO_DB.length; index++) {
            let id_pregunta_db=PREGUNTAS_ARREGLO_DB[index].id_pregunta;
            let status_search=false;

            for (let index = 0; index < preguntasArreglo.length; index++) {
                let id_pregunta_local=preguntasArreglo[index].id_pregunta;

                if(id_pregunta_db==id_pregunta_local){
                    status_search=true;
                    break;
                }
            }

            if(status_search==false){
                list_errors_preguntas.push(id_pregunta_db);
            }
        }


        if(list_errors_preguntas.length>0){
            $('.conte_msg_errors_success').html(`
                <div class="col-sm-12 d-flex justify-content-center" style="border:1px solid red;margin-bottom:30px; padding:10px;">
                    <h1 class="display-4" ><i class="fas fa-grimace"></i>
                        <strong style="color: #DF480F;padding:10px;">Espera te hacen falta las preguntas.</strong>
                        <div style="display:block">
                            <strong style="font-size:20px">${list_errors_preguntas.toString()}</strong>
                        </div>
                    </h1>
                </div>
            `);

            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        }

         let objectPreguntas={
             'data':preguntasArreglo,
             'observaciones':$('#observaciones').val(),
             'tipo_cuestionario':$('#tipo_cuestionario').val(),
             'id_user_tutor':$('#id_user_tutor').val()
         };
         let this_element=$(this);
         guardarCuestionario(objectPreguntas,this_element);
        // console.log(list_errors_preguntas.toString());

    });

    function guardarCuestionario(objectPreguntas,this_element){

        let this_element_texto=$(this_element).html();
        $.ajax(
        {
          url :'/alumnoCuestionario/Registrar',
          type:'POST',
          headers:{"X-CSRF-Token": csrf_token},
          data :objectPreguntas,
          beforeSend:function(){
             $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
            }
        })
        .done(function(respuesta) {
            console.log(respuesta)


            $(this_element).html(this_element_texto).removeAttr('disabled');
            var json=JSON.parse(respuesta);
            console.log(json);

            var btn_close_Alert=` <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>`;


            if(json.status=="400"){
               $('.conte_msg_errors_success').html(`<div class='alert alert-danger alert-dismissible fade show'>${json.info}  ${btn_close_Alert}</div>`);
            }
            if(json.status=="200"){

                $(this_element).html(this_element_texto).removeAttr('disabled').css({'display':'none'});
                $('.conte_msg_errors_success').html(`<div class='alert alert-success alert-dismissible fade show'>${json.info}  ${btn_close_Alert}</div>`);
            }

            $("html, body").animate({ scrollTop: 0 }, 600);
        }).fail(function(jqXHR,textStatus) {

            console.error(jqXHR.responseJSON);
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
             $(this_element).html(this_element_texto).removeAttr('disabled');

         })

    }



    $('.btn_seleccinar_respuesta').on('change',function(){

        let id_pregunta=$(this).parents('tr').data('id');
        let respuesta=$(this).data('respuesta');

        let pregunta_cuestionario={
            'id_pregunta':id_pregunta,
            'respuesta':respuesta
        };

        console.log(pregunta_cuestionario);

        respuestas(id_pregunta,pregunta_cuestionario);

    });


    function respuestas(id_pregunta,objectPregunta){

        let search_status=false;

        for (let index = 0; index < preguntasArreglo.length; index++) {
            // console.log(preguntasArreglo[index].id_pregunta);
            let id=preguntasArreglo[index].id_pregunta;


            if(id==id_pregunta){
                preguntasArreglo[index].respuesta=objectPregunta.respuesta;
                search_status=true;
            }
        }

        if(search_status==false){
            preguntasArreglo.push(objectPregunta);
        }
    }

</script>

@endsection
