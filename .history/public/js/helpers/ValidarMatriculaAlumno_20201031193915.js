
// console.log("validacion matricula")

$('.matricula_escolar_validar').on('keyup',function(e){
        e.preventDefault();
        var matricula=$(this).val();

        var status=Matricula_Alumno_Valida(matricula);
        //console.log(status);

           var this_referencs= $(this).parents('.conte_referencs_matricula');
           this_referencs.find('.matricula_escolar_validar').removeClass('is-invalid is-valid');
           this_referencs.find('.contenedor_input_matricula_alumno').removeClass('invalid-feedback valid-feedback').html('');

        if(matricula.length>0 && matricula!=""){

            if(status){
                this_referencs.find('.matricula_escolar_validar').addClass('is-valid');
                this_referencs.find('.contenedor_input_matricula_alumno').addClass('valid-feedback').html('<strong>Matricula Valida</strong>');
            }else{
                this_referencs.find('.matricula_escolar_validar').addClass('is-invalid');
                this_referencs.find('.contenedor_input_matricula_alumno').addClass('invalid-feedback').html('<strong>Matricula InValida</strong>');
            }
            $(this).val(matricula);
        }

        matricula=matricula.toUpperCase();
        $(this).val(matricula);

        //console.log("keyup"+status);

});

function Matricula_Alumno_Valida(matricula) {

    var expreg =/^[1-9]{2}[Ee]{1}[0-9]{5}$/;
    console.log(matricula)

    if(expreg.test(matricula))
       { return true;}
    else
       { return false;}

}

