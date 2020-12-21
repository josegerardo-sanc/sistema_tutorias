
 $('#table_tutores').DataTable({
    "order": [
        [0, 'desc'],
        [1, 'desc']
    ],
    "language":language
});

let tipo_user_asignacion="";


       // inicio de creacion ,editar,ver horario del tutor
    // inicio de creacion ,editar,ver horario del tutor
    // inicio de creacion ,editar,ver horario del tutor
    // inicio de creacion ,editar,ver horario del tutor
    // inicio de creacion ,editar,ver horario del tutor

     // registrar
     let horario_asignadas_tutor={
        'lunes':'false',
        'martes':'false',
        'miercoles':'false',
        'jueves':'false',
        'viernes':'false',
        'lunes_hora':'0',
        'martes_hora':'0',
        'miercoles_hora':'0',
        'jueves_hora':'0',
        'viernes_hora':'0'
    }

    $('.check_lunes').on('change',function(){
        if($(this).is(':checked')){
            $('.input_check_lunes').removeAttr('disabled');
            horario_asignadas_tutor.lunes='true';
        }else{
            $('.input_check_lunes').attr('disabled','disabled').val('');
            horario_asignadas_tutor.lunes='false';
        }
        Object_Horario_Tutor()
    })
    $('.check_martes').on('change',function(){
        if($(this).is(':checked')){
            $('.input_check_martes').removeAttr('disabled');
            horario_asignadas_tutor.martes='true';
        }else{
            $('.input_check_martes').attr('disabled','disabled').val('');
            horario_asignadas_tutor.martes='false';
        }
        Object_Horario_Tutor()
    })
    $('.check_miercoles').on('change',function(){
        if($(this).is(':checked')){
            $('.input_check_miercoles').removeAttr('disabled');
            horario_asignadas_tutor.miercoles='true';
        }else{
            $('.input_check_miercoles').attr('disabled','disabled').val('');
            horario_asignadas_tutor.miercoles='false';
        }
        Object_Horario_Tutor()
    })
    $('.check_jueves').on('change',function(){
        if($(this).is(':checked')){
            $('.input_check_jueves').removeAttr('disabled');
              horario_asignadas_tutor.jueves='true';
        }else{
            $('.input_check_jueves').attr('disabled','disabled').val('');
            horario_asignadas_tutor.jueves='false';
        }
        Object_Horario_Tutor()
    })

    $('.check_viernes').on('change',function(){
        if($(this).is(':checked')){
            $('.input_check_viernes').removeAttr('disabled');
        horario_asignadas_tutor.viernes='true';
        }else{
            $('.input_check_viernes').attr('disabled','disabled').val('');
            horario_asignadas_tutor.viernes='false';
        }
        Object_Horario_Tutor()
    });

    $('.input_keyup_horario').on('keyup',function(){
        Object_Horario_Tutor();
    });


    function Object_Horario_Tutor(){

        let lunes=$('.input_check_lunes').val()!=""?$('.input_check_lunes').val():'0';
        let martes=$('.input_check_martes').val()!=""?$('.input_check_martes').val():'0';
        let miercoles=$('.input_check_miercoles').val()!=""?$('.input_check_miercoles').val():'0';
        let jueves=$('.input_check_jueves').val()!=""?$('.input_check_jueves').val():'0';
        let viernes=$('.input_check_viernes').val()!=""?$('.input_check_viernes').val():'0';
        total_horas=parseInt(lunes)+parseInt(martes)+parseInt(miercoles)+parseInt(jueves)+parseInt(viernes);

        horario_asignadas_tutor.lunes_hora=lunes;
        horario_asignadas_tutor.martes_hora=martes;
        horario_asignadas_tutor.miercoles_hora=miercoles;
        horario_asignadas_tutor.jueves_hora=jueves;
        horario_asignadas_tutor.viernes_hora=viernes;
        $('.total_hrs_asignadas_tutor').val(total_horas);
    }

    function limpiarHorarioTutor(){
        $('.input_check_lunes').val('').attr('disabled','disabled');
        $('.input_check_martes').val('').attr('disabled','disabled');
        $('.input_check_miercoles').val('').attr('disabled','disabled');
        $('.input_check_jueves').val('').attr('disabled','disabled');
        $('.input_check_viernes').val('').attr('disabled','disabled');

        $('.check_lunes').prop('checked',false);
        $('.check_martes').prop('checked',false);
        $('.check_miercoles').prop('checked',false);
        $('.check_jueves').prop('checked',false);
        $('.check_viernes').prop('checked',false);

        $('.total_hrs_asignadas_tutor').val("");
    }

    $('.btn_btn_restablecer_horario').on('click',function(e){
        e.preventDefault();

        horario_asignadas_tutor={
            'lunes':'false',
            'martes':'false',
            'miercoles':'false',
            'jueves':'false',
            'viernes':'false',
            'lunes_hora':'0',
            'martes_hora':'0',
            'miercoles_hora':'0',
            'jueves_hora':'0',
            'viernes_hora':'0'
        };
        limpiarHorarioTutor();
    })

    $('.btn_asignarHorario_tutor').on('click',function(){
        // create horario
        $('.check_lunes').removeAttr('disabled');
        $('.check_martes').removeAttr('disabled');
        $('.check_miercoles').removeAttr('disabled');
        $('.check_jueves').removeAttr('disabled');
        $('.check_viernes').removeAttr('disabled');

        $('.btn_btn_restablecer_horario').show();
        $('#modal_horario_tutor').modal('show');

    });

    $(document).on('click','.btn_ver_horario_tutor',function(){
         // editar horario
        let id=$(this).data('id');
        let id_asignacion=$(this).data('id_asignacion');
        buscarHorarioAsignado(id,id_asignacion);

        $('.btn_btn_restablecer_horario').hide();
        $('#modal_horario_tutor').modal('show');
    });

    function buscarHorarioAsignado(id,id_asignacion){
        console.log(typeof users_tutores)
        console.log(users_tutores);

        for (const iterator of users_tutores) {
            if(id==iterator.id&&id_asignacion==iterator.id_asignacion){
                Mostrar_Horario_tutor(JSON.parse(iterator.horario));
            }
        }
    }

    function Mostrar_Horario_tutor(horario){

        $('.check_lunes').attr('disabled','disabled');
        $('.check_martes').attr('disabled','disabled');
        $('.check_miercoles').attr('disabled','disabled');
        $('.check_jueves').attr('disabled','disabled');
        $('.check_viernes').attr('disabled','disabled');

        $('.input_check_lunes').val(horario.lunes_hora);
        $('.input_check_martes').val(horario.martes_hora);
        $('.input_check_miercoles').val(horario.miercoles_hora);
        $('.input_check_jueves').val(horario.jueves_hora);
        $('.input_check_viernes').val(horario.viernes_hora);

        horario.lunes=="true"?$('.check_lunes').prop('checked',true):$('.check_lunes').prop('checked',false);
        horario.martes=="true"?$('.check_martes').prop('checked',true):$('.check_martes').prop('checked',false);
        horario.miercoles=="true"?$('.check_miercoles').prop('checked',true):$('.check_miercoles').prop('checked',false);
        horario.jueves=="true"?$('.check_jueves').prop('checked',true):$('.check_jueves').prop('checked',false);
        horario.viernes=="true"?$('.check_viernes').prop('checked',true):$('.check_viernes').prop('checked',false);

        total_horas=parseInt(horario.lunes_hora)+parseInt(horario.martes_hora)+parseInt(horario.miercoles_hora)+parseInt(horario.jueves_hora)+parseInt(horario.viernes_hora);
        $('.total_hrs_asignadas_tutor').val(total_horas);


        horario_asignadas_tutor=horario;


    }


    // fin de creacion ,editar,ver horario del tutor
    // fin de creacion ,editar,ver horario del tutor
    // fin de creacion ,editar,ver horario del tutor
    // fin de creacion ,editar,ver horario del tutor
    // fin de creacion ,editar,ver horario del tutor


    $(document).on('click','.btn_editar_asignacion',function(){

        let id=$(this).data('id');
        let id_asignacion=$(this).data('id_asignacion');
        buscarHorarioAsignado(id,id_asignacion);

        let user_id_asignacion=$(this).data('user_id_asignacion');
        let semestre=$(this).data('semestre');
        let id_carrera=$(this).data('id_carrera');
        let turno=$(this).data('turno');
        let grupo=$(this).data('grupo');


        console.log(`turno ${turno=='Matutino'?'Matutino':'Vespertino'}`);
        console.log(`grupo ${grupo=='A'?'1A':'B'}`);

       $('#tutor_asignacion').val(user_id_asignacion);
       $('#semestre_asignacion').val(semestre);
       $('#carrera_asignacion').val(id_carrera);
       $('#turno_asignacion').val(`${turno=='Matutino'?'Matutino':'Vespertino'}`);
       $('#grupo_asignacion').val(`${grupo=='A'?'A':'B'}`);

       $('#conte_cancelar_actualizacion_asignacion').css({'display':''}).show();
       $('#btn_register_asignacion_tutor').html('<i class="fas fa-pen-square"></i> Actualizar Asignacón')
       .removeClass('btn-primary').addClass('btn-warning');

       $('#input_action_update').val("UPDATE_SAVE"); //DEFAULT #STORE_SAVE
       $('#id_asignacion_input').val(id_asignacion);
       $('#titulo_module_asignacion').html("Actualizar Asignación");

       $('#tutor_asignacion').attr('disabled','disabled');

    });


    $('.btn_cancelar_actualizacion').on('click',function(){

        $('#btn_register_asignacion_tutor').html('<i class="fas fa-bookmark"></i> Nueva asignación')
        .removeClass('btn-warning').addClass('btn-primary');

        $('#conte_cancelar_actualizacion_asignacion').css({'display':'none'});

        $('#input_action_update').val("STORE_SAVE"); //DEFAULT #STORE_SAVE

        $('#tutor_asignacion').removeAttr('disabled').val(0);
        $('#semestre_asignacion').val(0);
        $('#carrera_asignacion').val(0);
        $('#turno_asignacion').val(0);
        $('#grupo_asignacion').val(0);

        $('#titulo_module_asignacion').html("Nueva Asignación");
        limpiarHorarioTutor();

    });

    $(document).on('keypress', '.validar_numeric_input', function(e) {
        var key = window.Event ? e.which : e.keyCode;
        var patron = /^[0-9]$/;
        var tecla_final = String.fromCharCode(key);
        //console.log(tecla_final);
        return patron.test(tecla_final);

    });

    $('#btn_register_asignacion_tutor').on('click',function(){

        // console.log(horario_asignadas_tutor);
        // return false;

        let tutor=$('#tutor_asignacion option:selected').val();
        let semestre=$('#semestre_asignacion').val();
        let carrera=$('#carrera_asignacion').val();
        let turno=$('#turno_asignacion').val();
        let grupo_asignacion=$('#grupo_asignacion').val();


        let erros="";
        $('.error_alert_container').html('');

        if(tutor==null || tutor==0||tutor=="no_found_selected"){
            erros+="<li>NO HAS SELECCIONADO UN TUTOR VALIDO</li>";
        }
        if(semestre==0|| semestre==null){
            erros+="<li>SELECCIONE EL SEMESTRE</li>";
        }
        if(carrera==null|| carrera==0){
            erros+="<li>SELECCIONE CARRERA</li>";
        }

        if(turno==null|| turno==0){
            erros+="<li>SELECCIONE TURNO</li>";
        }
        if(grupo_asignacion==null|| grupo_asignacion==0){
            erros+="<li>SELECCIONE GRUPO</li>";
        }


        if(erros!=""){
            $('.error_alert_container').html(`
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${erros}
                    <small style="display:flex; justify-content:flex-end;color:#252627 !important; margin-top:10px !important;">COMPLETE LOS DATOS PARA CONTINUAR</small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`)
            return false;
        }


        let this_element=$(this);
        let action_UPDATE_SAVE=$('#input_action_update').val(); //DEFAULT #STORE_SAVE
        let id_asignacion=$('#id_asignacion_input').val(); //DEFAULT #STORE_SAVE
        let obejct_data_asignacion={
            'id_asignacion':id_asignacion, //campos para actualizar
            'id_tutor':tutor,
            'semestre':semestre,
            'carrera':carrera,
            'turno':turno,
            'grupo':grupo_asignacion,
            'id_user_asignacion':tutor,
            'id_user_register':'14E30379',
            'action_update_save':action_UPDATE_SAVE, //campos para actualizar
            'horario_tutor':horario_asignadas_tutor
        };

        console.log(obejct_data_asignacion);

        RegistarAsignacion(obejct_data_asignacion,this_element);

    })



    function RegistarAsignacion(obejct_data_asignacion,this_element){

        let this_element_texto=$(this_element).text();
        $.ajax({
            url:'/Admin/Asignacion',
            type:'POST',
            headers:{"X-CSRF-Token": csrf_token},
            data:obejct_data_asignacion,
            beforeSend:function(){
                $(this_element).html('<i class="fas fa-sync fa-spin"></i> Espere.......').attr('disabled','disabled');
            }
        }).done(function(data){

            // console.log(data);

            // if(obejct_data_asignacion.action_update_save=="STORE_SAVE"){
            // $(this_element).html('<i class="fas fa-bookmark"></i> Nueva asignación').removeAttr('disabled');
            // }else{
            //     $(this_element).html('<i class="fas fa-pen-square"></i> Actualizar Asignacón').removeAttr('disabled');
            // }
            $(this_element).html(this_element_texto).removeAttr('disabled');
            //console.log(data);

            let json=JSON.parse(data);
            console.log(json);


            if(json.status==200){
                $('#body_tutores').html('');
                let tr="";
                users_tutores.length=0;
                users_tutores=json.data;

                // console.log(users_tutores);
                for (const item of json.data) {


                    tr+=`
                       <tr>
                            <td>${item.fecha_created}</td>
                            <td><a href="#">${item.nombre} ${item.ap_paterno}</a></td>
                            <td>${item.carrera}</td>
                            <td>${item.semestre}º Semestre</td>
                            <td>${item.turno} Grupo ${item.grupo}</td>
                            <td>
                                <div>
                                    <button  class="btn btn-info ver_lista_de_alumnos" type="button"
                                     ${item.COUNT_ALUMNOS<=0?'disabled':''}
                                     data-count_alumnos="${item.COUNT_ALUMNOS}"
                                     data-semestre="${item.semestre}"
                                     data-id_carrera="${item.id_carrera}"
                                     data-carrera_text="${item.carrera}"
                                     data-turno="${item.turno}"
                                     data-grupo="${item.grupo}"
                                     title="Lista de alumnos">
                                        <a href="#" style="color:white;">Ver alumnos</a> <span class="badge badge-light">${item.COUNT_ALUMNOS}</span>
                                    </button>
                                    <button class="btn btn-danger btn_eliminar_asignacion" type="button"
                                    data-id_asignacion="${item.id_asignacion}"
                                    title="Eliminar registro">Eliminar</button>
                                    <button
                                    data-semestre="${item.semestre}"
                                    data-id_carrera="${item.id_carrera}"
                                    data-carrera_text="${item.carrera}"
                                    data-turno="${item.turno}"
                                    data-grupo="${item.grupo}"
                                    data-id="${item.id}"
                                    data-id_asignacion="${item.id_asignacion}"
                                    data-user_id_asignacion="${item.user_id_asignado}"
                                    data-count_alumnos="${item.COUNT_ALUMNOS}"
                                    class="btn btn-warning btn_editar_asignacion" title="Editar registro">Editar</button>
                                    <button
                                    data-id="${item.id}"
                                    data-id_asignacion="${item.id_asignacion}"
                                    class="btn btn-link btn_ver_horario_tutor" title="Ver Horario"><i class="fas fa-user-clock"></i> Ver Horario</button>
                                </div>
                            </td>
                        </tr>
                    `;
                }

                $('.btn_cancelar_actualizacion').click();

                $('.error_alert_container').html(`
                        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                            ${json.info}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);

                $('#table_tutores').DataTable().clear().destroy();
                $('#body_tutores').html(tr);
                $('#table_tutores').DataTable({
                    "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
                    "language":language
                });

                let options="<option value='0' selected disabled>Seleccione un tutor</option>";
                console.log("lista de tutores")
                console.log(json.ListTutores)

                for (const item of json.ListTutores) {
                    options+=`
                    <option
                      ${item.id_asignacion!=null?'disabled':''}
                      style="${item.id_asignacion!=null?'color:red':''}"
                      value="${item.id}">
                      ${item.nombre.toUpperCase()} ${item.ap_paterno.toUpperCase()}
                    </option>
                    `;
                }
                $('#tutor_asignacion').html(options);
            }
            if(json.status==400){
                if(json.countAsignacion){
                    $('.error_alert_container').html(`
                            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                <i class="fas fa-exclamation-triangle"></i>
                             Verifique sus datos, Está asignacion ya esta en uso......
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
                }else{
                    $('.error_alert_container').html(`
                            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                             ${json.info}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
                }

                $("html, body").animate({ scrollTop: 0 }, 600);
            }

        }).fail(function(jqXHR,textStatus) {
            $(this_element).html(this_element_texto).removeAttr('disabled');
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
            incluyendo la propiedad jqXHR.status que contiene,
            entre otros posibles, el código de estado HTTP de la respuesta. */
            ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
            })
    }

    // delete

    $(document).on('click','.btn_eliminar_asignacion',function(){

        let id_asignacion=$(this).data('id_asignacion');
        // console.log(id_asignacion);

        let Object_data={
          'id_asignacion':id_asignacion
        };
        let this_element=$(this);

        deleteAsignacion(Object_data,this_element)
    });

    function deleteAsignacion(Object_data,this_element){
        $.ajax({
            url:`/Admin/Asignacion/${Object_data.id_asignacion}`,
            type:'DELETE',
            headers:{"X-CSRF-Token": csrf_token},
            data:Object_data,
            beforeSend:function(){
                $(this_element).html('<i class="fas fa-sync fa-spin"></i> Procesando.......').attr('disabled','disabled');
            }
        }).done(function(data){

            //console.log(data);

            let json=JSON.parse(data);

                let table = $('#table_tutores').DataTable();
                let row;

                // console.log($(this).closest('table'));
         if(json.status==200){
                $('.btn_cancelar_actualizacion').click();
                if($(this_element).closest('table').hasClass("collapsed")) {
                    let child = $(this_element).parents("tr.child");
                    row = $(child).prevAll(".parent");
                } else {
                    row = $(this_element).parents('tr');
                }
                table.row(row).remove().draw();

            let options="<option value='0' selected disabled>Seleccione un tutor</option>";
            for (const item of json.ListTutores) {
                options+=`
                <option
                    ${item.id_asignacion!=null?'disabled':''}
                    style="${item.id_asignacion!=null?'color:red':''}"
                    value="${item.id}">
                    ${item.nombre.toUpperCase()} ${item.ap_paterno.toUpperCase()}
                </option>
                `;
            }
            $('#tutor_asignacion').html(options);
            $('#tutor_asignacion').removeAttr('disabled');
         }

        }).fail(function(jqXHR,textStatus) {
            $(this_element).html('Registrar nueva asignación').removeAttr('disabled');
            $('#tutor_asignacion').removeAttr('disabled');
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
            incluyendo la propiedad jqXHR.status que contiene,
            entre otros posibles, el código de estado HTTP de la respuesta. */
            ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
        })

    }
    // listarAlumnos
    $(document).on('click','.ver_lista_de_alumnos',function(){


                let semestre=$(this).data('semestre');
                let id_carrera=$(this).data('id_carrera');
                let carrera_text=$(this).data('carrera_text');
                let turno=$(this).data('turno');
                let grupo=$(this).data('grupo');
                let count_alumnos=$(this).data('count_alumnos');

                let Turno_turno=turno;

                $('#carrera_alumno_table').html(carrera_text);
                $('#carrera_semestre_table').html(semestre +'º Semestre');
                $('#carrera_turno_table').html(`${turno} Grupo ${grupo}`);

                let data_getListaAlumnos={
                    'id_carrera':id_carrera,
                    'semestre':semestre,
                    'turno':Turno_turno,
                    'count_alumnos':count_alumnos,
                    'grupo':grupo
                };

                let this_element=$(this);

                console.log(data_getListaAlumnos);

                GetListaAlumnos(data_getListaAlumnos,this_element);

                $('#modal_lista_alumnos').modal('show');

    });


    function GetListaAlumnos(data_getListaAlumnos,this_element){
        $('#lista_alumnos_table').html("");
        let this_element_text=$(this).text();

        $.ajax({
            url:'/Admin/Asignacion/getListaAlumnos',
            type:'POST',
            headers:{"X-CSRF-Token": csrf_token},
            data:data_getListaAlumnos,
            beforeSend:function(){
                $(this_element).html('<i class="fas fa-sync fa-spin"></i> Espere.......').attr('disabled','disabled');
                $('#lista_alumnos_table').html('<tr><td colspan="5" style="text-align: center"><i class="fas fa-sync fa-spin"></i> Espere.......</td></tr>');
            }
        }).done(function(data){
            $(this_element).html(`
            <a href="#" style="color:white;">Ver alumnos</a>
            <span class="badge badge-light">${data_getListaAlumnos.count_alumnos}</span>
            `).removeAttr('disabled');

            // console.log(data);

            let json=JSON.parse(data);
            //console.log(json);

            if(json.status==200){

                let tr="";
            if(json.data.length>0){
                for (const item of json.data) {
                    tr+=`
                        <tr style="width:100%">
                            <td>${item.created_at}</td>
                            <td><a href="#" class="btn-link">${item.nombre} ${item.ap_paterno} ${item.ap_materno}</a></td>
                            <td>${item.matricula}</td>
                            <td>${item.curp}</td>
                            <td>${item.email}</td>
                        </tr>
                    `;
                }
             }else{
                tr="<tr><td colspan='4' style='text-align:center'>NO SE ENCONTRARON REGISTROS</td></tr>";
             }

            $('#lista_alumnos_table').html(tr);

            }

        }).fail(function(jqXHR,textStatus) {
            $(this_element).html(this_element_text).removeAttr('disabled');
            $('#lista_alumnos_table').html('<tr><td colspan="5"><i class="fas fa-sync fa-spin"></i> Espere.......</td></tr>');
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
            incluyendo la propiedad jqXHR.status que contiene,
            entre otros posibles, el código de estado HTTP de la respuesta. */
            ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
        })
    }
