


$('.btn_validar_curp_api').on('click',function(e){
    e.preventDefault();

    var this_element=$(this);
    var curp=$('#curp').val();

    AJAXgetDataCurp(this_element,curp);

});

function  AJAXgetDataCurp(this_element,curp){

    $.ajax(
        {
          //url :'http://localhost:3000/validarCurpApi',
          url :'https://api.granbazarmexico.store/validarCurpApi',
          type: "POST",
          headers: {
            'Access-Control-Allow-Origin': '*',
              'Content-Type': 'application/json'
            },
          data :JSON.stringify({'curp':curp}),
          beforeSend:function(){
             $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
          }

        })
        .done(function(data) {
           console.log(data);
           $(this_element).html('Validar Curp').removeAttr('disabled');

            if(data.DataUser.code=="200"){

                var info=data.DataUser.renapo;

                $('#nombre').val(info.nombre);
                $('#ap_paterno').val(info.paterno);
                $('#ap_materno').val(info.materno);


                $('input[name="genero"]').attr('checked',false);

                if(info.sexo=="HOMBRE"){
                    $('#masculino').prop("checked", true);
                }
                if(info.sexo=="MUJER"){
                    $('#femenino').prop("checked", true);
                }
                var fecha=info.fecha_nacimiento.split("/");
                fecha_format=`${fecha[2]}-${fecha[1]}-${fecha[0]}`;

                $('#fecha_nacimiento').val(fecha_format);

            }
            if(data.DataUser.code=="400"||data.DataUser.code=="204"){
                $('.input_curp_validar').addClass('is-invalid');
                $('.content_error_curp').addClass('invalid-feedback').html(`<strong>${data.DataUser.mensaje}</strong>`);

            }

        }).fail(function(jqXHR,textStatus) {
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
             incluyendo la propiedad jqXHR.status que contiene,
             entre otros posibles, el código de estado HTTP de la respuesta. */
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText);

             $(this_element).html('Validar Curp').removeAttr('disabled');

         })

}


$('.input_curp_validar').on('keyup',function(e){

    var keycode = (e.keyCode ? e.keyCode : e.which);
    console.log(keycode)
    if (keycode == '13') {

        let btn=$(this).parents('.contenedor_referencia_btn_this').find('button.btn_validar_curp_api').click();
    }else{

        var curp=$(this).val();
        curp=curp.toUpperCase();
        var status=curpValida(curp);

        $('.input_curp_validar').removeClass('is-invalid is-valid');
        $('.content_error_curp').removeClass('invalid-feedback valid-feedback').html('');
        if(status){
            $('.input_curp_validar').addClass('is-valid');
            $('.content_error_curp').addClass('valid-feedback').html('<strong>Curp Valida</strong>');
        }else{
            $('.input_curp_validar').addClass('is-invalid');
            $('.content_error_curp').addClass('invalid-feedback').html('<strong>Curp InValida</strong>');
        }
        //console.log("keyup"+status);
        $(this).val(curp);
    }

});



function curpValida(curp) {
    var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        validado = curp.match(re);

    if (!validado)  //Coincide con el formato general?
        return false;

    if (validado[2] != digitoVerificador(validado[1]))
    	return false;

        return true; //Validado
}

//Validar que coincida el dígito verificador
function digitoVerificador(curp17) {

    var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
        lngSuma      = 0.0,
        lngDigito    = 0.0;
    for(var i=0; i<17; i++)
        lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
        lngDigito = 10 - lngSuma % 10;
    if (lngDigito == 10) return 0;
    return lngDigito;
}

