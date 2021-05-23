
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>usuarios</title>
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
        <div style="margin-bottom:30px;margin-top:10px">

                <img src="https://tutoriasitss.granbazarmexico.store/storage/imagenes/itss.jpg" style="height:70px;object-fit: cover;float: left;" alt="logo">
                <center>
                    <strong style="heigth:70px;line-height:70px;font-size:20px;margin-left:10px;">Instituto Tecnológico Superior de la Región Sierra.</strong>
                </center>
        </div>
         @if (count($cuestionario)>0)
         <h5>Evaluación individual</h5>
         <table class="table">
             <thead>
                 <tr>
                     <th>Nombre</th>
                     <th>Matricula</th>
                     <th>Carrera</th>
                     <th>Semestre</th>
                     <th>Grupo</th>
                     <th>Turno</th>
                 </tr>
             </thead>
             <tbody>
                <tr>
                    <td>{{ucwords($cuestionario[0]->{'nombre'}." ".$cuestionario[0]->{'ap_paterno'}." ".$cuestionario[0]->{'ap_materno'})}}</td>
                    <td>{{($cuestionario[0]->{'matricula'})}}</td>
                    <td>{{ $cuestionario[0]->{'carrera'} }}</td>
                    <td>{{($cuestionario[0]->{'semestre'})}}°</td>
                    <td>{{($cuestionario[0]->{'grupo'})}}</td>
                    <td>{{($cuestionario[0]->{'turno'})}}</td>
                </tr>
                 @foreach ($preguntas as $key => $pregunta)
                 <?php
                    $respuesta=json_decode($cuestionario[0]->{'respuestas_cuestionario'},true);
                 ?>
                 <tr>
                     <td>
                         {{($pregunta->{'pregunta'})}}
                     </td>
                     @foreach ($respuesta as $respuesta)
                            @if ($pregunta->{'id_pregunta'}==$respuesta['id_pregunta'])
                                <td>{{$respuesta['respuesta'] == "siempre"?"si":"no"}}</td>
                                <td>{{$respuesta['respuesta'] == "casi_siempre"?"si":"no"}}</td>
                                <td>{{$respuesta['respuesta'] == "a_veces"?"si":"no"}}</td>
                                <td>{{$respuesta['respuesta'] == "nunca"?"si":"no"}}</td>
                            @endif    

                    @endforeach
                 </tr>
                 @endforeach
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
