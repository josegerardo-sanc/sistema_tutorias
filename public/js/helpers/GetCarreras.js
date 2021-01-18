
function UNIQUE_getCarreras(){
    // console.log("cargando");


    $.ajax(
        {
          url :'/Admin/carreras/getCarreras',
          type:'POST',
          headers:{"X-CSRF-Token": csrf_token},
          data :{},
          async: false,
          beforeSend:function(){

             $('.carreras_select').attr('disabled','disabled')
             $('.carreras_select_textError').html('<i class="fas fa-sync fa-spin"></i> Cargando.......');
           }
        })
        .done(function(respuesta) {

            $('.carreras_select_textError').html('');
            $('.carreras_select').removeAttr('disabled');

            var json=JSON.parse(respuesta);
            // console.log(json);

            var btn_close_Alert=` <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>`;

            if(json.status=="400"){
               $('.error_alert_container').html(`<div class='alert alert-danger alert-dismissible fade show'>${json.info} ${btn_close_Alert}</div>`);
            }
            if(json.status=="200"){
                let listCarrera="";
                // console.log(json.data.length);

                if(json.data.length>0){
                    listCarrera="<option value='0' disabled selected>Seleccione Carrera</option>";
                    for (const iterator of json.data) {
                        listCarrera+=`<option value='${iterator.id_carrera}'>${iterator.carrera}</option>`;
                    }
                }else{
                    listCarrera="<option value='0' disabled selected style='color:red;'>NO SE ENCONTRARON REGISTROS</option>"
                }

                $('.carreras_select').html(listCarrera);
            }
        $("html, body").animate({ scrollTop: 0 }, 600);
        }).fail(function(jqXHR,textStatus) {

            console.error(jqXHR.responseJSON);
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
             incluyendo la propiedad jqXHR.status que contiene,
             entre otros posibles, el código de estado HTTP de la respuesta. */
             $('.carreras_select_textError').html('');
             $('.carreras_select').removeAttr('disabled');

         })
}
UNIQUE_getCarreras();
