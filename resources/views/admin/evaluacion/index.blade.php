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
                            <label class="form-label label_filter d-flex justify-content-between align-items-center">Tipo de
                                evaluación</label>
                            <select name="tipo_evaluacion" id="tipo_evaluacion" class="form-control">
                                <option value="grupal" selected>Grupal</option>
                                <option value="individual">Individual</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for=""
                                class="form-label label_filter d-flex justify-content-between align-items-center"><strong>Periodo</strong></label>
                            <input type="date" name="fechaEvaluacion" id="fechaEvaluacion" class="form-control" />
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="form-label label_filter d-flex justify-content-between align-items-center">Carrera
                                <strong class="carreras_select_textError"></strong></label>
                            <select name="carreras" id="carreras" class="form-control carreras_select">
                                <option value="0" disabled selected>Seleccione Carrera</option>
                            </select>
                        </div>

                        <div class="col-sm-3 form-group">
                            <label class="form-label label_filter">Semestre</label>
                            <select name="filtro_semestre_escolar" id="filtro_semestre_escolar" class="form-control">
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
                        <div class="col-sm-3 form-group">
                            <label class="form-label label_filter">Turno</label>
                            <select class="form-control" name="filtro_turno_escolar" id="filtro_turno_escolar">
                                <option value="0" disabled selected>Seleccione Turno</option>
                                <option value="MATUTINO">Matutino</option>
                                <option value="VESPERTINO">Vespertino</option>
                            </select>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="form-label label_filter">Grupo</label>
                            <select class="form-control" name="filtro_grupo_escolar" id="filtro_grupo_escolar">
                                <option value="0" disabled selected>Seleccione Grupo</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                            </select>
                        </div>
                        <div class="col-sm-2 form-group">
                            <label for="" class="form-label label_filter d-flex justify-content-between align-items-center"
                                style="opacity:0">Reset</label>
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
                        <button type="button" id="btn_ver_graficas" class="btn btn-primary">
                            Ver graficas
                        </button>
                        <button type="button" id="btn_ver_evaluaciones" class="btn btn-info">
                            Número de evaluaciones
                            <span class="badge badge-light" id="data_filtro_titulo_info_resultados">0</span>
                        </button>
                    </div>
                </div>
            </div>
            <section id="conte_1">
                <div class="row" id="conte_graficas_respuestas_mas_frecuentes">

                </div>

                <h4>Evaluación del estudiante al tutor</h4>
                <div class="row" id="conte_graficas">

                </div>
            </section>
            <section id="conte_2" style="display:none">
                <div class="row" id="list_evaluaciones">

                </div>
            </section>
        </div>
        <!-- [ content ] End -->


        {{-- modal --}}
        <div class="modal" tabindex="-1" role="dialog" id="modal_dataEvaluacionBody">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Evaluacion</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                        <table class="table table-responsive table-striped">
                            <thead class="thead">
                                <tr>
                                  <th scope="col">
                                      Pregunta
                                     <div class="row">
                                         <div class="col-sm-2">Siempre</div>
                                         <div class="col-sm-2">Casi siempre</div>
                                         <div class="col-sm-2">A veces</div>
                                         <div class="col-sm-2">Nunca</div>
                                     </div>
                                  </th>
                                </tr>
                              </thead>
                              <tbody id="dataEvaluacionBody">
                              </tbody>
                        </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>


        {{-- modal --}}

    </div>
@endsection


