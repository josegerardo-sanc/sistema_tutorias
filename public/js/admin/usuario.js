
console.log("mi token es"+csrf_token);

var OBJ_DATA_USUARIO_NEW={};

let TIPO_USER=0;
$('#tipo_usuario').on('change',function(){

   var tipo_user= $(this).val();
   $('.ocultar_conte_usuario_').hide();

   if(tipo_user=="3"){
    // formulario academico alumno
     $('#conte_alumno_academico').show();
   }else{
       // formulario academico docente
    $('#conte_docente_academico').show();
   }

   TIPO_USER=tipo_user;
});



$('.reset_formulario').on('click',function(){

    $('#formData_DatosPersonales')[0].reset();
    $('#formData_Datos_alumno')[0].reset();
    $('#formData_Datos_docente')[0].reset();

});

$('#Admin_btnRegisterUser').on('click',function(e){
    e.preventDefault();


    //var file=$('.file_usuario_image_search')[0].files[0];

    $('#tipo_usuario').removeClass('is-invalid is-valid');
    $('#content_error_tipo_usuario').removeClass('invalid-feedback valid-feedback').css({'color':'#F9F5F6'});


    let formData_DatosPersonales=new FormData($('#formData_DatosPersonales')[0]);


    if(TIPO_USER==0){
        $('#tipo_usuario').addClass('is-invalid');
        $('#content_error_tipo_usuario').addClass('invalid-feedback').html('<strong>selecione el tipo de usuario</strong>').css({'color':'#F71538'});

        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    }


    let object_data={
        '_token':csrf_token,
    };

    for (let entry of formData_DatosPersonales.entries()){
        object_data[entry[0]] =entry[1];
    }


    if(TIPO_USER==3){
        let formData_Datos_alumno=new FormData($('#formData_Datos_alumno')[0]);

        for (let entry of formData_Datos_alumno.entries()){
            object_data[entry[0]] =entry[1].trim();
        }
    }
    if(TIPO_USER!=3 && TIPO_USER!=6){
        let formData_Datos_docente=new FormData($('#formData_Datos_docente')[0]);
        for (let entry of formData_Datos_docente.entries()){
            object_data[entry[0]] =entry[1].trim();
        }
    }

    console.log(object_data);

    let this_element=$(this);
    $('.list_error').html('');

    $.ajax(
        {
          url :'/AdminRegisterUser',
          type: "POST",
          headers:{"X-CSRF-Token": csrf_token},
          data :JSON.stringify(object_data),
          beforeSend:function(){
             $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');          }

        })
        .done(function(data) {

            console.log(data);

            $(this_element).html('Registar Usuario').removeAttr('disabled');

            console.log("json.parse")
            var data=JSON.parse(data);
            console.log(data);

            $("html, body").animate({ scrollTop: 0 }, 600);

            var btn_close_Alert=` <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>`;

            if(data.withErrrors){
                var errors="";
                var status=false;
                for (const item in data.withErrrors){
                    console.log(`${item}: ${data.withErrrors[item]}`);
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
                $('.list_error').html("<div class='alert alert-warning alert-dismissible fade show'>se produjo un problema de comunicación con los servidor <li>Favor de recargar la pagina (F5)</li></div>");
                return false;
            }
            if(data.status=="200"){
                $('.list_error').html(`<div class='alert alert-success alert-dismissible fade show'>Registro Exitoso ${btn_close_Alert}</div>`);
            }

        }).fail(function(jqXHR,textStatus) {

            /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
             incluyendo la propiedad jqXHR.status que contiene,
             entre otros posibles, el código de estado HTTP de la respuesta. */
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText);

            $(this_element).html('Registar Usuario').removeAttr('disabled');

         })
});


    /*
    $('#producto_fisico').on('click',function(){
        if($("#producto_fisico").is(':checked')) {
             $('#conte_producto_fisico').fadeIn();
        } else {
            $('#conte_producto_fisico').fadeOut();
        }
    });
    */

    var img_perfil=$('.image_perfil').attr("src");

    $('.file_usuario_image_search').on('change', function() {
        $('.Mensaje_Subida_Image').html('');

        var picture=this;
        console.log(picture.files[0]);

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

        //1 kilobyte multiplica el valor de tamaño de datos por 1000

        // peso permitido 3 MEGABYTE
        if(siezekiloByte>3072){
            $('.Mensaje_Subida_Image').html('warning','Error','El tamaño supera el limite permitido');
            $('.image_perfil').attr("src",img_perfil);
            $('.file_usuario_image_search').val("");
        }

        if (ext.indexOf(name) == -1) {
            var archivo_permitidos = ext.toString().toUpperCase();
            $('.Mensaje_Subida_Image').html('danger','Error','Archivos permitidos '+archivo_permitidos);
            $('.image_perfil').attr("src",img_perfil);
            $('.file_usuario_image_search').val("");
            return false;
        }

        var img=URL.createObjectURL(picture.files[0]);
            //console.log(file_input.parentElement);
        $('.image_perfil').attr('src',img);
    });

    // $('.file_usuario_image_search_clean').on('click',function(){
    //     $('.image_perfil').attr("src",img_perfil);
    //     $('.file_usuario_image_search').val('');
    // });
