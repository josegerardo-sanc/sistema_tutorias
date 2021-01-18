var tipo_user_asignacion="";

     // registrar
var horario_asignadas_tutor={
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
