@extends('layouts.body')




@section('css')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@endsection


@section('contenido_page')
    <div class="layout-content">
    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="display-4" style="color:#B16A26">Graficas de evaluación</h4>


        <div class="col-sm-12 contenedor_exception"></div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3 form-group">
                        <label class="form-label label_filter d-flex justify-content-between align-items-center">Tipo de evaluación</label>
                        <select  name="tipo_evaluacion" id="tipo_evaluacion" class="form-control">
                            <option value="grupal" selected>Grupal</option>
                            <option value="individual">Individual</option>
                        </select>
                    </div>
                    <div class="col-sm-3 form-group">
                            <label class="form-label label_filter d-flex justify-content-between align-items-center">Carrera <strong class="carreras_select_textError"></strong></label>
                            <select  name="carreras" id="carreras" class="form-control carreras_select">
                                <option value="0" disabled selected>Seleccione Carrera</option>
                            </select>
                    </div>
                    <div class="col-sm-3">
                        <label for=""class="form-label label_filter d-flex justify-content-between align-items-center"><strong>Periodo</strong></label>
                        <input type="date" name="fechaEvaluacion" id="fechaEvaluacion" class="form-control" />
                    </div>
                    <div class="col-sm-2 form-group">
                        <label for=""class="form-label label_filter d-flex justify-content-between align-items-center"  style="opacity:0">Reset</label>
                        <button class="btn-sm btn btn-info" id="btn_reset_carrera_default">
                            <i class="fas fa-redo"></i>
                        </button>
                    </div>
                    <div class="col-sm-12 mt-4">
                        <button class="btn btn-primary float-right" id="btn_evaluacion">Consultar</button>
                    </div>

                    <div class="col-sm-12 m-4" id="nota_informativa">
                        <small>Si usted requiere un consulta mas precisa, vaya completando los campos</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="mostrar_titulo_conte" style="display: none">
            <div class="col-sm-12 card">
                <div class="card-body">
                    <h1 class="display-4" id="data_filtro_titulo"></h1>
                </div>
            </div>
        </div>
        <div class="row" id="conte_graficas_respuestas_mas_frecuentes">

        </div>

        <h4>Evaluación del estudiante al tutor</h4>
        <div class="row" id="conte_graficas">

        </div>
    </div>
    <!-- [ content ] End -->
</div>
@endsection


@section('script')

<script src="{{asset('js/helpers/GetCarreras.js')}}"></script>


