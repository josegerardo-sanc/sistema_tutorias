

/*
$('#producto_fisico').on('click',function(){
    if($("#producto_fisico").is(':checked')) {
            $('#conte_producto_fisico').fadeIn();
    } else {
        $('#conte_producto_fisico').fadeOut();
    }
});
*/



/*REGISTRAR USUARIO*/


var OBJ_DATA_USUARIO_NEW={};

let TIPO_USER=0;

$('#tipo_usuario').on('change',function(){

   var tipo_user= $(this).val();
   $('.ocultar_conte_usuario_').hide();
   $('.btn_tab_conte_dtsAcademicos').hide();

   if(tipo_user=="alumno"){
    // formulario academico alumno
     $('#conte_alumno_academico').show();
     $('.btn_tab_conte_dtsAcademicos').show();
   }

   if(tipo_user!="alumno"&&tipo_user!="administrador"){
       // formulario academico docente
      $('#conte_docente_academico').show();
      $('.btn_tab_conte_dtsAcademicos').show();
   }

   TIPO_USER=tipo_user;
});



$('.reset_formulario').on('click',function(){


    // matriula
    $('.matricula_escolar_validar').removeClass('is-invalid is-valid');
    $('.contenedor_input_matricula_alumno').removeClass('invalid-feedback valid-feedback');

    // curp
    $('.input_curp_validar').removeClass('is-invalid is-valid');
    $('.content_error_curp').removeClass('invalid-feedback valid-feedback');


    // correo
    $('.valid_email_express_regular').removeClass('is-invalid is-valid');
    $('.content_error_validate_email').removeClass('invalid-feedback valid-feedback');

    // telefono
    $('.validate_telefono_lada').removeClass('is-invalid is-valid');
    $('.content_error_validar_lada').removeClass('invalid-feedback valid-feedback');




    $('#formData_DatosPersonales')[0].reset();
    $('#formData_Datos_alumno')[0].reset();
    $('#formData_Datos_docente')[0].reset();

});



$('#Admin_btnRegisterUser').on('click',function(e){
    e.preventDefault();

    //var file=$('.file_usuario_image_search')[0].files[0];

    $('#tipo_usuario').removeClass('is-invalid is-valid');
    $('#content_error_tipo_usuario').removeClass('invalid-feedback valid-feedback').css({'color':'#F9F5F6'});

    TIPO_USER=$('#tipo_usuario').val();
    if(TIPO_USER==0){
        $('#tipo_usuario').addClass('is-invalid');
        $('#content_error_tipo_usuario').addClass('invalid-feedback').html('<strong>selecione el tipo de usuario</strong>').css({'color':'#F71538'});

        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    }


    let formData_DatosPersonales=new FormData($('#formData_DatosPersonales')[0]);
        formData_DatosPersonales.append('img_perfil',$('.file_usuario_image_search')[0].files[0]);


    if(TIPO_USER=="alumno"){
        let formData_Datos_alumno=new FormData($('#formData_Datos_alumno')[0]);
        for (let entry of formData_Datos_alumno.entries()){
            formData_DatosPersonales.append(entry[0],entry[1]);
        }
    }
    if(TIPO_USER!="alumno" && TIPO_USER!="administrador"){
        let formData_Datos_docente=new FormData($('#formData_Datos_docente')[0]);
        for (let entry of formData_Datos_docente.entries()){
            formData_DatosPersonales.append(entry[0],entry[1]);
        }

    }


    //ver datos que serane nviados al backen

    /*for (let entry of formData_DatosPersonales.entries()){
        console.log("clave: "+entry[0]+"   valor: "+entry[1]);
    }*/

    let this_element=$(this);
    $('.list_error').html('');

    $.ajax(
        {
          url :'/Admin/user',
          //url :'/Admin/user/Register',
          type: "POST",
          headers:{"X-CSRF-Token": csrf_token},
          data :formData_DatosPersonales,
          processData: false,
          contentType: false,
          beforeSend:function(){
             $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
             $('.conte_loader_MyStyle').css({display:'flex'});
            }

        })
        .done(function(data) {
            $('.conte_loader_MyStyle').css({display:'none'});
            console.log(data)
            $(this_element).html('Registar Usuario').removeAttr('disabled');
            var data=JSON.parse(data);
            console.log(data);
            return false;
            $("html, body").animate({ scrollTop: 0 }, 600);

            var btn_close_Alert=` <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>`;

            if(data.withErrrors){
                var errors="";
                var status=false;
                for (const item in data.withErrrors){
                    //console.log(`${item}: ${data.withErrrors[item]}`);
                    errors+=`<li>${data.withErrrors[item]}</li>`;
                    status=true;
                }
               if(status){
                /*La propiedad scrollTop:0 nos desplaza hacia el comienzo de la página web, en la posición 0px, y 600*/
                 $('.list_error').html(`<div class='alert alert-danger alert-dismissible fade show'><ul>${errors}</ul>${btn_close_Alert}</div>`);
                }

                return false;
            }

            if(data.status=="400"){
                var errors_list="";

                if(data.file_error){

                        for (const item in data.info) {

                            errors_list+=`<li><strong style="color:#FF334C">${item.toUpperCase()} : </strong> ${data.info[item]}</li>`;
                        }
                }else{
                    errors_list=`<li>${data.info}</li>`;
                }
                $('.list_error').html(`<div class='alert alert-warning alert-dismissible fade show'>${errors_list}  ${btn_close_Alert}</div>`);
            }
            if(data.status=="200"){
                $('.list_error').html(`<div class='alert alert-success alert-dismissible fade show'>${data.info} ${btn_close_Alert}</div>`);
                $('.reset_formulario').click();

            }

        }).fail(function(jqXHR,textStatus) {

            console.error(jqXHR.responseJSON);
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
             incluyendo la propiedad jqXHR.status que contiene,
             entre otros posibles, el código de estado HTTP de la respuesta. */
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
             $('.conte_loader_MyStyle').css({display:'none'});
            $(this_element).html('Registar Usuario').removeAttr('disabled');

         })
});


