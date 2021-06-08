
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evaluacion Tutor</title>
</head>
<style>
    body{
        padding: 0px;
        box-sizing: border-box;
        display: block;
        margin: auto auto;
        width:900px;
    }

    .table{
        background-color: white;
        text-align: left;
        border-collapse: collapse;
    }

    thead{
        background-color: #D3903D;
        /* border-bottom: solid 5px #0F362D; */
        color: rgb(145, 143, 143);
    }

    tr:nth-child(even){
        background-color: #E9E7E4;
    }

    tr th{
        color: white;
        padding: 5px;
        font-size: 14px;
    }

    tr td{
        padding: 5px;
        font-size: 12px;
    }

    footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            /* background-color: #D3903D; */
            color:black;
            text-align: center;
            line-height: 35px;
        }
</style>
<body>

        <table>
            <tr>
                <td>
                    <img src="https://tutoriasitss.granbazarmexico.store/storage/imagenes/itss.jpg" style="height:70px;object-fit: cover;float: left;" alt="logo">
                </td>
                <td text-align="center">
                    <strong style="heigth:70px;line-height:70px;font-size:20px;margin-left:10px;">Instituto Tecnológico Superior de la Región Sierra.</strong>
                </td>
            </tr>
        </table>
         @if (count($data)>0)
            <h5>Evaluación Segumiento Tutor</h5>
            <div>
                <strong>Nombre :</strong> {{ucwords($data[0]->{'nombre'}." ".$data[0]->{'ap_paterno'}." ".$data[0]->{'ap_materno'})}}
                </br>
            </div>
            <table class="table">

                <tbody>
                    <?php

                    //{"pregunta_1":"true","pregunta_2":"true","pregunta_3":"false","pregunta_4":"false","pregunta_5":"true"}
                        $respuesta=json_decode($data[0]->{'respuestas_evaluacion'},true);
                    ?>
                    <tr>
                        <td><strong>{{$respuesta['pregunta_1']=="true"?"Si":"No"}}</strong></td>
                        <td>
                            <p>Realiza el diagnóstico del tutorado y detecta áreas de atención en estudiantes.</p>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>{{$respuesta['pregunta_2']=="true"?"Si":"No"}}</strong></td>
                        <td>
                            <p>
                                Realiza el diagnóstico del tutorado y detecta áreas de atención en estudiantes,lleva acabo sesiones
                                planeadas individuales o grupales.
                                canaliza estudiantes
                            </p>
                        </td>

                    </tr>
                    <tr>
                        <td><strong>{{$respuesta['pregunta_3']=="true"?"Si":"No"}}</strong></td>
                        <td> <p>Entrega los resportes en tiempo y forma</p></td>

                    </tr>
                    <tr>
                        <td><strong>{{$respuesta['pregunta_4']=="true"?"Si":"No"}}</strong></td>
                        <td><p>
                            Realiza el diagnóstico del tutorado, detecta áreas de atención en el estudiantes lleva acabo sesiones
                            planeadas individuales o grupales canaliza estudiantes.
                            </br>
                            Entrega reportes con evidencias de las actividades desarolladas en el programa de accción tutorial en tiempo y forma.
                        </p></td>
                    </tr>
                    <tr>
                        <td><strong>{{$respuesta['pregunta_5']=="true"?"Si":"No"}}</strong></td>
                        <td>
                            Realiza el diagnóstico del tutorado, detecta área de atención en estudiantes,lleva acabo sesiones
                                    planeadas individuales o grupales canaliza estudiantes
                                    </br>
                                    Entrega reportes con evidencias de las actividades desarollada en el programa de accción tutorial en tiempo y forma
                                    </br>
                                    Elabora el diagnóstico institucional de tutorias para aplicar el programa institucional de tutorias.
                                    </br>
                                    Elabora el plan de acción tutorial para el periodo escolar y da seguimiento.
                        </td>

                    </tr>
                </tbody>
            </table>
         @else
           <center> <h2>No se encontraron resultados</h2></center>
         @endif
        <footer>
            Instituto Tecnológico Superior de la Región Sierra. Carretera Teapa-Tacotalpa Km 4.5, Francisco Javier Mina, Tabasco 86801
            <br>
            Tel./Fax: (932) 324 06 50
            <br>
            E-mail: regionsierra@itss.edu.mx
        </footer>
</body>
</html>
