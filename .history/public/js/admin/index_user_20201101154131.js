console.log("index.js");

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



// CUENTA
let this_id_user="";
let status_cuenta="";
let user_name="";
let this_referecs_contenedor_father="";
let this_referecs_btn_cuenta="";
let object_data_data_cuenta="";

$(document).on('click','.continuar_activacion',function(){
   cuenta_usuario(this_referecs_btn_cuenta,object_data_data_cuenta,this_referecs_contenedor_father);
});


$(document).on('click','.btn_cuenta_user',function(){

 $('.contenedor_exception').html('');

 this_referecs_contenedor_father=$(this).parents('.conte_user');
 this_referecs_btn_cuenta=$(this);
 this_id_user=$(this).parents('.conte_user').data('id_user');
 status_cuenta=$(this).parents('.conte_user').data('status_cuenta');
 user_name=$(this).parents('.conte_user').data('user_name');


 object_data_data_cuenta={
     'id':this_id_user,
     'status':status_cuenta,
     'nombre':user_name
 }
 //alert(this_id_user);

 status_cuenta=status_cuenta.toLowerCase();
 if(status_cuenta=="pendiente"){
     let alert=`
         <div class="alert alert-danger" role="alert">
             <i class="fas fa-exclamation-circle"></i> <strong>${user_name.toUpperCase()}</strong>  No ha confirmado su cuenta.. ¿Usted quiere omitir la confirmacion de correo?
             <button type="button" class="mt-4 btn btn-danger continuar_activacion">Activar cuenta</button>
         </div>
     `;
     $('.contenedor_exception').html(alert);
     $("html, body").animate({ scrollTop: 0 }, 600);
     return false;
 }


 cuenta_usuario(this_referecs_btn_cuenta,object_data_data_cuenta,this_referecs_contenedor_father);
 /*
 console.log(this_id_user)
 console.log(status_cuenta)
 console.log(user_name)*/

});



function cuenta_usuario(this_element,OBJECT_DATA,this_referecs_contenedor_father){

 //console.log(this_element);
 //console.log(OBJECT_DATA);

 $.ajax({
 url :'/Admin/user/cuenta',
 type: "POST",
 headers:{"X-CSRF-Token": csrf_token},
 data :OBJECT_DATA,
 beforeSend:function(){
     $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
 }

 }).done(function(respuesta){

     $(this_element).removeAttr('disabled');
     //console.log(respuesta);
     let data=JSON.parse(respuesta);
     //console.log(data);

     let alert="";
     if(data.status=="400"){
          alert=`
         <div class="alert alert-warning" role="alert">
             <i class="fas fa-exclamation-circle"></i> <strong>${user_name.toUpperCase()}</strong>
             ${data.info}
         </div>`;
     }
     if(data.status=="200"){


         var user=data.user;
         var nomb_compl=`${user.nombre} ${user.ap_paterno} ${user.ap_materno}`;


         var mensaje="";
         var text_btn="";
         var color_btn="";
         if(user.active==2||user.active==3){
             alert=`<div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle"></i> La Cuenta <strong>${nomb_compl.toUpperCase()}</strong>
                      esta inactiva
                   </div>`;
                   text_btn="Inactivo";
                   color_btn="badge-warning";
                   cuenta_text="Inactivo";
         }else{
             alert=`
                 <div class="alert alert-success" role="alert">
                      <i class="fas fa-flag"></i>  La Cuenta <strong>${nomb_compl.toUpperCase()}</strong>
                      esta activada
                 </div>`;

                 text_btn="Activo";
                 color_btn="badge-success";
                 cuenta_text="Activo";
         }

    }

     $('.contenedor_exception').html(alert);
     $(this_referecs_contenedor_father).data('status_cuenta',cuenta_text);

     $(this_element).html(text_btn).removeClass('badge-success badge-warning badge-danger');
     $(this_element).html(text_btn).addClass(color_btn);

     $("html, body").animate({ scrollTop: 0 }, 600);

 }).fail(function(jqXHR,textStatus) {

     /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
     incluyendo la propiedad jqXHR.status que contiene,
     entre otros posibles, el código de estado HTTP de la respuesta. */
     ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
     $(this_element).html(OBJECT_DATA.status).removeAttr('disabled');
 })

}