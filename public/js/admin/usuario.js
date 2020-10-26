
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

});

$('#Admin_btnRegisterUser').on('click',function(e){
    e.preventDefault();


    let formData_DatosPersonales=new FormData($('#formData_DatosPersonales')[0]);

    //var formData_DatosAcademicos=new FormData($('#formData_DatosAcademicos')[0]);


    console.log(csrf_token);

    let object_data={
        '_token':csrf_token,
    };

    for (let entry of formData_DatosPersonales.entries()){
        object_data[entry[0]] =entry[1].trim();
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

            var data=JSON.parse(data)
            $("html, body").animate({ scrollTop: 0 }, 600);

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
                 $('.list_error').html("<div class='alert alert-danger'><ul>"+errors+"</ul></div>");
                }

                return false;
            }

            if(data.status=="400"){
                $('.list_error').html("<div class='alert alert-warning'>se produjo un problema de comunicación con los servidor <li>Favor de recargar la pagina (F5)</li></div>");
                return false;
            }
            if(data.status=="200"){
                $('.list_error').html("<div class='alert alert-success'>Registro Exitoso</div>");
            }

        })
        .fail(function(status) {
            $(this_element).html('Registar Usuario').removeAttr('disabled');
            console.log(status.message)
         })

});



function dataRegistroCAMPOS(){




    /*
    $('#producto_fisico').on('click',function(){
        if($("#producto_fisico").is(':checked')) {
             $('#conte_producto_fisico').fadeIn();
        } else {
            $('#conte_producto_fisico').fadeOut();
        }
    });

     var img_perfil=$('.image_perfil').attr("src");
            $('.file_usuario_image_search').on('change', function() {
                        document.getElementById('Mensaje_Subida_Image').innerHTML="";
                        var picture=this;
                        var sizeByte = picture.files[0].size;
                        var siezekiloByte = parseInt(sizeByte/1024);

                    //2. tipo_archivo
                        var file_input = picture.files[0];
                        var ext = ['jpeg', 'jpg', 'png'];
                        var name = file_input.name.split('.').pop().toLocaleLowerCase();

                        if(siezekiloByte>2048){
                        document.getElementById('Mensaje_Subida_Image').innerHTML=Mensaje('warning','Error','El tamaño supera el limite permitido');
                        $('.image_perfil').attr("src",img_perfil);
                        $('.file_usuario_image_search').val("");
                        return false;
                        }

                        if (ext.indexOf(name) == -1) {
                            var archivo_permitidos = ext.toString().toUpperCase();
                            //$(archivo).parents('.conte_file-upload').removeClass('over_leave_drag');
                            document.getElementById('Mensaje_Subida_Image').innerHTML=Mensaje('danger','Error','Archivos permitidos '+archivo_permitidos);
                            $('.image_perfil').attr("src",img_perfil);
                            $('.file_usuario_image_search').val("");
                            return false;
                        }
                        var img=URL.createObjectURL(picture.files[0]);
                            //console.log(file_input.parentElement);
                        $('.image_perfil').attr('src',img);
                    });

                    $('.file_usuario_image_search_clean').on('click',function(){
                        $('.image_perfil').attr("src",img_perfil);
                        $('.file_usuario_image_search').val('');
                    });

    });

    */

}