var img_perfil=$('.image_perfil').attr("src");

$('.image_perfil').on('click',function(){
    $('.file_usuario_image_search').click();
});

$('.file_usuario_image_search').on('change', function() {
    $('.Mensaje_Subida_Image').html('');

    var picture=this;
    //console.log(picture.files[0]);

    var sizeByte = picture.files[0].size;

    // 640 x 480 = 307200
    // 307200 x 3 = 921600 bytes 921600 / 1024 = 900 KB
    // 1kb ==1024 bytes


    // ejemplo si pesa 3mg es igual a 3kb

    var siezekiloByte = parseInt(sizeByte/1024);
    //2. tipo_archivo
    var file_input = picture.files[0];
    var ext = ['jpeg', 'jpg', 'png'];
    var name = file_input.name.split('.').pop().toLocaleLowerCase();
    var archivo_permitidos="";
    //1 kilobyte multiplica el valor de tamaño de datos por 1000

    // peso permitido 2 MEGABYTE
    var list_errors="";

    if(siezekiloByte>2048){
        var megaByte=(siezekiloByte/1024).toFixed();
        list_errors+=`<li>El archivo supera el limite (${megaByte})MB permitido 2MB</li>`;
    }

    if (ext.indexOf(name) == -1) {
        archivo_permitidos = ext.toString().toUpperCase();
        list_errors+=`<li>Archivos permitidos ${archivo_permitidos}</li>`;
    }

    if(list_errors!=""){
        $('.Mensaje_Subida_Image').html(`
                <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                ${list_errors}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `);
        $('.image_perfil').attr("src",img_perfil);
        $('.file_usuario_image_search').val("");

        return false;
    }


    var img=URL.createObjectURL(picture.files[0]);
        //console.log(file_input.parentElement);
    $('.image_perfil').attr('src',img);
});


/**ACTIVAR Y DESACTIVAR CUENTA */
/**ACTIVAR Y DESACTIVAR CUENTA */
/**ACTIVAR Y DESACTIVAR CUENTA */
/**ACTIVAR Y DESACTIVAR CUENTA */
/**ACTIVAR Y DESACTIVAR CUENTA */
    let this_id_user="";
    let status_cuenta="";
    let user_name="";
    let this_referecs_btn_cuenta="";
    let object_data_data_cuenta="";

$(document).on('click','.continuar_activacion',function(){
    cuenta_usuario(this_referecs_btn_cuenta,object_data_data_cuenta);
 });


 $(document).on('click','.btn_cuenta_user',function(){

     $('.contenedor_exception').html('');
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


     cuenta_usuario(this_referecs_btn_cuenta,object_data_data_cuenta);
     /*
     console.log(this_id_user)
     console.log(status_cuenta)
     console.log(user_name)*/

 });



 function cuenta_usuario(this_element,OBJECT_DATA){

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
             }else{
                 alert=`
                     <div class="alert alert-success" role="alert">
                          <i class="fas fa-flag"></i>  La Cuenta <strong>${nomb_compl.toUpperCase()}</strong>
                          esta activada
                     </div>`;

                     text_btn="Activo";
                     color_btn="badge-success";
             }
         }

         $('.contenedor_exception').html(alert);
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
