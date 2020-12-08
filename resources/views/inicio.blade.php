
@include('helpers.verificar_sesion')

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


    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/fonts/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/fonts/ionicons.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/fonts/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/fonts/open-iconic.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/fonts/pe-icon-7-stroke.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/fonts/feather.css')}}">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/bootstrap-material.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/shreerang-material.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/uikit.css')}}">


    <!-- Libs -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/flot/flot.css')}}">

    <link rel="stylesheet" href="{{asset('css/Galeria_dashboard/loader.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/pages/authentication.css')}}">

    <style>
        a.fb {
            font-family: Lucida Grande, Helvetica Neue, Helvetica, Arial, sans-serif;
            display: inline-block;
            font-size: 14px;
            padding: 13px 30px 15px 44px;
            background: #3A5A97;
            color: #fff;
            text-shadow: 0 -1px 0 rgba(0,0,20,.4);
            text-decoration: none;
            line-height: 1;
            position: relative;
            border-radius: 5px;
        }

        a>i{
            font-size: 20px;
            margin: 3px;

        }
        a.gmail {
            font-family: Lucida Grande, Helvetica Neue, Helvetica, Arial, sans-serif;
            display: inline-block;
            font-size: 14px;
            padding: 13px 30px 15px 44px;
            background: #FF334F;
            color: #fff;
            text-shadow: 0 -1px 0 rgba(0,0,20,.4);
            text-decoration: none;
            line-height: 1;
            position: relative;
            border-radius: 5px;
        }


    </style>
</head>

<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] End -->
    <!-- [ content ] Start -->
    <div class="authentication-wrapper authentication-3">
        <div class="authentication-inner">

            <!-- [ Side container ] Start -->
            <!-- Do not display the container on extra small, small and medium screens -->
            <div class="d-none d-lg-flex col-lg-7 align-items-center ui-bg-cover ui-bg-overlay-container p-5" style="background-image: url('https://tabasco.gob.mx/sites/default/files/styles/dependencias/public/2016-10/1.png?itok=c89W_t3C');">
                <div class="ui-bg-overlay bg-dark opacity-50"></div>
                <!-- [ Text ] Start -->
                <div class="w-100 text-white px-5">
                    <h2 class="display-3 font-weight-bolder mb-4">TECNOLÓGICO NACIONAL DE MÉXICO</h2>
                    <div class="text-large font-weight-light">
                        DIRECCIÓN ACADÉMICA Y COORDINACIÓN DE TUTORÍAS
                    </div>
                </div>
                <!-- [ Text ] End -->
            </div>
            <!-- [ Side container ] End -->

            <!-- [ Form container ] Start -->
            <div class="d-flex col-lg-5 align-items-center bg-white p-5">
                <!-- Inner container -->
                <!-- Have to add `.d-flex` to econtrol width via `.col-*` classes -->
                <div class="d-flex col-sm-12 col-md-12 col-lg-12 px-0 px-xl-6 mx-auto">
                    <div class="w-100">

                        <!-- [ Logo ] Start -->
                        {{-- <div class="d-flex justify-content-center align-items-center">
                            <div class="ui-w-60">
                                <div class="w-100 position-relative">
                                    <img src="assets/img/logo-dark.png" alt="Brand Logo" class="img-fluid">
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div> --}}


                            {{-- <h5 class="text-center mt-5 mb-0" style="color:#FF7133">Iniciar Sesión</h5> --}}
                        <h5 class="text-center mb-0" style="color:#FF7133">Instituto tecnológico superior de la región sierra</h5>

                        <div class="conte_mensaje" style="width: 100%;padding:0px;margin:15px 0px;"></div>
                        <!-- [ Form ] Start -->
                        <form class="my-5">
                            <div class="form-group">
                                <label class="form-label" id="titulo_tipo_clave">CURP</label>
                                <input type="text" class="form-control input_curp_validar" id="CURP" maxlength="20">
                                <div class="content_error_curp"></div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label d-flex justify-content-between align-items-end">
                                        <span>Clave de Acceso</span>
                                        <a href="pages_authentication_password-reset.html" class="d-block small">¿Se te olvidó tu contraseña?</a>
                                    </label>
                                <input type="password" class="form-control" id="CLAVE_USUARIO" maxlength="30">
                                <div class="clearfix"></div>
                            </div>
                            <button type="button" class="btn btn-primary" id="btn_IniciarSesion" style="display:block;width:100%">Iniciar Sesión</button>

                            <div class="d-flex justify-content-end mt-2">
                                <label class="custom-control custom-checkbox m-0">
                                        <input type="checkbox" class="custom-control-input" name="Permanecer_registrado" id="Permanecer_registrado">
                                        <span class="custom-control-label">Permanecer registrado</span>
                                </label>
                            </div>

                            <div class="form-group" style="margin-top:50px; display:none">
                                <a href="" class="fb connect" style="width: 100%"><i class="fab fa-facebook-square"></i> Iniciar Sesión Facebook</a>
                                <a href="" class="gmail" style="margin-top:20px;width: 100%"> <i class="fab fa-google-plus-square"></i> Iniciar Sesión Facebook</a>
                            </div>
                        </form>
                        <!-- [ Form ] End -->

                        {{-- <div class="text-center text-muted">
                            Don't have an account yet?
                            <a href="pages_authentication_register-v3.html">Sign Up</a>
                        </div> --}}

                    </div>
                </div>
            </div>
            <!-- [ Form container ] End -->

        </div>
    </div>
    <!-- [ content ] End -->



    <script src="{{asset('dashboard_assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/pace.js')}}"></script>
    <script src="{{asset('dashboard_assets/libs/popper/popper.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/sidenav.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/layout-helpers.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/material-ripple.js')}}"></script>

    <!-- Libs -->
    <script src="{{asset('dashboard_assets/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
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
                           `<div div class='alert alert-success alert-dismissible fade show'>
                                <i class="fas fa-thumbs-up"></i>  Bienvendio ${datos.nombre} ${datos.ap_paterno}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>`);

                            $(this_element).html('<i class="fas fa-sync fa-spin"></i> Redireccionando.......');

                            window.location.href = "/Admin/user";
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
