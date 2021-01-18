<?php

namespace App\Http\Controllers\helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CodepostalController extends Controller
{


    public function GetCodePostal(Request $request){

        $data=$request->all();

        $codigoPostal=$data['codigoPostal'];

        $mexico = DB::table('codigos')->where('codigo', $codigoPostal)->get();
        return response()->json(['data'=>$mexico,'codigoPostalReferencia'=>$codigoPostal]);

    }


    public function tutoresAsignados($id,Request $request){

        $data=$request->all();
        $alumnos=[];
        $carreras=[];

        if(isset($data['buscar_alumnos'])){
            $alumnos = DB::table('users')
                            ->leftJoin('datos_alumnos','users.id','datos_alumnos.user_id_alumno')
                            ->leftJoin('carreras','datos_alumnos.carrera','carreras.id_carrera')
                            ->where('users.tipo_usuario','=','alumno')
                            ->where('carreras.id_carrera','=',$id)
                            ->get();
        }
        if(isset($data['buscar_carreras'])){
            $carreras = DB::table('carreras')->get();
        }



        try {
            $users_tutores = DB::table('asignacion')
                                ->leftJoin('users','asignacion.user_id_asignado','users.id')
                                ->where('asignacion.carrera','=',$id)
                                ->where('users.tipo_usuario','=','tutor')
                                ->get();

             return json_encode(['status'=>200,'data'=>$users_tutores,'alumnos'=>$alumnos,'carreras'=>$carreras]);
        } catch (\Throwable $th) {
            return json_encode(['status'=>400,'info'=>'Se perdio la comunicación con el servidor, porfavor refresque la pagina F5.']);

        }

    }



}
