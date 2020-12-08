<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

        <title>Correo de confirmacion</title>
    <!-- Styles -->
</head>
<body>
    <table>
        <tr>
            <th style="text-align: center;">
                <h1 style="display:block;padding: 10px;color:#A66F24">Instituto tecnologico superior de la region sierra</h1>
                <h3>Confirmacion de correo</h3>
            </th>
        </tr>
        <tr>
            <th style="text-align: center;display:block;">
                <div style="padding: 10px;">Nombre:    <strong>{{ $msg['nombre']." ".$msg['ap_paterno']}}</strong></div>
            </th>
        </tr>

        @if($msg['tipo_usuario']=="alumno")
            <tr>
                <th style="text-align: center;">
                     <div style="color:#A66F24"><strong>Tipo de usuario: </strong>  Alumno</div>
                    <div style="padding: 10px;">Matricula: <strong>{{$msg['matricula']}}</strong></div>
                </th>
            </tr>
        @endif
        @if($msg['tipo_usuario']!="alumno"&&$msg['tipo_usuario']!="administrador")
             <tr>
                <th style="text-align: center;">
                    <div style="color:#A66F24"><strong>Tipo de usuario: </strong>  {{ucwords($msg['tipo_usuario'])}}</div>
                    <div style="padding: 10px;">Cedula profesional: <strong>{{$msg['cedula_profesional']}}</strong></div>
                </th>
            </tr>
        @endif
        @if($msg['tipo_usuario']=="administrador")
             <tr>
                <th style="text-align: center;">
                    <div style="color:#A66F24;padding: 10px;"><strong>Tipo de usuario: </strong> Administrador</div>
                </th>
            </tr>
        @endif

        <tr>
            <th style="display:flex;justify-content:center;aling-items:center;width:100%;">
               <a
               href="$link = 'http://dominio.com/forms/activacion/activa.php?var=' . base64_encode($registro.'|'.$token);"
               style="border:none;display:block;padding:10px;background-color:#A66F24;color:#ffff;margin-top: 30px;">Confirmar correo</a>
            </th>
        </tr>
    </table>
</body>
</html>
