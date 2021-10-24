
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
            <h4 class="display-4" style="color:#B16A26">Evaluación del estudiante al tutor individual</h4>
            <h5>Periodo {{$periodo}}</h5>
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="feather icon-user"></i></a></li>
                    <li class="breadcrumb-item active">Datos del tutor</li>
                </ol>
            </div>
            @if (count($tutor)>0)
            <div class="col-sm-12">
                <h5 class="text-muted">Total de tutores individuales asignados <span class="badge badge-warning">{{count($tutor)}}</span></h5>
            </div>
            <div id="accordion">

                 <?php
                    $id_card=1;
                    $id_user_tutor="";
                    foreach ($tutor as $key => $item) {

                        $id_user_tutor=$item->id;
                        $nombre_tutor_input=ucwords($item->nombre.' '.$item->ap_paterno.' '.$item->ap_materno);
                        # code...?>
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-info" data-toggle="collapse" data-target="#collapse_{{$id_card}}" aria-expanded="true" aria-controls="collapse_{{$id_card}}">
                                    {{ $nombre_tutor_input}}
                                    </button>
                                </h5>
                            </div>

                            <div id="collapse_{{$id_card}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-body p-5">
                                        <div class="row">
                                            <div class="col-sm-8 pb-4">
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
                                            <div class="col-sm-4 text-right pb-4">
                                                <img  src="{{asset('storage').'/'.$item->photo}}" style="height:100px;object-fit: cover;border-radius:7px;" alt="imagenPerfil">
                                            </div>
                                        </div>
                                        <hr class="mb-4">

                                        <div class="row table_contenedor">
                                            <div class="col-sm-12 conte_msg_errors_success">

                                             </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="row col-sm-12">
                                                    <div class="col-sm-12 font-weight-bold mb-2"><i class="sidenav-icon fas fa-user"></i> Datos del tutor:</div>
                                                    <div class="col-sm-4">
                                                        <strong style="display:block;color:#DF480F">Nombre completo:</strong> {{ucwords($item->nombre.' '.$item->ap_paterno.' '.$item->ap_materno)}}
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <strong style="display:block;color:#DF480F">Correo</strong> {{ucwords($item->email)}}
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
                                                        @if ($item->id_asignacion!=null)
                                                            <th class="py-3" colspan="2">
                                                                <strong style="color:#FF5733">Carrera</strong>
                                                            {{$item->name_carrera}}
                                                            </th>
                                                            <th class="py-3">
                                                                <strong style="color:#FF5733">Semestre</strong>
                                                                {{$item->semestre}} °

                                                            </th>
                                                            <th class="py-3">
                                                                <strong style="color:#FF5733">Turno</strong>
                                                                {{$item->turno}}
                                                            </th>
                                                            <th class="py-3">
                                                                <strong style="color:#FF5733">Grupo</strong>
                                                                ({{$item->grupo}})
                                                            </th>
                                                        @else
                                                            <th colspan="4">{{ $item->nombre}} No tiene asignación de grupo</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                            </table>

                                            @if (count($preguntas)>0)
                                                <?php
                                                    $status_cuestionario=false;
                                                    $cuestionario_arreglo=[];

                                                    foreach ($cuestionario as $key => $cuest) {
                                                        # code...
                                                        if($cuest->id_user_tutor==$item->id){
                                                            $status_cuestionario=true;
                                                            $cuestionario_arreglo=$cuest;
                                                            break;
                                                        }
                                                    }
                                                ?>
                                                @if ($status_cuestionario)
                                                     {{-- mostrar cuestionario contestado --}}

                                                         <?php

                                                            // print_r($cuestionario_arreglo);

                                                         ?>
                                                     <div class="col-sm-12">
                                                        <div class="alert alert-success" role="alert">
                                                            Muchas gracias por tu participación
                                                          </div>
                                                         <span class="badge badge-warning">Periodo: {{$cuestionario_arreglo->{'periodo'} }} </span>
                                                         <span class="badge badge-success">Fecha: {{$cuestionario_arreglo->{'fecha_created_cuestionario'} }}</span>
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
                                                                $respuestas_cuestionario=json_decode($cuestionario_arreglo->{'respuestas_cuestionario'},true);
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
                                                                    <textarea disabled name="observaciones" id="observaciones" cols="5" rows="5" class="form-control">
                                                                        {{$cuestionario_arreglo->{'observacion'} }}
                                                                    </textarea>
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
                                                                <tr data-id="{{$item->id_pregunta}}" data-id_user_tutor="{{$id_user_tutor }}">
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

                                                            <tr class="conte_padre_tr">
                                                                <td colspan="5">
                                                                    <label for="" class="col-form-label"><strong>Observaciones</strong></label>
                                                                    <textarea name="observaciones" class="form-control observaciones" cols="5" rows="5"></textarea>
                                                                    <input type="hidden" class="nombre_tutor" value="{{$nombre_tutor_input}}">
                                                                    <input type="hidden" class="tipo_cuestionario" value="individual">
                                                                    <input type="hidden" class="id_user_tutor" value="{{$id_user_tutor}}">
                                                                    <button class="btn btn-primary btn-block btn_register_cuestionario">Guardar</button>
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
                                        </div>
                                    </div>
                                </div>


                            </div>
                            </div>
                        </div>
                    <?php
                        $id_card=$id_card+1;

                    }

                ?>
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
                                <strong style="color: #DF480F">No tienes tutores individuales asignado.</strong>
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

    $(document).on('click','.btn_register_cuestionario',function(){

        let this_element_padre=$(this).parents('.conte_padre_tr');
        let observaciones=this_element_padre.find('.observaciones').val();
        let id_user_tutor=this_element_padre.find('.id_user_tutor').val();
        let nombre_tutor=this_element_padre.find('.nombre_tutor').val();

        list_errors_preguntas=[];

        $('.conte_msg_errors_success').html('');

        // console.log(preguntasArreglo);

        let lista_preguntas_faltantes=[];

        let datos_del_cuestionario_arreglo=[];

        for (let e = 0; e < preguntasArreglo.length; e++) {
                // console.log(preguntasArreglo[e]['id']);
            if(preguntasArreglo[e]['id']==id_user_tutor){
                datos_del_cuestionario_arreglo=preguntasArreglo[e]['preguntas'];
            }
        }

        console.log(datos_del_cuestionario_arreglo);

        for (let index = 0; index < PREGUNTAS_ARREGLO_DB.length; index++) {

            let id_pregunta_db=PREGUNTAS_ARREGLO_DB[index].id_pregunta;
            console.log("db"+id_pregunta_db)
            let status_search=false;
                for (const item of datos_del_cuestionario_arreglo) {
                        // console.log(item)
                        if(id_pregunta_db==item.id_pregunta){
                            status_search=true;
                            break;
                        }
                 }
                if(status_search==false){
                    list_errors_preguntas.push(id_pregunta_db);
                }
        }


        if(list_errors_preguntas.length>0){
            $(this).parents('.table_contenedor').find('.conte_msg_errors_success').html(`
                <div class="col-sm-12 d-flex justify-content-center" style="border:1px solid red;margin-bottom:30px; padding:10px;">
                    <h1 class="display-4" ><i class="fas fa-grimace"></i>
                        <strong style="color: #DF480F;padding:10px;">
                            <div style="display:block">Del cuestionario de: ${nombre_tutor}</div>
                              te hacen falta contestar las preguntas.
                        </strong>
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
             'data':datos_del_cuestionario_arreglo,
             'observaciones':observaciones,
             'tipo_cuestionario':'individual',
             'id_user_tutor':id_user_tutor
         };
         let this_element=$(this);
         guardarCuestionario(objectPreguntas,this_element);
        // console.log(list_errors_preguntas.toString());

    });

    function guardarCuestionario(objectPreguntas,this_element){

        let this_element_texto=$(this_element).html();
        $.ajax(
        {
          url :'/alumnoCuestionario/RegistrarCuestioarioIndividual',
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
                $(this_element).parents('.table_contenedor').find('.conte_msg_errors_success').html(`<div class='alert alert-danger alert-dismissible fade show'>${json.info}  ${btn_close_Alert}</div>`);
            }
            if(json.status=="200"){
                preguntasArreglo=[];
                $(this_element).html(this_element_texto).removeAttr('disabled').css({'display':'none'});
                $(this_element).parents('.table_contenedor').find('.conte_msg_errors_success').html(`<div class='alert alert-success alert-dismissible fade show'>${json.info}  ${btn_close_Alert}</div>`);
            }

            $("html, body").animate({ scrollTop: 0 }, 600);
        }).fail(function(jqXHR,textStatus) {

            console.error(jqXHR.responseJSON);
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
             $(this_element).html(this_element_texto).removeAttr('disabled');

         })

    }



    $('.btn_seleccinar_respuesta').on('change',function(){

        let id_user_tutor=$(this).parents('tr').data('id_user_tutor');
        let id_pregunta=$(this).parents('tr').data('id');
        let respuesta=$(this).data('respuesta');

        let formPregunta={'id_pregunta':id_pregunta,'respuesta':respuesta}
        respuestas(id_user_tutor,formPregunta);
    });


    function respuestas(id,object_datos_pregunta){
        let status=false;

        let id_pregunta_obj=object_datos_pregunta.id_pregunta;
        let respuesta_obj=object_datos_pregunta.respuesta

        let index=0;
        // buscar si ya esta mi usuario tutor en mi arreglo
        for (let i = 0; i < preguntasArreglo.length; i++) {
            if(id==preguntasArreglo[i]['id']){
                index=i;
                status=true;
                break;
            }
        }
        // buscar si ya esta mi usuario tutor en mi arreglo

        if(status==false){
            // agregr
            preguntasArreglo.push({'id':id,'preguntas':[object_datos_pregunta]})
            // console.log(preguntasArreglo);
        }else{
            // console.log(preguntasArreglo[index].preguntas)
            let search_pregunta=false;

            let items=preguntasArreglo[index].preguntas;
            for (let j = 0; j < items.length; j++) {
                search_pregunta=false;
                // console.log(preguntasArreglo[index].preguntas[j]);
                // console.log(preguntasArreglo[index].preguntas[j].id_pregunta);
                // console.log(preguntasArreglo[index].preguntas[j].respuesta);
                if(preguntasArreglo[index].preguntas[j].id_pregunta==id_pregunta_obj){
                    preguntasArreglo[index].preguntas[j].respuesta=respuesta_obj;
                    search_pregunta=true;
                    break;
                 }
            }
            if(search_pregunta==false){
                preguntasArreglo[index].preguntas.push(object_datos_pregunta);
            }
        }
    }


</script>

@endsection
