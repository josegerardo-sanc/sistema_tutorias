

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

    console.log(status)

    if(status){
            this_referencs.find('.valid_email_express_regular').addClass('is-valid');
            this_referencs.find('.content_error_validate_email').addClass('valid-feedback').html('<strong>Correo Valida</strong>');
        }else{
            this_referencs.find('.valid_email_express_regular').addClass('is-invalid');
            this_referencs.find('.content_error_validate_email').addClass('invalid-feedback').html('<strong>Correo InValida</strong>');
    }
});

