<?php

namespace App\Http\Controllers\Admin\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UsuarioController extends Controller
{

    public function create(Request $request){

      $data = json_decode($request->getContent(), true);


       $validatedData = Validator::make($data, [
            'tipo_usuario'=>'required',
            'curp'=>['required','string','max:20','unique:users'],
            'telefono'=>['required','string','max:15','unique:users'],
            'email'=>['required','email','max:50','unique:users'],
            'rfc'=>'required',
            'nombre'=>'required',
            'ap_paterno'=>'required',
            'genero'=>'required',
            'fecha_nacimiento'=>'required',
            'codigo_postal'=>'required',
            'localidad'=>'required'
        ]);

        if($validatedData->fails()) {
            return json_encode(['withErrrors'=>$validatedData->errors()->all()]);
        }


        $tipo_usuario=trim($data['tipo_usuario']);
        $curp=trim($data['curp']);
        $telefono=trim($data['telefono']);
        $correo=trim($data['email']);
        $rfc=trim($data['rfc']);
        $nombre=trim($data['nombre']);
        $ap_paterno=trim($data['ap_paterno']);
        $ap_materno=trim($data['ap_materno']);
        $genero=trim($data['genero']);
        $fecha_nacimiento=trim($data['fecha_nacimiento']);
        $codigo_postal=trim($data['codigo_postal']);
        $localidad=trim($data['localidad']);

        try {
            //code...
            $status=DB::table('users')->insert([
                [
                    'tipo_usuario'=>  $tipo_usuario,
                    'curp'=> $curp ,
                    'rfc'=>$rfc,
                    'nombre'=> $nombre ,
                    'ap_paterno'=>$ap_paterno ,
                    'ap_materno'=> $ap_materno,
                    'genero'=> $genero,
                    'fecha_nacimiento'=> $fecha_nacimiento,
                    'localidad'=> $localidad,
                    'telefono'=>$telefono  ,
                    'email'=>  $correo,
                    'active'=>'1',
                    'password'=> Hash::make('password'),
                ],
            ]);
            if(!$status){
             throw new Exception("NO SE PUDO REALIZAR EL REGISTRO DE USUARIO, EXEPTION");
            }


            /*
            if($tipo_usuario=="3"){
                $status=DB::table('datos_alumnos')->insert([
                    [
                        'matricula'=>$matricula,
                        'periodo'=> $periodo ,
                        'semestre'=>$semestre ,
                        'grupo'=> $grupo,
                        'turno'=> $turno,
                        'user_id_alumno'=> $user_id_alumno
                    ],
                ]);
                if(!$status){
                 throw new Exception("NO SE PUDO REALIZAR EL REGISTRO DE USUARIO, EXEPTION");
                }
            }
            */







            return json_encode(['status'=>"200",'info'=>"Registro exitoso"]);

        } catch (\Throwable $e) {
            return json_encode(['status'=>"400",'info'=>"se produjo un problema de comunicación con los servidor",'Exeception_db'=>$th->getMessage()]);
        }





    }
}
