@extends('layouts.body')




@section('css')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@endsection


@section('contenido_page')
    <div class="layout-content">
    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="display-4" style="color:#B16A26"><strong>Segumiento de la actividad tutorial</strong></h4>
        <div class="col-sm-12 contenedor_exception"></div>

        <div class="card" id="mostrarInformacinBusqueda" style="display:none">
            <small class="card-body">
                <ul style="list-style: none;margin:0px;" class="text-warning">
                    <li> 1.-si requieres obtener todos las evaluaciones de un tutor
                        <ul>
                            <li>selecciona carrera</li>
                            <li>selecciona tutor</li>
                        </ul>
                    </li>
                    <li>2.-si requieres solo una evaluacion en especifico de un tutor
                        <ul>
                            <li>selecciona carrera</li>
                            <li>selecciona tutor</li>
                            <li>selecciona fecha</li>
                        </ul>
                    </li>
                </ul>
            </small>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label class="form-label label_filter d-flex justify-content-between align-items-center">Carrera <strong class="carreras_select_textError"></strong></label>
                        <select id="selected_options_evaluaciones" class="form-control">
                            <option value="1"  selected>Registrar Evaluación</option>
                            <option value="2">Consultar evaluación ó evaluaciones</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4 form-group">
                        <label class="form-label label_filter d-flex justify-content-between align-items-center">Carrera <strong class="carreras_select_textError"></strong></label>
                        <select  name="carreras" id="carreras" class="form-control carreras_select">
                            <option value="0" disabled selected>Seleccione Carrera</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4 form-group">
                        <label class="form-label label_filter d-flex justify-content-between align-items-center">Lista de tutores   <strong id="conte_init_selecte_tutores" class="text-muted"></strong></label>
                        <select class="form-control init_selecte_tutores" id="init_selecte_tutores">
                            <option value="0" selected disabled>Seleccione un tutor</option>
                        </select>
                        <div class="error_select_tutor"></div>
                    </div>
                    <div class="col-sm-12 col-md-4 form-group">
                        <label for=""class="form-label label_filter d-flex justify-content-between align-items-center"><strong>Periodo</strong></label>
                        <input type="date" name="fechaEvaluacion" id="fechaEvaluacion" class="form-control" />
                    </div>

                    <div class="col-sm-12">
                        <button class="btn btn-primary float-right  mt-4 mb-4" id="btn_consultar_evaluaciones" style="display: none">
                            Consultar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="mostrar_titulo_conte">
            <div class="col-sm-12 card">
                <ul class="d-flex justify-content-around flex-wrap" style="list-style: none;padding:10px;">
                    <li class="text-muted text-left" style="font-size:20px;">Carrera <strong style="color:black;" id="carrera_selecionada"></strong></li>
                    <li class="text-muted text-left" style="font-size:20px;">Periodo <strong style="color:black;" id="cicloEscolar_selecionado"></strong></li>
                    <li class="text-muted text-left" style="font-size:20px;" style="display: none" id="item_li_tutor">Tutor <strong style="color:black;" id="tutor_seleccionado"></strong></li>
                </ul>
                <div class="card-body" id="contenedor_evaluacion_option_1">
                    <table class="table table-responsive">
                        <tbody>
                            <tr>
                                <td>
                                    <input type="radio" name="" class="" id="pregunta_1">
                                </td>
                                <td>
                                    <p>Realiza el diagnóstico del tutorado y detecta áreas de atención en estudiantes.</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="" class="" id="pregunta_2">
                                </td>
                                <td>
                                    <p>
                                        Realiza el diagnóstico del tutorado y detecta áreas de atención en estudiantes,lleva acabo sesiones
                                        planeadas individuales o grupales.
                                        canaliza estudiantes
                                    </p>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="" class="" id="pregunta_3">
                                </td>
                                <td>
                                   <p>Entrega los resportes en tiempo y forma</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="" class="" id="pregunta_4">
                                </td>
                                <td>
                                    <p>
                                        Realiza el diagnóstico del tutorado, detecta áreas de atención en el estudiantes lleva acabo sesiones
                                        planeadas individuales o grupales canaliza estudiantes.
                                        </br>
                                        Entrega reportes con evidencias de las actividades desarolladas en el programa de accción tutorial en tiempo y forma.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="" class="" id="pregunta_5">
                                </td>
                                <td>
                                <p>
                                    Realiza el diagnóstico del tutorado, detecta área de atención en estudiantes,lleva acabo sesiones
                                    planeadas individuales o grupales canaliza estudiantes
                                    </br>
                                    Entrega reportes con evidencias de las actividades desarollada en el programa de accción tutorial en tiempo y forma
                                    </br>
                                    Elabora el diagnóstico institucional de tutorias para aplicar el programa institucional de tutorias.
                                    </br>
                                    Elabora el plan de acción tutorial para el periodo escolar y da seguimiento.
                                </p>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <div class="col-sm-12">
                        <button class="btn btn-success btn-block" id="btn_guardar_evaluacion">Guardar</button>
                    </div>
                </div>
                <div class="card-body" id="contenedor_busqueda_personalizada">

                </div>
            </div>
        </div>
    </div>
    <!-- [ content ] End -->
