<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"
	xmlns:m="http://schemas.microsoft.com/office/2004/12/omml">



<head>

	<meta http-equiv="Content-Language" content="es">

	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

	<title>Correo de confirmacion</title>

	<style>
		div.Section1 {
			page: Section1;
		}

		.style25 {
			font-family: Roboto;
		}

        .titulo_escuela{
            font-weight: bold;
            color: #E75F0C;
            font-size: 20.0pt;
        }

        .itss_escuela{
            font-weight: bold;
            color: #E75F0C;
			font-size: large;
            font-size: 25.0pt;
        }
        .style19 {
			color: #E75F0C;
			font-size: large;
            font-size: 18.0pt;
		}


	</style>

</head>
<body>
    <?php
        // $msg['nombre']="jose gerardo";
        // $msg['ap_paterno']="sánchez";
        // $msg['ap_materno']="alvarado";
        // $msg['curp']="SAAG950819HTCNLR07";
        // $msg['id_generado_user']="1";
    ?>

	<div class="Section1">
		<div align="center">
			<table border="0" cellpadding="0" cellspacing="0" width="58%">
				<tr>
                    <td style="height: 33px">

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
                    <td  style="height: 19px">
                        <center class="titulo_escuela">
                            Instituto tecnologico superior de la region sierra
                        </center>
                        <center>
                            <br>
                            <span class="style19">por favor, cambie su contrase&ntilde;a</span>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td height="21">
                        <center>
                            <strong>
                                <span class="style25">{{$msg['nombre']." ".$msg['ap_paterno']." ".$msg['ap_materno']}}</span>
                                        <br><br>
                                <span class="style25">Usuario: {{$msg['curp']}}</span>
                                    <br>
                                    <br>
                            </strong>
                            <br>
                            <br>
                            <br>
                            <span>
                                Escuchamos que perdió su contraseña de tutorias. ¡Lo siento por eso &#33;
                                <br>
                                &#161; Pero no te preocupes &#33; Puede utilizar el siguiente enlace para restablecer su contrase&ntilde;a:
                            </span>
                            <br>
                            <br>
                            <br>
                            <a target="_blank" href="http://localhost:8000/password_reset/user/{{$msg['id_generado_user']}}">
                                http://localhost:8000/password_reset/user/{{$msg['id_generado_user']}}
                            </a>
                            <br>
                        </center>
                    </td>
                </tr>
			</table>
		</div>

	</div>
    <br>
    <p align="center">
        <b>
			<font face="Century Gothic" size="1">
                  <span lang="es">
                    Si no usa este enlace dentro de las 3 horas, caducara. Para obtener un nuevo enlace para restablecer la contrase&ntilde;a,
                    <br>
                    <a href="https://tutoriasitss.granbazarmexico.store/">
                        visite https://tutoriasitss.granbazarmexico.store/
                    </a>
                  </span>
            </font>
		</b>
    </p>
    <br><br>
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
