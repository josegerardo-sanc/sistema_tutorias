<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnosController extends Controller
{

    public function index(){


        $user=auth()->user();

        $asignaciones=DB::table('asignacion')->where('user_id_asignado','=',$user->id)
        ->leftJoin('carreras','asignacion.carrera', '=', 'carreras.id_carrera')
        ->select('asignacion.*','carreras.carrera as name_carrera')
        ->get();


        $alumnos=[];
        $data_codigoPostal=[];
        if(count($asignaciones)>0){
            $alumnos=DB::table('users')
                        ->leftJoin('datos_alumnos','users.id', '=', 'datos_alumnos.user_id_alumno')
                        ->leftJoin('carreras','datos_alumnos.carrera', '=', 'carreras.id_carrera')
                        ->where('users.tipo_usuario','=','alumno')
                        ->where('datos_alumnos.carrera','=',$asignaciones[0]->carrera)
                        ->where('datos_alumnos.semestre','=',$asignaciones[0]->semestre)
                        ->where('datos_alumnos.turno','=',$asignaciones[0]->turno)
                        ->where('datos_alumnos.grupo','=',$asignaciones[0]->grupo)
                        ->select('users.*','datos_alumnos.*','carreras.carrera as name_carrera','users.id as id_user_principal')
                        ->get();

            $data_codigoPostal=DB::table('codigos')->where('codigo', $alumnos[0]->code_postal)->get();

        }else{
            $asignaciones=[];
        }

        // dd($data_codigoPostal);

        return view('tutor.index',compact('asignaciones','alumnos','data_codigoPostal'));
    }

    public function registerAlumno(Request $request){

    }
    public function actualizarAlumno(Request $request){

    }


}
