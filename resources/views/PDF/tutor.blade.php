
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
        background-color: #A95E14;
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

    .horario{
        background-color: #B97634 !important;
        color:white;
    }
    .horario>tr{
        background-color: #B97634 !important;
        color:white;
    }
    .danger_error_horario >tr{
        background-color: #E82258 !important;
        color:white;
    }

</style>
<body>
        <div style="margin-bottom:30px;margin-top:10px">

                <img src="https://tutoriasitss.granbazarmexico.store/imagenes/itss.jpg" style="height:70px;object-fit: cover;float: left;" alt="logo">
                <strong style="heigth:70px;line-height:70px;font-size:20px;margin-left:10px;">Instituto Tecnológico Superior de la Región Sierra.</strong>

        </div>
         @if (count($users)>0)
         <h5>Lista de Tutores</h5>
         <table class="table">
             <thead>
                 <tr>
                     <th colspan="2">Nombre</th>
                     <th>Curp</th>
                     <th>Telefono</th>
                     <th>Correo</th>
                     <th>Carrera</th>
                     <th>Semestre</th>
                     <th>Grupo</th>
                     <th>Turno</th>
                     <th>Total Horas</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($users as $item)
                 <tr>
                     <td colspan="2"><strong>{{ucwords($item->nombre." ".$item->ap_paterno."".$item->ap_materno)}}</strong></td>
                     <td><strong>{{$item->curp}}</strong></td>
                     <td><strong>{{$item->telefono}}</strong></td>
                     <td><strong>{{$item->email}}</strong></td>
                     <td><strong>{{$item->name_carrera}}</strong></td>
                     <td><strong>{{$item->semestre}} °</strong></td>
                     <td><strong>{{$item->grupo}}</strong></td>
                     <td><strong>{{$item->turno}}</strong></td>
                     <td><strong>{{$item->total_horas}} Hrs</strong></td>
                 </tr>
                 @if ($item->asignacion_horas>0)
                    <tr class="horario">
                        @if ($item->lunes_hora>0)
                        <td colspan="2">Lunes  {{$item->lunes_hora}} Hr</td>
                        @else
                        <td colspan="2"></td>
                        @endif
                        @if ($item->martes_hora>0)
                        <td>Martes {{$item->martes_hora}} Hr</td>
                        @else
                        <td colspan="2"></td>
                        @endif
                        @if ($item->miercoles_hora>0)
                        <td colspan="2">Miercoles  {{$item->miercoles_hora}} Hr</td>
                        @else
                        <td colspan="2"></td>
                        @endif
                        @if ($item->jueves_hora>0)
                        <td colspan="2">Jueves  {{$item->jueves_hora}} Hr</td>
                        @else
                        <td colspan="2"></td>
                        @endif
                        @if ($item->viernes_hora>0)
                        <td colspan="2">Viernes {{$item->viernes_hora}} Hr</td>
                        @else
                        <td colspan="2"></td>
                        @endif
                    </tr>
                 @else
                    <tr class="danger_error_horario">
                        <td colspan="10">No tienes asignadas horas</td>
                    </tr>
                 @endif



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
