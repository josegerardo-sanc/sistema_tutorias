console.log("index.js");


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