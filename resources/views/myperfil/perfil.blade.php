@extends('layouts.body')


@section('css')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/pages/account.css')}}">


    <style>
        .genero_femenino{
            background-color:#FF33BE;
            color:white
        }
        .genero_masculino{
            background-color:#3364FF;
            color:white
        }
    </style>
@endsection

@section('contenido_page')

<?php
// print_r($user);
// print_r($domicilio);
?>

<div class="layout-content">

    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="display-4" style="color:#DF480F">Configuración Cuenta</h4>
        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Configuración/</li>
            </ol>
        </div>
        <div class="contenedor_exception"></div>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general"><i class="far fa-eye"></i> información</a>
                            @if ($user->tipo_usuario=="alumno"||$user->tipo_usuario=="tutor")
                                <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-escolar_alumno"><i class="far fa-eye"></i>
                                    {{$user->tipo_usuario=="tutor"?'Datos tutor':'Datos alumno'}}
                                </a>
                            @endif
                            @if ($user->tipo_usuario=="director" || $user->tipo_usuario=="subdirector"||$user->tipo_usuario=="tutor")
                              <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-escolar_docente"><i class="far fa-eye"></i> Datos académicos</a>
                            @endif
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password"><i class="fas fa-key"></i> Cambiar contraseña</a>

                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-socialprofile">
                            <i class="fas fa-icons"></i>
                            Cuentas-Redes sociales
                        </a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="account-general">

                            <div class="card-body media align-items-center">
                            <img src="{{asset('storage').'/'.$user->photo}}" alt="{{$user->photo}}" class="d-block ui-w-80">
                                {{-- <div class="media-body ml-4">
                                    <label class="btn btn-outline-primary">
                                         Subir Imagen
                                        <input type="file" class="account-settings-fileinput">
                                    </label> &nbsp;
                                    <button type="button" class="btn btn-default md-btn-flat">Restablecer</button>
                                    <div class="text-light small mt-1">Permitidos JPG or PNG. Max Peso 2MB</div>
                                </div> --}}
                            </div>
                            <hr class="border-light m-0">

                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label"><strong>Nombre Completo</strong></label>
                                    <input type="text" class="form-control mb-1" value="{{ucwords($user->nombre." ".$user->ap_paterno." ".$user->ap_materno)}}" placeholder="Ingresa tu nombre" disabled>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><strong>CURP</strong></label>
                                    <input type="text" class="form-control mb-1" value="{{$user->curp}}" placeholder="Ingresa tu CURPP" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><strong>Correo</strong></label>
                                    <input type="text" class="form-control mb-1" value="{{$user->email}}" placeholder="Ingresa tu correo" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><strong>Telefono</strong></label>
                                    <input type="text" class="form-control mb-1" value="{{$user->telefono}}" placeholder="Ingresa tu correo" disabled>
                                </div>
                                <div class="form-group" style="display: flex; flex-wrap:wrap;">
                                    <label class="form-label" style="padding: 5px;"><strong>Fecha nacimiento</strong> <span class="badge" style="background-color:#CACACB"> {{$user->fecha_nacimiento}}</span></label>
                                    <?php
                                    $fechas_explode=explode("-",$user->fecha_nacimiento);
                                    $edad=date('Y')-$fechas_explode[0];
                                    ?>

                                    <label class="form-label" style="padding: 5px;"><strong>Edad</strong> <span class="badge badge-success">{{$edad}} años</span></label>
                                <label class="form-label" style="padding: 5px;"><strong>Genero</strong>
                                     <span class="badge {{$user->genero=='femenino'?'genero_femenino':'genero_masculino'}}">{{strtoupper($user->genero)}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" style="display:block;width:100%;"> <i class="fas fa-map-marked-alt"></i> <strong>Dirección</strong></label>
                                    <div class="col-sm-12">
                                        <div class="alert alert-light" role="alert">
                                            {{ucwords($domicilio->municipio.".".$domicilio->estado." ".$domicilio->tipoAsentamiento." ".$domicilio->asentamiento)}} c.p {{$domicilio->codigo}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($user->tipo_usuario=="alumno"||$user->tipo_usuario=="tutor")
                        <div class="tab-pane fade" id="account-escolar_alumno">
                            <div class="card-body pb-2">
                                <div class="form-group" style="{{$user->tipo_usuario=="tutor"?'display:none':''}}">
                                    <label class="form-label"><strong>Matricula</strong></label>
                                    <input type="text" class="form-control" value="{{isset($datos_user->matricula)?$datos_user->matricula:''}}" placeholder="Ingresa tu matricula" disabled>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                <label class="form-label"><strong>Carrera</strong></label>
                                <select  class="form-control" disabled>
                                    <option value="" selected>{{ucwords($datos_user->carrera)}}</option>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><strong>Semestre</strong></label>
                                    <select  class="form-control" disabled>
                                        <option value="" selected>{{$datos_user->semestre}} °Semestre</option>
                                    </select>

                                </div>
                                <div class="formgro-up">
                                    <label class="form-label"><strong>Turno</strong></label>
                                    <select class="form-control" disabled>
                                        <option value="" selected>{{$datos_user->turno}}</option>
                                    </select>
                                </div>
                                <div class="formgro-up">
                                    <label class="form-label"><strong>Grupo</strong></label>
                                    <select class="form-control" disabled>
                                        <option value="" selected>{{$datos_user->grupo}}</option>
                                    </select>
                                </div>
                                <div class="form-group" style="{{$user->tipo_usuario=="tutor"?'display:none':''}}">
                                    <label class="form-label"><strong>Periodo</strong></label>
                                    <select class="form-control" disabled>
                                        <option value="" selected>{{isset($datos_user->periodo)?$datos_user->periodo:''}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($user->tipo_usuario=="tutor"||$user->tipo_usuario=="subdirector"||$user->tipo_usuario=="director")
                            <div class="tab-pane fade" id="account-escolar_docente">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Cédula Profesional</label>
                                        <input type="text" class="form-control" value="{{$datos_user->cedula_profesional}}" placeholder="Ingrese su cédula profesional" disabled>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Estudios Académicos</label>
                                        <textarea name="" id="" cols="30" rows="10" class="form-control">{{$datos_user->estudios_docente}}</textarea>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($user->tipo_usuario=="tutor")


                        @endif
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Contraseña actual</label>
                                    <input type="password" class="form-control" id="password_actual">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group conte_password">
                                    <label class="form-label">Nueva contraseña</label>
                                    <input type="password" class="form-control" id="password_nueva"
                                    title="Debe tener al menos una mayúscula, una minúscula y un dígito">
                                    <div class="password_text"></div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group conte_password">
                                    <label class="form-label">Confirmar nueva contraseña</label>
                                    <input type="password" class="form-control" id="password_confirm"
                                    title="Debe tener al menos una mayúscula, una minúscula y un dígito">
                                    <div class="password_text"></div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group d-flex justify-content-end">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="password_show" value="option1">
                                        <label class="form-check-label" for="password_show" style="color:#22AEF9">Mostrar contraseña</label>
                                     </div>
                                </div>
                                <div class="text-right mt-3">
                                    <button type="button" class="btn btn-primary btn_change_password">Actualizar contraseña</button>
                                </div>
                            </div>
                        </div>
                        {{-- fin password --}}
                        <div class="tab-pane fade" id="account-change-socialprofile">
                            <div class="card-body pb-2">
                                <div class="alert alert-warning" role="alert">
                                    El ingresar tus cuentas de correo de facebook y gmail </br>
                                    <strong>
                                        te permitiran ingresar ala plataforma mediante la authenticación de redes sociales
                                    </strong>
                                    </br>
                                    </br>
                                    <small><i class='fas fa-exclamation-circle'></i>
                                        Si no cuentas con ninguna de estas ingresa el correo con el que te diste de alta.
                                    </small>
                                  </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <img src="{{asset('storage/Recursos_sistema/facebook.png')}}" alt="gmail">
                                         Correo Facebook
                                    </label>
                                    <input type="email" class="form-control" id="facebook_socialite" value="{{$user->facebook}}">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <img src="{{asset('storage/Recursos_sistema/gmail.svg')}}" alt="gmail">
                                        Correo Gmail
                                    </label>
                                    <input type="email" class="form-control" id="gmail_socialite" value="{{$user->gmail}}">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="text-right mt-3">
                                    <button type="button" class="btn btn-primary btn_change_cuentasRedesSociales">Actualizar</button>
                                </div>
                            </div>
                        </div>
                        {{-- fin conter socialProfile --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ content ] End -->
</div>
@endsection


@section('script')

<script src="{{asset('dashboard_assets/js/pages/pages_account-settings.js')}}"></script>

<script>

// show password
function mostrarContrasena(){

      var tipo = document.getElementById("password");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }

$('#password_show').on('change',function(){
    if($(this).is(':checked')){
        $('#password_actual').attr('type','text');
        $('#password_nueva').attr('type','text');
        $('#password_confirm').attr('type','text');
    }else{
        $('#password_actual').attr('type','password');
        $('#password_nueva').attr('type','password');
        $('#password_confirm').attr('type','password');
    }
})
// CONTRASEÑA NUEVA
$('#password_nueva').on('keyup',function(e){

    let this_element=$(this);
    Password_SEGURO(this_element);
});
// CONTRASEÑA DE CONFIRMACION
$('#password_confirm').on('keyup',function(e){
    let this_element=$(this);
    Password_SEGURO(this_element)
});


function Password_SEGURO(this_element){
    regex = /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/;

    //Se muestra un texto válido/inválido a modo de ejemplo
    $(this_element).removeClass('is-invalid is-valid');
    $(this_element).parents('.conte_password').find('.password_text').removeClass('invalid-feedback valid-feedback').html('');

    let password=$(this_element).val();

    if (regex.test(password)) {
        $(this_element).addClass('is-valid');
        $(this_element).parents('.conte_password').find('.password_text').addClass('valid-feedback').html('<strong>Contraseña Segura</strong>');
    } else {
        $(this_element).addClass('is-invalid');
        $(this_element).parents('.conte_password').find('.password_text').addClass('invalid-feedback').html('<strong>Contraseña Poca segura</strong>');
    }
}
// FIN

$('.btn_change_password').on('click',function(e){
    e.preventDefault();
    $('.contenedor_exception').html('');

    let this_element=$(this);
    let password_actual=$('#password_actual').val();
    let password_nueva=$('#password_nueva').val();
    let password_confirm=$('#password_confirm').val();

    let error_msg="";
        if(password_actual==""||password_nueva==""||password_confirm==""){
            error_msg="<i class='fas fa-exclamation-circle'></i> Los campos son obligatorios";
        }



        if(error_msg!=""){
            alert=`
                    <div class="alert alert-danger" role="alert">
                        ${error_msg}
                    </div>`;
            $('.contenedor_exception').html(alert);
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        }

        let object_change_password={
            'password_actual':password_actual,
            'password_nueva':password_nueva,
            'password_confirm':password_confirm
        };

    $.ajax({
        url :'/change_password_user',
        type: "POST",
        headers:{"X-CSRF-Token": csrf_token},
        data :object_change_password,
        beforeSend:function(){
            $(this_element).html('<i class="fas fa-sync fa-spin"></i> Actualizando......').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-warning');
        }

        }).done(function(respuesta){
            console.log(JSON.parse(respuesta));
            $(this_element).html('Actualizar').removeAttr('disabled').removeClass('btn-warning').addClass('btn-primary');
            let data=JSON.parse(respuesta);
            //console.log(data);

            let alert="";
            if(data.status=="400"){
                alert=`
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    ${data.info}
                </div>`;
            }
            if(data.status=="200"){
                alert=`
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-thumbs-up"></i>
                    ${data.info}
                </div>`;
            }

            $('.contenedor_exception').html(alert);
            $("html, body").animate({ scrollTop: 0 }, 600);

        }).fail(function(jqXHR,textStatus) {
            ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
            $(this_element).html('Actualizar').removeAttr('disabled').removeClass('btn-warning').addClass('btn-primary');

        })


});

$('.btn_change_cuentasRedesSociales').on('click',function(e){
    e.preventDefault();
    $('.contenedor_exception').html('');

    let this_element=$(this);
    let facebook_socialite=$('#facebook_socialite').val();
    let gmail_socialite=$('#gmail_socialite').val();


    let error_msg="";
        if(facebook_socialite==""||gmail_socialite==""){
            error_msg="<li><i class='fas fa-exclamation-circle'></i> TODOS LOS CAMPOS SON REQUERIDOS.</li>";
        }

        if(error_msg!=""){
            alert=`
                    <div class="alert alert-danger" role="alert">
                        ${error_msg}
                    </div>`;
            $('.contenedor_exception').html(alert);
            // $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        }

        let object_change_cuentas={
            'facebook_socialite':facebook_socialite,
            'gmail_socialite':gmail_socialite
        };

        console.log(object_change_cuentas)

    $.ajax({
        url :'/change_cuentas_social',
        type: "POST",
        headers:{"X-CSRF-Token": csrf_token},
        data :object_change_cuentas,
        beforeSend:function(){
            $(this_element).html('<i class="fas fa-sync fa-spin"></i> Actualizando......').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-warning');
        }

        }).done(function(respuesta){
            console.log(JSON.parse(respuesta));
            $(this_element).html('Actualizar').removeAttr('disabled').removeClass('btn-warning').addClass('btn-primary');
            let data=JSON.parse(respuesta);
            //console.log(data);

            let alert="";
            if(data.status=="400"){
                alert=`
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    ${data.info}
                </div>`;
            }
            if(data.status=="200"){
                alert=`
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-thumbs-up"></i>
                    ${data.info}
                </div>`;
            }

            $('.contenedor_exception').html(alert);
            $("html, body").animate({ scrollTop: 0 }, 600);

        }).fail(function(jqXHR,textStatus) {
            ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
            $(this_element).html('Actualizar').removeAttr('disabled').removeClass('btn-warning').addClass('btn-primary');
        })

});


</script>


@endsection
