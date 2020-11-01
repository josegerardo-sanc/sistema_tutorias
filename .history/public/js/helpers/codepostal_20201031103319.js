

$(document).on('change','.localidad_complete',function(e) {


    console.log("change localidad_complete")
    let id=$(this).val();
    var data_tipoAsentamiento=$(this).find(':selected').data('asentamiento');
    //console.log(data_tipoAsentamiento);
    $(this).parents('.ContenedorcodigoPostal_father').find('.tipoAsentamiento').html(data_tipoAsentamiento)

})


$('.inputBuscarCodigoPostal').on('keyup',function(){


    let codigoPostal=$(this).val();
    let this_element=$(this);
    let this_references=$(this).parents('.ContenedorcodigoPostal_father');

    let OBJ={
        '_token':csrf_token,
        'codigoPostal':codigoPostal
    };

    if(codigoPostal.length==5){
        this_references.find('.conte_spiner_codePostal_error').css({'display':'none'});
        this_references.find('.tipoAsentamiento').html('info');

        $.ajax(
            {
              url :'/helpers/codePostal',
              type: "POST",
              headers:{'Content-Type': 'application/json',"X-CSRF-Token": csrf_token},
              data :JSON.stringify(OBJ),
              beforeSend:function(){
                 $(this_element).attr('disabled','disabled');

                 this_references.find('.conte_spiner_codePostal').css({'display':'flex'});
                 this_references.find('.estado_complete').html("<option value='0'>Buscando.....</option>");
                 this_references.find('.municipio_complete').html("<option value='0'>Buscando.....</option>");
                 this_references.find('.localidad_complete').html("<option value='0'>Buscando.....</option>");

                }
            })
            .done(function(respuesta) {

                //console.log(respuesta)

                $(this_element).removeAttr('disabled');
                $('.conte_spiner_codePostal').css({'display':'none'});


                let estado_option="";
                let municipio_option="";
                let asentamiento_options="";

                if((!respuesta.data.length>0)||respuesta.data==[]){
                    this_references.find('.conte_spiner_codePostal_error').css({'display':'flex'});

                    estado_option="<option value='0'>Sin Resultados</option>";
                    municipio_option="<option value='0'>Sin Resultados</option>";
                    asentamiento_options="<option value='0'>Sin Resultados</option>";

                }else{

                    asentamiento_options="<option value='0' selected disabled>Seleccione Localidad 'Asentamiento'</option>";
                    for (const iterator of respuesta.data) {
                        estado_option+=`<option>${iterator.estado}</option>`
                        municipio_option+=`<option>${iterator.municipio}</option>`
                        asentamiento_options+=`<option data-asentamiento="${iterator.tipoAsentamiento}" value="${iterator.id}">${iterator.asentamiento} - ${iterator.tipoAsentamiento}</option>`
                    }
                }
                this_references.find('.estado_complete').html(estado_option);
                this_references.find('.municipio_complete').html(municipio_option);
                this_references.find('.localidad_complete').html(asentamiento_options);
            })
            .fail(function(jqXHR,textStatus) {
                ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);

                (this_element).removeAttr('disabled');
                this_references.find('.conte_spiner_codePostal').css({'display':'none'});

                this_references.find('.estado_complete').html("<option value='0'>Estado</option>");
                this_references.find('.municipio_complete').html("<option value='0'>Municipio</option>");
                this_references.find('.localidad_complete').html("<option value='0'>Localidad 'Asentamiento'</option>");

        })

    }else{
        //console.log("codigo postal incompleto")
    }
});
