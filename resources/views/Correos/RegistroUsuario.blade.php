<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"
	xmlns:m="http://schemas.microsoft.com/office/2004/12/omml">



<head>

	<meta http-equiv="Content-Language" content="es">

	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

	<title>Correo de confirmacion</title>

	<style>
		<!--
		div.Section1 {
			page: Section1;
		}

		p.MsoNormal {
			margin: 0cm;

			margin-bottom: .0001pt;

			font-size: 12.0pt;

			font-family: "Times New Roman";
		}

		.font6 {
			color: red;
			font-size: 10.0pt;
			font-weight: 700;
			font-style: normal;
			text-decoration: none;
			font-family: Cambria, serif;
		}

		.font7 {
			color: black;
			font-size: 10.0pt;
			font-weight: 700;
			font-style: normal;
			text-decoration: none;
			font-family: Cambria, serif;
		}

		.font5 {
			color: windowtext;
			font-size: 10.0pt;
			font-weight: 700;
			font-style: normal;
			text-decoration: none;
			font-family: Cambria, serif;
		}

		.c-12gn0oh {
			font-size: 1em
		}

		h3 {
			margin-right: 0cm;
			margin-left: 0cm;
			font-size: 13.5pt;
			font-family: "Times New Roman", serif;
		}

		table.MsoNormalTable {
			mso-style-parent: "";
			font-size: 10.0pt;
			font-family: "Times New Roman", serif
		}

		.style3 {
			text-align: left;
            color: red;
		}

		.style4 {
			border-width: 0px;
		}

		.style7 {
			text-align: center;
		}

		.style16 {
			color: #E75F0C;
			font-weight: bold;
		}

		.style17 {
			text-align: center;
			font-family: "Century Gothic";
			font-size: small;
			color: #E75F0C;
		}

		.style18 {
			text-align: center;
			font-family: Roboto;
            font-weight: bold;
			font-size: medium;
		}

		.style19 {
			color: #E75F0C;
			font-size: large;
		}

		.style20 {
			color: #E75F0C;
		}

		.style21 {
			text-align: center;
			font-family: Roboto;
			font-size: small;
		}

		.style23 {
			color: #02305D;
		}

		.style24 {
			font-family: Roboto;
			font-size: small;
		}

		.style25 {
			font-family: Roboto;
		}

        .titulo_escuela{
            font-weight: bold;
            color: #E75F0C;
			font-size: large;
        }

        .itss_escuela{
            font-weight: bold;
            color: #E75F0C;
			font-size: large;
            font-size: 20.0pt;
        }

		-->

	</style>

</head>

<body>
	<div class="Section1">
		<div align="center">
			<table border="0" cellpadding="0" cellspacing="0" width="58%">
				<tr>
                    <td class="style3" style="height: 33px">

                        <a target="_blank" href="https://tutoriasitss.granbazarmexico.store/" >
                         <img border="0" src="https://tutoriasitss.granbazarmexico.store/imagenes/itss.jpg" width="71" height="80" align="left">
                        </a>
                        <br>
                        <font class="itss_escuela">
                                TUTORIAS ITSS
                        </font>

                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td class="style18" style="height: 19px">
                        <p class="titulo_escuela">
                            Instituto tecnologico superior de la region sierra
                        </p>
                        <strong>
                            <br>
                            <span class="style19">Correo de confirmacion</span>
                        </strong>

                    </td>
                </tr>
                <tr>
                    <td height="21">
                        <center>
                            <strong>
                                    @if($msg['tipo_usuario']=="alumno")
                                         <br>
                                         <span class="style25">Tipo de usuario:Alumno</span>
                                         <br>
                                         <span class="style25">Matricula: {{$msg['matricula']}}</span>
                                        <br><br>
                                    @endif
                                    @if($msg['tipo_usuario']!="alumno"&&$msg['tipo_usuario']!="administrador")
                                        <br>
                                         <span class="style25">Tipo de usuario: {{ucwords($msg['tipo_usuario'])}}</span>
                                         <br>
                                         <span class="style25">Matricula: {{$msg['cedula_profesional']}}</span>
                                        <br><br>
                                    @endif
                                    @if($msg['tipo_usuario']=="administrador")
                                         <br>
                                         <span class="style25">Tipo de usuario: Administrador</span>
                                         <br><br>
                                    @endif
                                    <br>
                                <span class="style25">{{$msg['nombre']." ".$msg['ap_paterno']." ".$msg['ap_materno']}}</span>
                                        <br><br>
                                <span class="style25">Usuario: {{$msg['curp']}}</span>
                                    <br>
                                <span class="style25">constrasena: password</span>
                                <br>

                            </strong>
                            <br>
                            <br>
                            <br>
                            <br>
                            <a target="_blank" href="https://tutoriasitss.granbazarmexico.store/ConfirmCorreo/{{$msg['id_generado_user']}}">
                               <img border="0" src="https://tutoriasitss.granbazarmexico.store/imagenes/btn_confirmar.png"" width="250" height="50" align="center">
                            </a>
                            <br>
                        </center>
                    </td>
                </tr>
			</table>
		</div>

	</div>
    <p align="center">
        <b>
			<font face="Century Gothic" size="1">
                  <a target="_blank" href="https://tutoriasitss.granbazarmexico.store/ConfirmCorreo/{{$msg['id_generado_user']}}">
                    Enlace:{{$msg['id_generado_user']}}tutoriasitss.{{$msg['id_generado_user']}}granbazarmexico.store/{{$msg['id_generado_user']}}ConfirmCorreo/{{$msg['id_generado_user']}}
                  </a>
            </font>
		</b>
    </p>
	<p align="center">
        <b>
			<font face="Century Gothic" size="1">
                  <span lang="es">
					Para una correcta visualizacion se han omitido los acentos
                  </span>
            </font>
		</b>
    </p>
</body>
</html>
