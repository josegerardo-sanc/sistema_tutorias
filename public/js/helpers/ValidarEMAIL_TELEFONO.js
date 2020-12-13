

function validarEmail(email) {

   emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

    if (emailRegex.test(email)) {
        return true;
    } else {
        return false;
    }
}


$('.valid_email_express_regular').on('keyup',function(){

    let email=$(this).val();
    let status=validarEmail(email);

    let this_referencs=$(this).parents('.conte_email_validar');

    this_referencs.find('.valid_email_express_regular').removeClass('is-invalid is-valid');
    this_referencs.find('.content_error_validate_email').removeClass('invalid-feedback valid-feedback');

    //console.log(status)

    if(status){
            this_referencs.find('.valid_email_express_regular').addClass('is-valid');
            this_referencs.find('.content_error_validate_email').addClass('valid-feedback').html('<strong>Correo válido</strong>');
        }else{
            this_referencs.find('.valid_email_express_regular').addClass('is-invalid');
            this_referencs.find('.content_error_validate_email').addClass('invalid-feedback').html('<strong>Correo inválido</strong>');
    }
});





$(document).on('keypress', '.validar_numeric_input', function(e) {
    var key = window.Event ? e.which : e.keyCode;
    var patron = /^[0-9]$/;
    var tecla_final = String.fromCharCode(key);
    //console.log(tecla_final);
    return patron.test(tecla_final);

});

$('.validate_telefono_lada').on('keyup',function(){
    var lada=$(this).val();

    if(lada.length>0){
        var this_referencs=$(this).parents('.contenedor_principal_validar');

        var status=validatePhone(lada)
        this_referencs.find('.validate_telefono_lada').removeClass('is-invalid is-valid');
        this_referencs.find('.content_error_validar_lada').removeClass('invalid-feedback valid-feedback').css({'color':'#F9F5F6'});
        if(status){
            this_referencs.find('.validate_telefono_lada').addClass('is-valid');
            this_referencs.find('.content_error_validar_lada').addClass('valid-feedback').html('<strong>Lada válida</strong>').css({'color':'#3B9448'});
        }else{
            this_referencs.find('.validate_telefono_lada').addClass('is-invalid');
            this_referencs.find('.content_error_validar_lada').addClass('invalid-feedback').html('<strong>Lada inválida</strong>').css({'color':'#DA1B47'});
        }
    }
});