@section('script')

    <script src="{{ asset('js/helpers/GetCarreras.js') }}"></script>


    {{-- chartjs --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

    <script>

        $('#btn_ver_graficas').on('click', function() {

            $('#conte_2').css({'display':'none'});
            $('#conte_1').css({'display':''});

        });
        $('#btn_ver_evaluaciones').on('click', function() {

            $('#conte_1').css({'display':'none'});
            $('#conte_2').css({'display':''});

        });


        var arreglo_datos_grafica = [];


        $('#btn_reset_carrera_default').on('click', function() {
            $('#carreras').val(0)
            $('#fechaEvaluacion').val('');
        });

        $('#btn_evaluacion').on('click', function(e) {
            e.preventDefault();
            let startDate = $('#fechaEvaluacion').val();
            let IdCarrera = $('#carreras option:selected').val();
            let tipo_evaluacion = $('#tipo_evaluacion option:selected').val();

            let semestre = $('#filtro_semestre_escolar option:selected').val();
            let turno = $('#filtro_turno_escolar option:selected').val();
            let grupo = $('#filtro_grupo_escolar option:selected').val();


            let objectData = {
                'fecha': startDate,
                'id_carrera': IdCarrera,
                'tipo_evaluacion': tipo_evaluacion,
                'semestre': semestre,
                'turno': turno,
                'grupo': grupo,
                'busquedaPersonalizada': true
            };

            console.log(objectData)
            graficas(objectData);

        });



        function graficas(objectData) {

            $.ajax({
                    url: '/evaluacion',
                    type: "GET",
                    headers: {
                        "X-CSRF-Token": csrf_token
                    },
                    data: objectData,
                    beforeSend: function() {
                        // $(this_element).html("Procesando...").attr('disabled','disabled');
                        $('.conte_loader_MyStyle').css({
                            display: 'flex'
                        });
                    }
                })
                .done(function(respuesta) {
                    // console.log(respuesta);
                    $('.conte_loader_MyStyle').css({
                        display: 'none'
                    });


                    var json = JSON.parse(respuesta);
                    console.log(json);


                    $('#conte_graficas').html('');
                    $('#conte_graficas_respuestas_mas_frecuentes').html('');

                    if (json.status == 200) {
                        let graficas = "";
                        let contador = 1;
                        let datosRespuestasFrecuentes = [];
                        arreglo_datos_grafica = [];
                        // evaluacion grupal
                        if (json.mostrarDatosBuqueda) {

                            let html_titulo_bsuqueda = "";
                            if (json.carrera != "") {
                                html_titulo_bsuqueda += ` Carrera: <strong>${json.carrera}</strong>`;
                            }
                            if (json.periodo != "") {
                                html_titulo_bsuqueda += ` Periodo: <strong>${json.periodo}</strong>`;
                            }
                            if (html_titulo_bsuqueda != "") {
                                $('#mostrar_titulo_conte').css({
                                    'display': ''
                                })
                                $('#data_filtro_titulo').html(`${html_titulo_bsuqueda}`);
                            } else {
                                $('#mostrar_titulo_conte').css({
                                    'display': 'none'
                                })
                            }
                        }

                        if (json.preguntas.length > 0) {

                            for (const item of json.preguntas) {
                                graficas += `<div class="col-sm-6">
                                    <div class="card mb-4">
                                            <p class="text-muted p-3 text-center">${item.pregunta}</p>
                                            <div class="card-body">
                                                <canvas id="grafica_${contador}" height="250"></canvas>
                                            </div>
                                        </div>
                                    </div>`;
                                contador = contador + 1;
                                arreglo_datos_grafica.push([item.pregunta_porc_siempre, item.pregunta_porc_casi_siempre,
                                    item.pregunta_porc_a_veces, item.pregunta_porc_nunca
                                ]);
                            }

                            $('#conte_graficas').html(graficas);
                            // console.log(arreglo_datos_grafica);
                            GraficarPreguntas(arreglo_datos_grafica);


                        } else {
                            graficas = `<div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h4 class="display-4">Sin datos para graficar.</h4>
                                        </div>
                                    </div>
                                </div>`;
                            $('#conte_graficas').html(graficas);

                            $('#list_evaluaciones').html("");
                            $('#data_filtro_titulo_info_resultados').html(`0`);
                        }

                        if (json.respuestasFrecuentes.length > 0) {
                            // respuestas más frecuentes
                            let respFrec = json.respuestasFrecuentes[0];
                            let tipo_evaluacion = $('#tipo_evaluacion option:selected').val();

                            if(tipo_evaluacion=="individual"){
                                listEvaluaciones(json.cuestionario,json.preguntas);
                            }

                            $('#data_filtro_titulo_info_resultados').html(`${json.respuestasCuestionario} `);

                            let respuestas_frecuentes = `<div class="col-sm-6" >
                                        <h4>Respuestas más frecuentes</h4>
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <canvas id="grafica_respuestas_frecuentes" style="height:250px !important;"></canvas>
                                            </div>
                                        </div>
                                    </div>`;
                            $('#conte_graficas_respuestas_mas_frecuentes').html(respuestas_frecuentes);
                            GraficarRespuestasFrecuentes([respFrec.porcentaje_siempre, respFrec.porcentaje_casi_siempre,
                                respFrec.porcentaje_a_veces, respFrec.porcentaje_nunca
                            ]);
                        }

                    } else if (json.status == 400) {
                        alert(json.info);
                    }

                })
                .fail(function(jqXHR, textStatus) {
                    $('.conte_loader_MyStyle').css({
                        display: 'none'
                    });
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


        function GraficarPreguntas() {
            var elements_graficas = document.getElementById("conte_graficas").childElementCount;
            for (let index = 1; index <= elements_graficas; index++) {

                var ctx = document.getElementById("grafica_" + index).getContext("2d");

                var myChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: ['siempre', 'casi siempre', 'a veces', 'nunca'],
                        datasets: [{
                            label: '',
                            data: arreglo_datos_grafica[index - 1], //[10,9,15],
                            backgroundColor: [
                                'rgba(74, 204, 56, 1)',
                                'rgba(204, 199, 56, 1)',
                                'rgba(204, 96, 56, 1)',
                                'rgba(204, 56, 56, 1)',
                                'rgba(100, 5,554,2)',
                            ]
                        }]
                    },
                    options: {
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

        function GraficarRespuestasFrecuentes(data) {
            var ctx = document.getElementById("grafica_respuestas_frecuentes").getContext("2d");
            var myChart = new Chart(ctx, {
                type: "pie",
                data: {
                    labels: ['siempre', 'casi siempre', 'a veces', 'nunca'],
                    datasets: [{
                        label: '',
                        data: data, //[10,9,15],
                        backgroundColor: [
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

        let datosPreguntas=[];
        let cuestionarios=[];

        function listEvaluaciones(data,preguntas) {
            let list = "";

            datosPreguntas=preguntas;
            cuestionarios=data;

            $('#list_evaluaciones').html("");

            for (const item of data) {
                list += `
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                           <a href="#">
                                Matricula: ${item.matricula} </br>
                               ${item.nombre} ${item.ap_paterno} ${item.ap_materno}
                           </a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <button type="button" class="ver_respuestas_btn btn btn-info"
                                data-id_cuestionario="${item.id_cuestionario}"
                                >
                                ver Respuestas <i class="far fa-eye-slash"></i>
                            </button>
                            <button type="button" class="descargar_pdf_btn btn btn-danger"
                            data-id_cuestionario="${item.id_cuestionario}"
                                >
                                Descargar PDF <i class="far fa-file-pdf"></i>
                            </button>
                        </li>
                        <li class="list-group-item">
                            <span class="badge badge-success">Siempre : ${item.c_siempre}</span>
                            <span class="badge badge-info">Casi siempre : ${item.c_casi_siempre}</span>
                            <span class="badge badge-warning">A veces : ${item.c_a_veces}</span>
                            <span class="badge badge-danger">Nunca : ${item.c_nunca}</span>
                        </li>
                    </ul>
                </div>
                `;
            }

            $('#list_evaluaciones').html(list);

        }



       $(document).on('click','.ver_respuestas_btn',function(){
            let id_cuestionario=$(this).data('id_cuestionario');

            console.log(id_cuestionario);
            $('#modal_dataEvaluacionBody').modal('show');

            console.log(cuestionarios[0].id_cuestionario);

            let datos=cuestionarios.find((item)=>item.id_cuestionario==id_cuestionario);

             console.log(datos);

             let filas="";

            for (const pregunta of datosPreguntas) {

                let respuestas=JSON.parse(datos.respuestas_cuestionario);

                for (const r of respuestas) {
                    if(r.id_pregunta==pregunta.id_pregunta){
                        filas+=`
                        <tr>
                            <td>
                                <strong>${pregunta.pregunta}</strong>
                                </br>
                                <div class="row">
                                    <div class="col-sm-2">
                                ${r.respuesta=="siempre"?'<i class="fas fa-check" style="color:green;" ></i>':'<i class="fas fa-times" style="color:red"></i>'}

                                    </div>
                                    <div class="col-sm-2">
                                ${r.respuesta=="casi_siempre"?'<i class="fas fa-check" style="color:green;" ></i>':'<i class="fas fa-times" style="color:red"></i>'}

                                    </div>
                                    <div class="col-sm-2">
                                ${r.respuesta=="a_veces"?'<i class="fas fa-check" style="color:green;" ></i>':'<i class="fas fa-times" style="color:red"></i>'}

                                    </div>
                                    <div class="col-sm-2">
                                ${r.respuesta=="nunca"?'<i class="fas fa-check" style="color:green;" ></i>':'<i class="fas fa-times" style="color:red"></i>'}

                                    </div>
                                </div>

                            </th>
                      </tr>  `

                    }
                }
            }


            $('#dataEvaluacionBody').html(filas)

       });

       $(document).on('click','.descargar_pdf_btn',function(){

        let id_cuestionario=$(this).data('id_cuestionario');

        const this_text=$(this).html();
          $.ajax({
                url :'/generar_pdf/evaluacion',
                type: "POST",
                headers:{"X-CSRF-Token": csrf_token},
                data:{'id_cuestionario':id_cuestionario},
                xhrFields: {
                    responseType: 'blob'
                },
                beforeSend:function(){
                    $('.conte_loader_MyStyle').css({display:'flex'});
                    $(this).html('Generando PDF <i class="fas fa-sync fa-spin"></i> .......').attr('disabled','disabled');
                }
            }).done(function(respuesta){

                $(this).html(this_text).removeAttr('disabled');
                $('.conte_loader_MyStyle').css({display:'none'});

                var blob = new Blob([respuesta],{ type: 'application/pdf' });
                var link = document.createElement('a');
                var downloadUrl= window.URL.createObjectURL(blob);
                link.href=downloadUrl;
                link.target="_blank"
                link.click();

            }).fail(function(jqXHR,textStatus) {
                $(this).html(this_text).removeAttr('disabled');
                $('.conte_loader_MyStyle').css({display:'none'});
                console.error(jqXHR.responseJSON);
            })

       });

       //dataEvaluacionBody



    </script>
@endsection
