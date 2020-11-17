let tipo_user_asignacion="";
    $('#asignacion_users').on('change',function(){


    });


    // editar asignacion

    $(document).on('click','.btn_editar_asignacion',function(){
        let id_asignacion=$(this).data('id_asignacion');
        let user_id_asignacion=$(this).data('user_id_asignacion');
        let semestre=$(this).data('semestre');
        let carrera=$(this).data('carrera');
        let turno=$(this).data('turno');

       $('#tutor_asignacion').val(user_id_asignacion);
       $('#semestre_asignacion').val(semestre);
       $('#carrera_asignacion').val(carrera);
       $('#turno_asignacion').val(turno);

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
        $('#tutor_asignacion').removeAttr('disabled');
        $('#titulo_module_asignacion').html("Nueva Asignación");

    });


    // registrar
    $('#btn_register_asignacion_tutor').on('click',function(){

        let tutor=$('#tutor_asignacion option:selected').val();
        let semestre=$('#semestre_asignacion').val();
        let carrera=$('#carrera_asignacion').val();
        let turno=$('#turno_asignacion').val();


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
            'id_user_asignacion':tutor,
            'id_user_register':'1430379',
            'action_update_save':action_UPDATE_SAVE //campos para actualizar
        };


        console.log(obejct_data_asignacion);

        RegistarAsignacion(obejct_data_asignacion,this_element);

    })

    $('#table_tutores').DataTable();

    function RegistarAsignacion(obejct_data_asignacion,this_element){
        $.ajax({
            url:'/Admin/Asignacion',
            type:'POST',
            headers:{"X-CSRF-Token": csrf_token},
            data:obejct_data_asignacion,
            beforeSend:function(){
                $(this_element).html('<i class="fas fa-sync fa-spin"></i> Espere.......').attr('disabled','disabled');
            }
        }).done(function(data){
            if(obejct_data_asignacion.action_update_save=="STORE_SAVE"){
            $(this_element).html('<i class="fas fa-bookmark"></i> Nueva asignación').removeAttr('disabled');
            }else{
                $(this_element).html('<i class="fas fa-pen-square"></i> Actualizar Asignacón').removeAttr('disabled');
            }
            //console.log(data);

            let json=JSON.parse(data);
            //console.log(json);

            if(json.status==200){
                $('#body_tutores').html('');
                let tr="";

                for (const item of json.data) {
                    tr+=`
                       <tr>
                            <td>${item.fecha_created}</td>
                            <td><a href="#">${item.nombre} ${item.ap_paterno}</a></td>
                            <td>Ing.${item.carrera}</td>
                            <td>${item.semestre}º Semestre</td>
                            <td>${item.turno=="1"?"Vespertino Grupo(B)":"Matutino Grupo(A)"}</td>
                            <td>
                                <div>
                                    <button  class="btn btn-info ver_lista_de_alumnos" type="button"
                                    data-semestre="${item.semestre}"
                                    data-carrera="${item.carrera}"
                                    data-turno="${item.turno}"
                                    data-count_alumnos="${item.COUNT_ALUMNOS}"
                                    ${item.COUNT_ALUMNOS<=0?'disabled':''}
                                     title="Lista de alumnos">
                                        <a href="#" style="color:white;">Ver alumnos</a> <span class="badge badge-light">${item.COUNT_ALUMNOS}</span>
                                    </button>
                                    <button class="btn btn-danger btn_eliminar_asignacion" type="button"
                                    data-id_asignacion="${item.id_asignacion}"
                                    title="Eliminar registro">Eliminar</button>
                                    <button
                                    data-id_asignacion="${item.id_asignacion}"
                                    data-semestre="${item.semestre}"
                                    data-carrera="${item.carrera}"
                                    data-turno="${item.turno}"
                                    data-user_id_asignacion="${item.user_id_asignado}"
                                    class="btn btn-warning btn_editar_asignacion" title="Editar registro">Editar</button>
                                </div>
                            </td>
                        </tr>
                    `;
                }

                $('#table_tutores').DataTable().clear().destroy();
                $('#body_tutores').html(tr);
                $('#table_tutores').DataTable({
                    "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
                });

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
            $(this_element).html('<i class="fas fa-bookmark"></i> Nueva asignación').removeAttr('disabled');
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
            incluyendo la propiedad jqXHR.status que contiene,
            entre otros posibles, el código de estado HTTP de la respuesta. */
            ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
            })
    }

    // delete

    $(document).on('click','.btn_eliminar_asignacion',function(){

        let id_asignacion=$(this).data('id_asignacion');

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

                $('#modal_lista_alumnos').modal('show');

                let semestre=$(this).data('semestre');
                let carrera=$(this).data('carrera');
                let turno=$(this).data('turno');
                let count_alumnos=$(this).data('count_alumnos');

                let Turno_turno=turno;

                $('#carrera_alumno_table').html('Ing.'+carrera);
                $('#carrera_semestre_table').html(semestre +'º Semestre');
                turno=turno=="1"?"Vespertino Grupo(B)":"Matutino Grupo(A)";
                $('#carrera_turno_table').html(turno);

                // console.log(`carrera ${carrera} semestre ${semestre} turno ${turno}`);


                // $('#lista_alumnos_table');
                let data_getListaAlumnos={
                    'carrera':carrera,
                    'semestre':semestre,
                    'turno':Turno_turno,
                    'count_alumnos':count_alumnos
                };

                let this_element=$(this);

                console.log(data_getListaAlumnos);

                GetListaAlumnos(data_getListaAlumnos,this_element);

    });


    function GetListaAlumnos(data_getListaAlumnos,this_element){
        $('#lista_alumnos_table').html("");

        $.ajax({
            url:'/Admin/Asignacion/getListaAlumnos',
            type:'POST',
            headers:{"X-CSRF-Token": csrf_token},
            data:data_getListaAlumnos,
            beforeSend:function(){
                $(this_element).html('<i class="fas fa-sync fa-spin"></i> Espere.......').attr('disabled','disabled');
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
            $(this_element).html('Registrar nueva asignación').removeAttr('disabled');
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
            incluyendo la propiedad jqXHR.status que contiene,
            entre otros posibles, el código de estado HTTP de la respuesta. */
            ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
        })
    }
