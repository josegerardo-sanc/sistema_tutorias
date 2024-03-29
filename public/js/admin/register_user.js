

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
   $('#contenedor_horario_tutor').css({'display':'none'});

   if(tipo_user=="alumno"){
    // formulario academico alumno
     $('#conte_matricula').css({'display':''});
     $('#conte_periodo').css({'display':''});
     $('#conte_alumno_academico').show();

     $('.btn_tab_conte_dtsAcademicos').html('DATOS DEL ALUMNO').show();
   }

   if(tipo_user!="alumno"&&tipo_user!="administrador"){
       // formulario academico docente
      $('#conte_docente_academico').show();
      $('.btn_tab_conte_dtsAcademicos').html('DATOS DEL DOCENTE').show();
   }
   if(tipo_user=="tutor"){
        $('#conte_matricula').css({'display':'none'});
        $('#conte_periodo').css({'display':''});
        $('#contenedor_horario_tutor').css({'display':''});
        $('#conte_alumno_academico').show();
   }

   TIPO_USER=tipo_user;
});



$('.reset_formulario').on('click',function(){

    $('.list_error').html('');
    $('.image_perfil').attr("src",'/storage/Recursos_sistema/upload_image.png');
    $('.file_usuario_image_search').val('');

    // matriula
    $('.matricula_escolar_validar').removeClass('is-invalid is-valid');
    $('.contenedor_input_matricula_alumno').removeClass('invalid-feedback valid-feedback').html('');

    // curp
    $('.input_curp_validar').removeClass('is-invalid is-valid');
    $('.content_error_curp').removeClass('invalid-feedback valid-feedback').html('');


    // correo
    $('.valid_email_express_regular').removeClass('is-invalid is-valid');
    $('.content_error_validate_email').removeClass('invalid-feedback valid-feedback').html('');

    // telefono
    $('.validate_telefono_lada').removeClass('is-invalid is-valid');
    $('.content_error_validar_lada').removeClass('invalid-feedback valid-feedback').html('');

    $('#formData_DatosPersonales')[0].reset();
    $('#formData_Datos_alumno')[0].reset();
    $('#formData_Datos_docente')[0].reset();

});


$('#Admin_btnRegisterUser').on('click',function(e){
    e.preventDefault();

    console.log(horario_asignadas_tutor);

    var foto_perfil=$('.file_usuario_image_search')[0].files[0];

    if(foto_perfil!=undefined){
        console.log(foto_perfil);
    }

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
    if(TIPO_USER!="alumno" && TIPO_USER!="administrador" && TIPO_USER!="tutor"){
        let formData_Datos_docente=new FormData($('#formData_Datos_docente')[0]);
        for (let entry of formData_Datos_docente.entries()){
            formData_DatosPersonales.append(entry[0],entry[1]);
        }

    }
    if(TIPO_USER=="tutor"){

        let formData_Datos_docente=new FormData($('#formData_Datos_docente')[0]);
        for (let entry of formData_Datos_docente.entries()){
            formData_DatosPersonales.append(entry[0],entry[1]);
        }
        let formData_Datos_alumno=new FormData($('#formData_Datos_alumno')[0]);
        for (let entry of formData_Datos_alumno.entries()){
            formData_DatosPersonales.append(entry[0],entry[1]);
        }
        formData_DatosPersonales.append('horario_tutor',JSON.stringify(horario_asignadas_tutor));

    }


    //ver datos que serane nviados al backen

    // for (let entry of formData_DatosPersonales.entries()){
    //     console.log("clave: "+entry[0]+"   valor: "+entry[1]);
    // }

    // return false;

    let this_element=$(this);
    let this_element_texto=$(this).text();
    $('.list_error').html('');

    var ruta_ajax="/Admin/user";

    var limpiarFormulario=true;
    if(document.getElementById('action_user_update')){

        if(document.getElementById('id_user')){
            var id_user=document.getElementById('id_user').value;
            ruta_ajax=`/Admin/user/actualizar/${id_user}`;
            limpiarFormulario=false;
            console.log(ruta_ajax);
        }
    }

    $.ajax(
        {
          url :ruta_ajax,
          //url :'/Admin/user/Register',
          type:'POST',
          headers:{"X-CSRF-Token": csrf_token},
          data :formData_DatosPersonales,
          processData: false,
          contentType: false,
          beforeSend:function(){
             $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
             $('.conte_loader_MyStyle').css({display:'flex'});
            }

        })
        .done(function(respuesta) {
            $('.conte_loader_MyStyle').css({display:'none'});
            //console.log(respuesta)
            $(this_element).html(this_element_texto).removeAttr('disabled');
            var data=JSON.parse(respuesta);
            console.log(data);
            // return false;
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
                if(limpiarFormulario){
                    $('.reset_formulario').click();
                }


                $('.list_error').html(`<div class='alert alert-success alert-dismissible fade show'>${data.info} ${btn_close_Alert}</div>`);

                // if($('.file_usuario_image_search').val()!=""){
                //     var img=URL.createObjectURL(foto_perfil);
                //     $('.imagen_perfil_navar').attr('src',img);
                // }
            }

        }).fail(function(jqXHR,textStatus) {
            $('.conte_loader_MyStyle').css({display:'none'});
            $(this_element).html(this_element_texto).removeAttr('disabled');
            console.error(jqXHR.responseJSON);
            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
             incluyendo la propiedad jqXHR.status que contiene,
             entre otros posibles, el código de estado HTTP de la respuesta. */
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);

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



