//console.log("index.js");

let TIPO_USER_SEARCH="";
let REALIZAR_BUSQUEDA_FILTRO=true;

  $('#tipo_usuario_search').on('change',function(){
        TIPO_USER_SEARCH=$(this).val();
        $('.conte_filtro_clave').css({'display':'none'});

        var text_filtro_clave="";

        $('.contenedor_filtro_alumno').hide();
        $('.contenedor_filtro_docente').hide();

        if(TIPO_USER_SEARCH=="alumno"){
            $('.contenedor_filtro_alumno').show();
            REALIZAR_BUSQUEDA_FILTRO=true;

        }else if(TIPO_USER_SEARCH!="alumno"&&TIPO_USER_SEARCH!="administrador"){
            $('.contenedor_filtro_docente').show();
            REALIZAR_BUSQUEDA_FILTRO=true;
        }

  });

$('.BTN_LIMPIAR_FILTRO').on('click',function(){

    REALIZAR_BUSQUEDA_FILTRO=false;
    $('#tipo_usuario_search').val(0);

    $('#filtro_semestre_escolar').val(0);
    $('#filtro_carrera_escolar').val(0);
    $('#filtro_turno_escolar').val(0);
    
    $('#filtro_matricula_escolar').val('').removeClass('is-invalid is-valid');
    $('.contenedor_input_matricula_alumno_index').removeClass('invalid-feedback valid-feedback').html('');
    
    $('#filtro_cedulaProfesional').val('');

});

$('.BTN_OCULTAR_FILTRO').on('click',function(){

    $('.contenedor_filtro_alumno').hide();
    $('.contenedor_filtro_docente').hide();
    REALIZAR_BUSQUEDA_FILTRO=false;
});

