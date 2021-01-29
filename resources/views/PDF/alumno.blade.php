
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

                <img src="https://tutoriasitss.granbazarmexico.store/imagenes/itss.jpg" style="height:70px;object-fit: cover;float: left;" alt="logo">
                <strong style="heigth:70px;line-height:70px;font-size:20px;margin-left:10px;">Instituto Tecnológico Superior de la Región Sierra.</strong>

        </div>
         @if (count($users)>0)
         <h5>Lista de alumnos</h5>
         <table class="table">
             <thead>
                 <tr>
                     <th>Nombre</th>
                     <th>Curp</th>
                     <th>Telefono</th>
                     <th>Correo</th>
                     <th>Genero</th>
                     <th>Matricula</th>
                     <th>Carrera</th>
                     <th>Semestre</th>
                     <th>Grupo</th>
                     <th>Turno</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($users as $item)
                 <tr>
                     <td>{{ucwords($item->nombre." ".$item->ap_paterno." ".$item->ap_materno)}}</td>
                     <td>{{$item->curp}}</td>
                     <td>{{$item->telefono}}</td>
                     <td>{{$item->email}}</td>
                     <td>{{$item->genero}}</td>
                     <td>{{$item->matricula}}</td>
                     <td>{{$item->name_carrera}}</td>
                     <td>{{$item->semestre}}°</td>
                     <td>{{$item->grupo}}</td>
                     <td>{{$item->turno}}</td>
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