{{-- chartjs --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

<script>

    var arreglo_datos_grafica=[];


    $('#btn_reset_carrera_default').on('click',function(){
        $('#carreras').val(0)
        $('#fechaEvaluacion').val('');
    });

    $('#btn_evaluacion').on('click',function(e){
        e.preventDefault();
        let startDate=$('#fechaEvaluacion').val();
        let IdCarrera=$('#carreras option:selected').val();
        let tipo_evaluacion=$('#tipo_evaluacion option:selected').val();


        let objectData={
            'fecha':startDate,
            'id_carrera':IdCarrera,
            'tipo_evaluacion':tipo_evaluacion,
            'busquedaPersonalizada':true
        };

        console.log(objectData)
        graficas(objectData);

    });



    function graficas(objectData){

        $.ajax({
            url :'/evaluacion',
            type: "GET",
            headers:{"X-CSRF-Token": csrf_token},
            data :objectData,
            beforeSend:function(){
            		// $(this_element).html("Procesando...").attr('disabled','disabled');
                    $('.conte_loader_MyStyle').css({display:'flex'});
            	}
            })
            .done(function(respuesta) {
                // console.log(respuesta);
                $('.conte_loader_MyStyle').css({display:'none'});


                var json=JSON.parse(respuesta);
                console.log(json);


                $('#conte_graficas').html('');
                $('#conte_graficas_respuestas_mas_frecuentes').html('');

                if(json.status==200){
                    let graficas="";
                    let contador=1;
                    let datosRespuestasFrecuentes=[];
                    arreglo_datos_grafica=[];
                    // evaluacion grupal
                    if(json.mostrarDatosBuqueda){

                        let html_titulo_bsuqueda="";
                        if(json.carrera!=""){
                            html_titulo_bsuqueda+=` Carrera: <strong>${json.carrera}</strong>`;
                        }
                        if(json.periodo!=""){
                            html_titulo_bsuqueda+=` Periodo: <strong>${json.periodo}</strong>`;
                        }
                        if(html_titulo_bsuqueda!=""){
                            $('#mostrar_titulo_conte').css({'display':''})
                            $('#data_filtro_titulo').html(`${html_titulo_bsuqueda}`);
                        }else{
                            $('#mostrar_titulo_conte').css({'display':'none'})
                        }
                    }

                    if(json.preguntas.length>0){
                        for (const item of json.preguntas) {
                            graficas+=`<div class="col-sm-6">
                                <div class="card mb-4">
                                        <p class="text-muted p-3 text-center">${item.pregunta}</p>
                                        <div class="card-body">
                                            <canvas id="grafica_${contador}" height="250"></canvas>
                                        </div>
                                    </div>
                                </div>`;
                            contador=contador+1;
                            arreglo_datos_grafica.push([item.pregunta_porc_siempre,item.pregunta_porc_casi_siempre,item.pregunta_porc_a_veces,item.pregunta_porc_nunca]);
                            }

                            $('#conte_graficas').html(graficas);
                                // console.log(arreglo_datos_grafica);
                            GraficarPreguntas(arreglo_datos_grafica);


                    }else{
                        graficas=`<div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h4 class="display-4">Sin datos para graficar.</h4>
                                    </div>
                                </div>
                            </div>`;
                            $('#conte_graficas').html(graficas);
                    }

                    if(json.respuestasFrecuentes.length>0){
                        // respuestas más frecuentes
                        let respFrec=json.respuestasFrecuentes[0];
                        let respuestas_frecuentes=`<div class="col-sm-6" >
                                    <h4>Respustas más frecuentes</h4>
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <canvas id="grafica_respuestas_frecuentes" style="height:250px !important;"></canvas>
                                        </div>
                                    </div>
                                </div>`;
                        $('#conte_graficas_respuestas_mas_frecuentes').html(respuestas_frecuentes);
                        GraficarRespuestasFrecuentes([respFrec.porcentaje_siempre,respFrec.porcentaje_casi_siempre,respFrec.porcentaje_a_veces,respFrec.porcentaje_nunca]);
                    }

                }else if(json.status==400){
                    alert(json.info);
                }

            })
            .fail(function(jqXHR,textStatus) {
                $('.conte_loader_MyStyle').css({display:'none'});
                if (jqXHR.status === 0) {
                        console.log('Verifica tu conexion de internet.');
                    } else if (jqXHR.status == 404) {
                        console.log('No se encontró la página solicitada [404]');
                    } else if (jqXHR.status == 500) {
                        console.log('error de servidor interno [500].');
                    } else if (textStatus === 'parsererror') {
                        console.log('Error de análisis JSON solicitado.');
                    } else if (textStatus === 'timeout') {
                        console.log('Error de tiempo de espera.');
                    } else if (textStatus === 'abort') {
                        console.log('Solicitud de Ajax cancelada.');
                    }
        })

    }

    graficas({});


    function GraficarPreguntas(){
        var elements_graficas= document.getElementById("conte_graficas").childElementCount;
        for (let index = 1; index <=elements_graficas; index++) {

            var ctx= document.getElementById("grafica_"+index).getContext("2d");

                    var myChart= new Chart(ctx,{
                        type:"bar",
                        data:{
                            labels:['siempre','casi siempre','a veces','nunca'],
                            datasets:[{
                                    label:'',
                                    data:arreglo_datos_grafica[index-1],//[10,9,15],
                                    backgroundColor:[
                                        'rgba(74, 204, 56, 1)',
                                        'rgba(204, 199, 56, 1)',
                                        'rgba(204, 96, 56, 1)',
                                        'rgba(204, 56, 56, 1)',
                                        'rgba(100, 5,554,2)',
                                    ]
                            }]
                        },
                        options:{
                            legend: {
                            display: false // Ocultar legendas
                            },
                            scales: {
                                yAxes: [{
                                    display: true,
                                    ticks: {
                                        beginAtZero: true,
                                        max: 100,
                                        min: 0
                                    }
                                }],
                                // xAxes: [{
                                //     display: true,
                                //     ticks: {
                                //         beginAtZero: true,
                                //         max: 100,
                                //         min: 0
                                //     }
                                // }]
                            }
                        }
                    });
        }
    }

    function GraficarRespuestasFrecuentes(data){
        var ctx= document.getElementById("grafica_respuestas_frecuentes").getContext("2d");
        var myChart= new Chart(ctx,{
            type:"pie",
            data:{
                labels:['siempre','casi siempre','a veces','nunca'],
                datasets:[{
                        label:'',
                        data:data,//[10,9,15],
                        backgroundColor:[
                            'rgba(74, 204, 56, 1)',
                            'rgba(204, 199, 56, 1)',
                            'rgba(204, 96, 56, 1)',
                            'rgba(204, 56, 56, 1)'
                        ]
                }]
            }
        });
    }

    // let endDate=$('#fecha_vigencia_input').data('daterangepicker').endDate.format('YYYY-MM-DD hh:mm:ss');


</script>
@endsection



