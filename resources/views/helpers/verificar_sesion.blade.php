<?php

if(!isset($_SESSION)){
    session_start();
}

// echo "<pre>";
// print_r($_SESSION['auth_user']);
if(isset($_SESSION['auth_user'])){
    echo "<script>console.log('usuario logueado redireccionar dependiendo del tipo de usuario')</script>";
}else{
    header('Location:/');
}
?>

{{-- <h4>Bienvenido . {{auth()->user()}} </h4> --}}
