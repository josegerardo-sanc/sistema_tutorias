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


    <style>
        .icon {
            color: white;
            text-decoration: none;
            padding: .7rem;
            display: flex;
            transition: all .5s;
        }
        .icon-facebook {
            background: #2E406E;
        }

        .icon-twitter {
            background: #339DC5;
        }

        .icon-youtube {
            background: #E83028;
        }

        .icon:hover {
            box-shadow: 0 0 .5rem rgba(0, 0, 0, 0.42);
        }

        .contenedor_imagen_itss {
                display:block;
        }
        .formulario_registro_user{
             border:1px solid transparent;
         }

        @media (max-width: 769px) {
            .contenedor_imagen_itss {
                display: none;
            }
        }
    </style>

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
        <div class="row d-flex justify-content-between">
            <div class="col-sm-8 d-flex align-items-center" style="height:80px">
                <img src="https://tutoriasitss.granbazarmexico.store/imagenes/itss.jpg" style="height:70px;object-fit: cover;" alt="logo">
                <strong  class="text-muted" style="font-size: 15px;">Instituto Tecnológico Superior de la Región Sierra.</strong>
            </div>
            <div class="col-sm-4  d-flex justify-content-end align-items-center" style="height:80px">
                <a href="https://www.facebook.com/pages/Instituto-Tecnologico-Superior-de-la-Region-Sierra/190874770988922?ref=hl" class="icon icon-facebook">
                   <i class="fab fa-facebook"></i>
                </a>
                <a href="https://twitter.com/TecSierra" class="icon icon-twitter">
                   <i class="fab fa-twitter-square "></i>
                </a>
                <a href="https://www.youtube.com/user/ITSSTABASCO" class="icon icon-youtube">
                   <i class="fab fa-youtube"></i>
                </a>
           </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 contenedor_imagen_itss">
                <img src="https://web.unican.es/unidades/coie/PublishingImages/Paginas/Emprendimiento/173.png"
                    alt="itss"
                    style="width:600px;height80%;">
            </div>
            <div class="d-flex align-items-center flex-column col-sm-12 col-md-6 formulario_registro_user" style="height: 100vh;">
                <div style="margin-bottom:5px;"></div>
                <div class="form-group" style="width: 100%">
                    <h3 class="text-center mt-4 mb-2 font-italic" style="color:#FF7133">
                        Iniciar sesión
                    </h3>
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
                    <label class="col-form-label mb-1" id="titulo_tipo_clave">Curp</label>
                    <div class="clearfix"></div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1" style="background-color:white"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control input_curp_validar" id="CURP" placeholder="Ingresa tu curp" aria-label="CURP" aria-describedby="basic-addon1" maxlength="20">
                    </div>
                    <div class="content_error_curp"></div>
                </div>
                <div class="form-group" style="width: 100%">
                        <label class="col-form-label d-flex justify-content-between align-items-end mb-1">
                            <span>Clave de acceso</span>
                            <a href="{{url('/recuperar/password')}}" class="d-block small">¿Se te olvidó tu contraseña?</a>
                        </label>
                    <div class="input-group mb-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1" style="background-color:white"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" id="CLAVE_USUARIO" placeholder="Ingresa tu clave" aria-label="CLAVE" aria-describedby="basic-addon1" maxlength="30">
                    </div>
                </div>
                <div class="d-flex justify-content-end" style="width:100%;">
                    <label class="custom-control custom-checkbox m-0">
                            <input type="checkbox" class="custom-control-input" name="Permanecer_registrado" id="Permanecer_registrado">
                            <span class="custom-control-label">Permanecer registrado</span>
                    </label>
                </div>
                <button type="button" class="btn" id="btn_IniciarSesion" style="display:block;width:100%;margin-top:30px; margin-bottom:20px; background-color:#FF7133;color:white">Iniciar Sesión</button>

                <div class="form-group" style="margin-top:50px; display:none">
                    <a href="" class="fb connect" style="width: 100%"><i class="fab fa-facebook-square"></i> Iniciar Sesión Facebook</a>
                    <a href="" class="gmail" style="margin-top:20px;width: 100%"> <i class="fab fa-google-plus-square"></i> Iniciar Sesión Facebook</a>
                </div>

            </div>
        </div>
    </div>



    <script src="{{asset('dashboard_assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="{{asset('js/helpers/Ajax_fail.js')}}"></script>
    <script src="{{asset('js/helpers/helpersCurpAPI.js')}}"></script>
    <script>
        let csrf_token=$('meta[name="csrf-token"]').attr('content');
        const headers_config={"Content-Type": "application/json","Accept": "application/json","X-Requested-With": "XMLHttpRequest","X-CSRF-Token":csrf_token};


        $('#USUARIO_NUMERO').on('keyup',function(e){
                e.preventDefault();
                var usuarioNumero=$(this).val();

                usuarioNumero=usuarioNumero.toUpperCase();
                $(this).val(usuarioNumero);
        });

        $('#CURP').on('keypress',function(e){
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                callSesion_login();
            }
        });
        $('#CLAVE_USUARIO').on('keypress',function(e){
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                callSesion_login();
            }
        });

        function callSesion_login(){
            $('.conte_confirm_error').html('');

            let USUARIO_CURP=$('#CURP').val();
            let CLAVE_USUARIO=$('#CLAVE_USUARIO').val();

            if(USUARIO_CURP==""){
                $('#CURP').focus();
            }
            if(CLAVE_USUARIO==""){
                $('#CLAVE_USUARIO').focus();
            }

            if(USUARIO_CURP!="" && CLAVE_USUARIO!=""){
                $('#btn_IniciarSesion').click();
            }
        }


        $('#btn_IniciarSesion').on('click',function(){
            let USUARIO_CURP=$('#CURP').val();
            let CLAVE_USUARIO=$('#CLAVE_USUARIO').val();
            let Permanecer_registrado=false;
            if($('#Permanecer_registrado').is(':checked')){
                Permanecer_registrado=true;
            }

            let objectData={
                'USUARIO_CURP':USUARIO_CURP,
                'CLAVE_USUARIO':CLAVE_USUARIO,
                'Permanecer_registrado':Permanecer_registrado
            };

            let this_element=$(this);
            $('.conte_mensaje').html('');
            $.ajax(
                {
                url :'/IniciarSesion',
                type:'POST',
                headers:{"X-CSRF-Token": csrf_token},
                data :objectData,
                beforeSend:function(){
                     $(this_element).html('<i class="fas fa-sync fa-spin"></i> Procesando.......').attr('disabled','disabled');

                    }

                })
                .done(function(respuesta) {
                    console.log(respuesta);

                    $(this_element).html('Iniciar Sesión').removeAttr('disabled');
                    var data=JSON.parse(respuesta);
                    console.log(data);


                    if(data.status=="400"){
                        $('.conte_mensaje').html(
                        `<div class='alert alert-danger alert-dismissible fade show'>
                            ${data.info}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>`);
                    }
                    if(data.status=="200"){
                        if(data.data.length>0){
                            console.log(data.data)

                            let datos=data.data[0];

                            $('.conte_mensaje').html(
                           `<div div class='alert alert-warning alert-dismissible fade show'>
                                <i class="fas fa-thumbs-up"></i>  Bienvendio ${datos.nombre} ${datos.ap_paterno}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>`);

                            $(this_element).html('<i class="fas fa-sync fa-spin"></i> Redireccionando.......');

                            let ruta="";
                            let tipo_usuario=data.data[0].tipo_usuario;

                            if(tipo_usuario=="tutor"){
                                ruta="/tutor"
                            }else if(tipo_usuario=="asesor"){
                                 ruta="/asesor"
                            }
                            else if(tipo_usuario=="alumno"){
                                 ruta="/alumno"
                            }
                            else if(tipo_usuario=="director"){
                                    ruta="/director"
                            }
                            else if(tipo_usuario=="subdirector"){
                                    ruta="/subdirector"
                            }
                            else if(tipo_usuario=="administrador"){
                                ruta="/Admin/user"
                            }
                            if(ruta==""){
                                ruta="/";
                            }
                            window.location.href = ruta;

                            //nota debes de redireccionar dependiendo del usuario
                        }

                    }
                    $("html, body").animate({ scrollTop: 0 }, 600);

                }).fail(function(jqXHR,textStatus) {

                    console.error(jqXHR.responseJSON);
                    ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
                    $(this_element).html('Iniciar Sesión').removeAttr('disabled');

                })
        });
    </script>

</body>

</html>