</div>
@endsection


@section('script')
<script src="{{asset('js/helpers/GetCarreras.js')}}"></script>
{{-- chartjs --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

<script>

$('#btn_reset_carrera_default').on('click',function(){
    $('#carreras').val(0)
        // $('#fechaEvaluacion').val('');
});


$('#btn_consultar_evaluaciones').on('click',function(){
    let id_carrera=$('.carreras_select option:selected').val();
    let id_tutor=$('#init_selecte_tutores option:selected').val();
    let fecha=$('#fechaEvaluacion').val();

    let objectEvaluacion={
        'idtutor':id_tutor,
        'idcarrera':id_carrera,
        'fechaEvaluacion':fecha
    }
    console.log(objectEvaluacion);
    ObtenerListaEvaluaciones(objectEvaluacion,$(this));
});

function ObtenerListaEvaluaciones(objecData,this_element){

    let this_element_text=$(this_element).html();

    $.ajax({
            url :'/obtenerlistaSegumiento/tutorial',
            type: "POST",
            headers:{"X-CSRF-Token": csrf_token},
            data :objecData,
            beforeSend:function(){
                $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
            }

            }).done(function(respuesta){

                $(this_element).html(this_element_text).removeAttr('disabled');
                //console.log(respuesta);
                let json=JSON.parse(respuesta);
                console.log(json);

                let alert="";
                if(json.status=="400"){
                    $('.contenedor_exception').html(`<div class='alert alert-danger alert-dismissible fade show'>${json.info}</div>`);
                }
                if(json.status=="200"){
                    let contador=1;

                    if(json.data.length>0){
                        let html_table_evaluaciones="";
                        for (const item of json.data) {

                            respuestas=JSON.parse(item.respuestas_evaluacion);
                            console.log(respuestas);

                            html_table_evaluaciones+=`
                               <h5 class="text-muted text-primary">
                                ${contador}.- Fecha de registro ${item.fecha_evaluacion} periodo ${item.periodo}</h5>
                               <table class="table table-responsive">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    ${respuestas.pregunta_1=="true"
                                                    ?'<strong style="color:green;font-size:20px;"> <i class="far fa-check-square"></i></strong>'
                                                    :'<strong style="color:red;font-size:20px;"> <i class="far fa-times-circle"></i></strong>'}
                                                </td>
                                                <td>
                                                    <p>Realiza el diagnóstico del tutorado y detecta área de atención en estudiantes.</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ${respuestas.pregunta_2=="true"
                                                    ?'<strong style="color:green;font-size:20px;"> <i class="far fa-check-square"></i></strong>'
                                                    :'<strong style="color:red;font-size:20px;"> <i class="far fa-times-circle"></i></strong>'}
                                                </td>
                                                <td>
                                                    <p>
                                                        Realiza el diagnóstico del tutorado y detecta área de atención en estudiantes,lleva acabo sessiones
                                                        planeadas individuales o grupales.
                                                        canaliza estudiantes
                                                    </p>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ${respuestas.pregunta_3=="true"
                                                    ?'<strong style="color:green;font-size:20px;"> <i class="far fa-check-square"></i></strong>'
                                                    :'<strong style="color:red;font-size:20px;"> <i class="far fa-times-circle"></i></strong>'}
                                                </td>
                                                <td>
                                                 <p>Entrega los resportes en tiempo y forma</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ${respuestas.pregunta_4=="true"
                                                    ?'<strong style="color:green;font-size:20px;"> <i class="far fa-check-square"></i></strong>'
                                                    :'<strong style="color:red;font-size:20px;"> <i class="far fa-times-circle"></i></strong>'}
                                                </td>
                                                <td>
                                                    <p>
                                                        Realiza el diagnóstico del tutorado y detecta área de atención en estudiantes,lleva acabo sessiones
                                                        planeadas individuales o grupales canaliza estudiantes
                                                        </br>
                                                        Entrega reportes con evidencias de las actividades desarollada en el programa de accción tutorial en tiempo y forma
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ${respuestas.pregunta_5=="true"
                                                    ?'<strong style="color:green;font-size:20px;"> <i class="far fa-check-square"></i></strong>'
                                                    :'<strong style="color:red;font-size:20px;"> <i class="far fa-times-circle"></i></strong>'}
                                                </td>
                                                <td>
                                                <p>
                                                    Realiza el diagnóstico del tutorado y detecta área de atención en estudiantes,lleva acabo sessiones
                                                    planeadas individuales o grupales canaliza estudiantes
                                                    </br>
                                                    Entrega reportes con evidencias de las actividades desarollada en el programa de accción tutorial en tiempo y forma
                                                    </br>
                                                    Elabora el diagnóstico institucional de tutorias para aplicar el programa institucional de tutorias.
                                                    </br>
                                                    Elabora el plan de acción tutorial para el periodo escolar y da seguimiento.
                                                </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>`;
                            contador=contador+1;
                        }

                        $('#contenedor_busqueda_personalizada').html(html_table_evaluaciones);

                    }else{
                        $('#contenedor_busqueda_personalizada').html('<h3 class="display-4 justify-content-center text-center">No se encontraron resultados.</h3>');
                    }
                }
            }).fail(function(jqXHR,textStatus) {
                $(this_element).html(this_element_text).removeAttr('disabled');
                ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
            })
}


$('#carreras').on('change',function(){
    let id_carrera=$('#carreras option:selected').val();
    console.log(id_carrera);

    let carrera_text=$('#carreras option:selected').text();

    $('#carrera_selecionada').html(carrera_text);
    $('#contenedor_busqueda_personalizada').html("");
    obtenerListutoresAsignadoCarrera(id_carrera);
});

$('#fechaEvaluacion').on('change',function(){

    let fecha=$(this).val();

    console.log(fecha);

    if(fecha!=undefined){
        fecha=moment(fecha).format('DD/MM/YYYY')
        fecha_explode=fecha.split('/');

        let years="";
        if(fecha_explode['2']!="undefined"&&fecha_explode['2']!=undefined&&fecha_explode['2']!=""){
            years=fecha_explode['2'];
        }

        let periodo="";
        if(fecha_explode['1']>=8){
            periodo="Agosto-Diciembre "+years;
        }else{
            periodo="Febrero-Julio "+years;
        }
        $('#cicloEscolar_selecionado').html(periodo);
    }else{
        $('#cicloEscolar_selecionado').html("");
    }

});


$('#selected_options_evaluaciones').on('change',function(){

    let option_selected=$(this).val();
    $('#contenedor_evaluacion_option_1').css({'display':'none'});
    $('#mostrarInformacinBusqueda').css({'display':'none'});
    $('#btn_consultar_evaluaciones').css({'display':'none'});
    $('#item_li_tutor').css({'display':'none'});
    $('#contenedor_busqueda_personalizada').html("");

    if(option_selected==1){
        $('#contenedor_evaluacion_option_1').css({'display':''});
    }else{

        $('#btn_consultar_evaluaciones').css({'display':''});
        $('#mostrarInformacinBusqueda').css({'display':''});
        $('#item_li_tutor').css({'display':''});
        setTimeout(() => {
            $('#mostrarInformacinBusqueda').css({'display':'none'});
        },5000);
    }

});

$('#init_selecte_tutores').on('change',function(){

    let option_tutor_text=$('#init_selecte_tutores option:selected').text();
    $('#tutor_seleccionado').html(option_tutor_text);
});


$("#btn_guardar_evaluacion").on('click',function(){

    let id_carrera=$('.carreras_select option:selected').val();
    let id_tutor=$('#init_selecte_tutores option:selected').val();
    let fecha=$('#fechaEvaluacion').val();

    let objectEvaluacion={
        'respuestasEvaluacion':{
            'pregunta_1':$('#pregunta_1').is(':checked')?true:false,
            'pregunta_2':$('#pregunta_2').is(':checked')?true:false,
            'pregunta_3':$('#pregunta_3').is(':checked')?true:false,
            'pregunta_4':$('#pregunta_4').is(':checked')?true:false,
            'pregunta_5':$('#pregunta_5').is(':checked')?true:false
            },
        'idtutor':id_tutor,
        'idcarrera':id_carrera,
        'fechaEvaluacion':fecha
    }

    // console.log(objectEvaluacion);

    EnviarData(objectEvaluacion,$(this))

});

function EnviarData(objectData,this_element){
    let this_element_text=$(this_element).html();

    $.ajax({
            url :"/seguimientoActividad/tutorial/enviarData",
            type:'POST',
            headers:{"X-CSRF-Token": csrf_token},
            data :objectData,
            beforeSend:function(){
                // $('#init_selecte_tutores').attr('disabled','disabled')
                $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
            }
            })
            .done(function(respuesta) {
                $(this_element).html(this_element_text).removeAttr('disabled')
                $('.contenedor_exception').html('');

                var json=JSON.parse(respuesta);
                console.log(json);

                if(json.status=="400"){
                    $('.contenedor_exception').html(`<div class='alert alert-danger alert-dismissible fade show'><ul style="margin:0px;padding:5px;">${json.info}</ul></div>`);
                }
                if(json.status=="200"){
                    $('.contenedor_exception').html(`<div class='alert alert-success alert-dismissible fade show'>${json.info}</div>`);
                }
                $("html, body").animate({ scrollTop: 0 }, 600);

            }).fail(function(jqXHR,textStatus) {
                    $(this_element).html(this_element_text).removeAttr('disabled')
                    console.error(jqXHR.responseJSON);
        });
}


function obtenerListutoresAsignadoCarrera(id_carrera,id_tutor){

        console.log("la carrera "+id_carrera);

        $.ajax(
            {
            url :`/carrera/tutoresAsignados/${id_carrera}`,
            type:'POST',
            headers:{"X-CSRF-Token": csrf_token},
            data :{},
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
                 $('.contenedor_exception').html(`<div class='alert alert-danger alert-dismissible fade show'>${json.info} ${btn_close_Alert}</div>`);
                 $("html, body").animate({ scrollTop: 0 }, 600);
                }
                if(json.status=="200"){
                    let tutoresOptions="";
                    // console.log(json.data.length);

                    if(json.data.length>0){
                        tutoresOptions="<option value='0' disabled selected>Seleccione un tutor</option>";
                        for (const iterator of json.data) {
                            tutoresOptions+=`<option value='${iterator.id}' ${iterator.id==id_tutor?'selected':''}>${iterator.nombre} ${iterator.ap_paterno!=""?iterator.ap_paterno:""} ${iterator.ap_materno!=""?iterator.ap_materno:""}</option>`;
                        }
                        $('#init_selecte_tutores').html(tutoresOptions).removeAttr('disabled');
                    }else{
                        tutoresOptions="<option value='0' disabled selected style='color:red;'>NO SE ENCONTRARÓN REGISTROS</option>"
                        $('#init_selecte_tutores').html(tutoresOptions).attr('disabled','disabled');
                    }
                }

                }).fail(function(jqXHR,textStatus) {
                    console.error(jqXHR.responseJSON);
                    $('#init_selecte_tutores').removeAttr('disabled')
                    $('#conte_init_selecte_tutores').html('');
            });
}

</script>
@endsection



