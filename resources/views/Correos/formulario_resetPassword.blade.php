<!DOCTYPE html>

<html lang="en" class="default-style layout-fixed layout-navbar-fixed">

<head>
    <title>Inicio</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="MODULO DE TUTORIAS" />
    <meta name="keywords" content="">
    <meta name="author" content="Codedthemes" />
    <link rel="icon" type="image/x-icon" href="{{asset('dashboard_assets/img/favicon.ico')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Page -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>

    <?php
    /*
    session_start();
    session(['status_confirm_error' => 'olisss como estas']);
    session()->forget('status_confirm_error');
    */
    ?>


    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-sm-12 d-flex justify-content-center align-items-center">
                 <div class="row col-sm-6 d-flex justify-content-center align-items-center">
                    <img src="https://tutoriasitss.granbazarmexico.store/imagenes/itss.jpg" style="height:70px;object-fit: cover;" alt="logo">
                    <strong  class="text-muted" style="font-size: 20px;margin-left:10px;">Instituto Tecnológico Superior de la Región Sierra.</strong>
                 </div>
            </div>
            <div class="d-flex align-items-center flex-column col-sm-12 col-md-6 formulario_registro_user" style="height: 100vh;">
                <div class="form-group" style="width: 100%">
                    <h5 class="text-center mt-0 mb-2 font-italic" style="color:#FF7133">
                        Restablecer su contraseña
                    </h5>
                    <div class="form-group" style="width: 100%">
                        @if(session('status_confirm_error'))
                            <div class="conte_confirm_error " style="width: 100%;padding:0px;margin:5px 0px;">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('status_confirm_error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <div class="conte_mensaje" style="width: 100%;padding:0px;margin:15px 0px;"></div>
                    </div>
                    {{-- col --}}
                </div>
                <div class="form-group" style="width: 100%">
                    Ingrese la dirección de correo electrónico verificada de su cuenta de usuario y le enviaremos un enlace para restablecer la contraseña.
                </div>
                <div class="form-group conte_email_validar" style="width: 100%">
                    <label for="" class="col-form-label">Correo</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1" style="background-color:white"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="email" class="form-control valid_email_express_regular" id="input_val_correo_reset" placeholder="Ingresa tu correo"  aria-describedby="basic-addon1" maxlength="50">
                        <div class="content_error_validate_email"></div>
                    </div>
                </div>

                <button type="button" class="btn" id="btn_reset_password" style="display:block;width:100%;margin-top:30px; margin-bottom:20px; background-color:#FF7133;color:white">Restablecer Contraseña</button>
                <button type="button" class="btn btn-ligth btn-block" id="btn_regresar_iniciar_session" style="display: none">Volver para iniciar sesión</button>

            </div>
        </div>
    </div>
</body>

<script src="{{asset('dashboard_assets/js/jquery-3.2.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{asset('js/helpers/Ajax_fail.js')}}"></script>
<script src="{{asset('js/helpers/ValidarEMAIL_TELEFONO.js')}}"></script>
<script>
         let csrf_token=$('meta[name="csrf-token"]').attr('content');
         const headers_config={"Content-Type": "application/json","Accept": "application/json","X-Requested-With": "XMLHttpRequest","X-CSRF-Token":csrf_token};


         $('#btn_reset_password').on('click',function(){

            let this_element_text=$(this).html();
            let this_element=$(this);

            let correo=$('#input_val_correo_reset').val();
            if(correo==""){
                $('.conte_mensaje').html(
                        `<div class='alert alert-danger alert-dismissible fade show'>
                            <i class="fas fa-exclamation-circle"></i> Ingresa tu correo
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>`);
                    $("html, body").animate({ scrollTop: 0 }, 600);
                    return false;
            }

            $('.conte_mensaje').html('');
            $.ajax(
                {
                url :'/enviarCorreo_resetPassword',
                type:'POST',
                headers:{"X-CSRF-Token": csrf_token},
                data :{'correo':correo},
                beforeSend:function(){
                     $(this_element).html('<i class="fas fa-sync fa-spin"></i> Procesando.......').attr('disabled','disabled');

                    }

                })
                .done(function(respuesta) {
                    console.log(respuesta);
                    $(this_element).html(this_element_text).removeAttr('disabled');
                    var json=JSON.parse(respuesta);
                    console.log(json);


                    if(json.status=="400"){
                        $('.conte_mensaje').html(
                        `<div class='alert alert-danger alert-dismissible fade show'>
                            ${json.info}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>`);
                    }
                    if(json.status=="200"){

                        $('.conte_mensaje').html(
                        `<div class='alert alert-success alert-dismissible fade show'>
                             Revise su correo electrónico para encontrar un enlace para restablecer su contraseña. Si no aparece en unos minutos, revise su carpeta de spam.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>`);

                        $('#btn_regresar_iniciar_session').css({'display':''});
                    }
                    $("html, body").animate({ scrollTop: 0 }, 600);

                }).fail(function(jqXHR,textStatus) {

                    console.error(jqXHR.responseJSON);
                    ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
                    $(this_element).html(this_element_text).removeAttr('disabled');

                })

         });

</script>

</html>
