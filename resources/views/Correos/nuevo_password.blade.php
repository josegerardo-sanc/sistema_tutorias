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

  {{-- {{dd($data_user[0]->curp)}} --}}

<form method="POST" action="/NuevoPassword_user/update" class="justify-content-center" id="formulario_password_datos">

                @csrf
                

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
                            Restablecer su contraseña  {{$data_user[0]->curp}}
                        </h5>
                        <div class="form-group" style="width: 100%">
                            <div class="conte_mensaje" style="width: 100%;padding:0px;margin:15px 0px;"></div>
                        </div>
                        {{-- col --}}
                    </div>
                    <input type="hidden" class="form-control" name="id_user_db" value="{{$data_user[0]->id}}">
                    <div class="form-group conte_password" style="width: 100%">
                        <label for="" class="col-form-label">Nueva Contraseña</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"  style="background-color:white"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password_nueva" id="password_nueva" placeholder="Ingresa tu contraseña"  aria-describedby="basic-addon1" maxlength="50"
                            title="Debe tener al menos una mayúscula, una minúscula y un dígito">
                            <div class="password_text"></div>
                        </div>
                    </div>
                    <div class="form-group conte_password" style="width: 100%">
                        <label for="" class="col-form-label">Confirmar Contraseña</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" style="background-color:white"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Ingresa tu contraseña"  
                            aria-describedby="basic-addon1" maxlength="50" title="Debe tener al menos una mayúscula, una minúscula y un dígito">
                            <div class="password_text"></div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="password_show">
                                <label class="form-check-label" for="password_show">Ver contraseñas</label>
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-ligth btn-block" id="btn_restablecer_password" >Enviar</button>

                </div>
        </div>
    </div>
</form>
</body>

<script src="{{asset('dashboard_assets/js/jquery-3.2.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{asset('js/helpers/Ajax_fail.js')}}"></script>

<script>
         let csrf_token=$('meta[name="csrf-token"]').attr('content');
         const headers_config={"Content-Type": "application/json","Accept": "application/json","X-Requested-With": "XMLHttpRequest","X-CSRF-Token":csrf_token};



$('#btn_restablecer_password').on('click',function(e){
    e.preventDefault();
 
    $('.conte_mensaje').html('');

    let this_element=$(this);
    let password_nueva=$('#password_nueva').val();
    let password_confirm=$('#password_confirm').val();

    let error_msg="";
        if(password_nueva==""||password_confirm==""){
            error_msg="<p style='display:block'><i class='fas fa-exclamation-circle'></i> Todos los campos son obligatorios.</p>";
        }

        if(password_nueva!=password_confirm){
            error_msg+="<p style='display:block'> <i class='fas fa-exclamation-circle'></i>La contraseña de confirmación no coinciden.</p>";
        }

        if(error_msg!=""){
            alert=`
                    <div class="alert alert-danger" role="alert">
                        ${error_msg}
                    </div>`;
            $('.conte_mensaje').html(alert);
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        }
        document.getElementById("formulario_password_datos").submit();
        $("#formulario_password_datos").trigger('submit');

})




$('#password_show').on('change',function(){
    if($(this).is(':checked')){
       
        $('#password_nueva').attr('type','text');
        $('#password_confirm').attr('type','text');
    }else{
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
        $(this_element).parents('.conte_password').find('.password_text').addClass('valid-feedback').html('<strong>Contraseña segura</strong>');
    } else {
        $(this_element).addClass('is-invalid');
        $(this_element).parents('.conte_password').find('.password_text').addClass('invalid-feedback').html('<strong>Contraseña poca segura</strong>');
    }
}        

</script>

</html>
