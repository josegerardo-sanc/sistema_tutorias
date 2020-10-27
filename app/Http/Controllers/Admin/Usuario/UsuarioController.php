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
        // validacion datos personales
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

        // validacion datos_academicos_alumno
        $matricula=isset($data['matricula'])?$data['matricula']:"";
        $semestre_escolar=isset($data['semestre_escolar'])?$data['semestre_escolar']:"";
        $periodo_escolar=isset($data['periodo_escolar'])?$data['periodo_escolar']:"";
        $turno_escolar=isset($data['turno_escolar'])?$data['turno_escolar']:"";
        $grupo_escolar=isset($data['grupo_escolar'])?$data['grupo_escolar']:"";

        if($tipo_usuario==3){
            // alumno
            $validatedDatos_complementarios = Validator::make($data, [
                'matricula'=>['required','string','max:10','unique:datos_alumnos'],
                'semestre_escolar'=>'required',
                'periodo_escolar'=>'required',
                'turno_escolar'=>'required',
                'grupo_escolar'=>'required'
            ]);
        }

         // validacion datos_academicos_alumno
        $cedula_profesional=isset($data['cedula_profesional'])?$data['cedula_profesional']:"";
        if($tipo_usuario!=3 && $tipo_usuario!=6){
            // diferente de alumno y administardior, solictar cedula profesional etc.
            $validatedDatos_complementarios = Validator::make($data, [
                'cedula_profesional'=>['required','string','max:10','unique:datos_docentes']
                //'grupo_escolar'=>'required'
            ]);
        }

        if($validatedDatos_complementarios->fails()) {
            return json_encode(['withErrrors'=>$validatedDatos_complementarios->errors()->all()]);
        }


        // //ver post
        // return json_encode(['data'=>$data]);

        try {

            DB::beginTransaction();


            $user_id_created = DB::table('users')->insertGetId(
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
                    'password'=> Hash::make('password')
                ]
            );

            if($user_id_created<=0){
                 throw new Exception ("NO SE PUDO REALIZAR EL REGISTRO DE USUARIO, EXEPTION");
            }

            if($tipo_usuario=="3"){
                $status=DB::table('datos_alumnos')->insert([
                    [
                        'matricula'=>$matricula,
                        'periodo'=> $periodo_escolar ,
                        'semestre'=>$semestre_escolar ,
                        'grupo'=> $grupo_escolar,
                        'turno'=> $turno_escolar,
                        'user_id_alumno'=> $user_id_created
                    ],
                ]);
              if(!$status){
                  throw new Exception("NO SE PUDO REALIZAR EL REGISTRO DE DATOS DEL ALUMNO, EXEPTION");
              }
            }
            if($tipo_usuario!="3" && $tipo_usuario!="6"){
                $status=DB::table('datos_docentes')->insert([
                    [
                        'cedula_profesional'=>$cedula_profesional,
                        'user_id_docente'=> $user_id_created
                    ],
                ]);
                if(!$status){
                 throw new Exception("NO SE PUDO REALIZAR EL REGISTRO DE DATOS DEL DOCENTE, EXEPTION");
                }
            }

           DB::commit();
            return json_encode(['status'=>"200",'info'=>"Registro exitoso"]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return json_encode(['status'=>"400",'info'=>"se produjo un problema de comunicación con los servidor",'Exeception_db'=>$e->getMessage(),'line'=>$e->getLine()]);
        }
    }
}
