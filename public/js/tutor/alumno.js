console.log("alumno.js")

var img_perfil=$('.image_perfil').attr("src");

$('.btn_alumno_send_db').on('click',function(e){
    e.preventDefault();

    //  var foto_perfil=$('.file_usuario_image_search')[0].files[0];
     let formData_Datos_alumno=new FormData();

     let formData_Datos=new FormData($('#formData_DatosPersonales')[0]);

     for (let entry of formData_Datos.entries()){
         formData_Datos_alumno.append(entry[0],entry[1]);
        //  console.log(entry[0],entry[1]);
     }


     formData_Datos_alumno.append('tipo_usuario',"alumno");
     formData_Datos_alumno.append('img_perfil',$('.file_usuario_image_search')[0].files[0]);

     formData_Datos_alumno.append('matricula',$('#matricula_escolar').val());
     formData_Datos_alumno.append('periodo_escolar',$('#periodo_escolar option:selected').val());
     formData_Datos_alumno.append('semestre_escolar',$('#semestre_escolar option:selected').val());
     formData_Datos_alumno.append('carrera_escolar',$('#carrera_escolar option:selected').val());
     formData_Datos_alumno.append('turno_escolar',$('#turno_escolar option:selected').val());
     formData_Datos_alumno.append('grupo_escolar',$('#grupo_escolar option:selected').val());

      //ver datos que serane nviados al backen

    for (let entry of formData_Datos_alumno.entries()){
        // console.log("clave: "+entry[0]+"   valor: "+entry[1]);
    }

    let this_element=$(this);
    let this_element_texto=$(this).html();

    var ruta_ajax="/tutor/registerAlumno";

    let id_user_alumno=$('#id_user_alumno_db').val();
    if(id_user_alumno!=undefined&&id_user_alumno!=0){
        ruta_ajax=`/tutor/actualizarAlumno/${id_user_alumno}`;
    }


    $.ajax(
        {
          url :ruta_ajax,
          type:'POST',
          headers:{"X-CSRF-Token": csrf_token},
          data :formData_Datos_alumno,
          processData: false,
          contentType: false,
          beforeSend:function(){
             $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
            }
        })
        .done(function(respuesta) {
            $('.conte_loader_MyStyle').css({display:'none'});
            console.log(respuesta)
            $(this_element).html(this_element_texto).removeAttr('disabled');
            var data=JSON.parse(respuesta);
            console.log(data);


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
                 $("html, body").animate({ scrollTop: 0 }, 600);
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
                if(data.register_alumno){
                    $('.reset_formulario').click();
                }

                $('.list_error').html(`<div class='alert alert-success alert-dismissible fade show'>${data.info} ${btn_close_Alert}</div>`);
                // if($('.file_usuario_image_search').val()!=""){
                //     var img=URL.createObjectURL(foto_perfil);
                //     $('.imagen_perfil_navar').attr('src',img);
                // }
            }

            $("html, body").animate({ scrollTop: 0 }, 600);
        }).fail(function(jqXHR,textStatus) {

            console.error(jqXHR.responseJSON);
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
             $(this_element).html(this_element_texto).removeAttr('disabled');

         })
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


});


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



