<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AlumnoController extends Controller
{

    public function index(){

        $user=auth()->user();
        $id_user_logueado=$user->id;

        $MisDatos= DB::table('users')
        ->leftJoin('datos_alumnos','users.id', '=', 'datos_alumnos.user_id_alumno')
        ->where('users.tipo_usuario','=','alumno')
        ->where('users.id','=',$id_user_logueado)
        ->get();

        $alumnos= DB::table('users')
        ->leftJoin('datos_alumnos','users.id', '=', 'datos_alumnos.user_id_alumno')
        ->where('users.tipo_usuario','=','alumno')
        ->where('datos_alumnos.carrera','=',$MisDatos[0]->carrera)
        ->where('datos_alumnos.semestre','=',$MisDatos[0]->semestre)
        ->where('datos_alumnos.turno','=',$MisDatos[0]->turno)
        ->where('datos_alumnos.grupo','=',$MisDatos[0]->grupo)
        ->get();

        $alumnos=[];
        return view('alumno.index',compact('alumnos'));

    }

    public function miTutor(){
        $user=auth()->user();
        $id_user_logueado=$user->id;

        $MisDatos= DB::table('users')
        ->leftJoin('datos_alumnos','users.id', '=', 'datos_alumnos.user_id_alumno')
        ->where('users.tipo_usuario','=','alumno')
        ->where('users.id','=',$id_user_logueado)
        ->get();

        $tutor= DB::table('users')
        ->leftJoin('asignacion','users.id', '=', 'asignacion.user_id_asignado')
        ->leftJoin('carreras','asignacion.carrera', '=', 'carreras.id_carrera')
        ->where('asignacion.carrera','=',$MisDatos[0]->carrera)
        ->where('asignacion.semestre','=',$MisDatos[0]->semestre)
        ->where('asignacion.turno','=',$MisDatos[0]->turno)
        ->where('asignacion.grupo','=',$MisDatos[0]->grupo)
        ->select('users.*','asignacion.*','carreras.carrera as name_carrera')
        ->get();
        // dd($tutor);
        return view('alumno.tutor',compact('tutor'));
    }



    // formatos

    public function page_formatos_alumnos(){

        // dd($formatos_tutores);
        return view('alumno.formatos');
    }
    public function formatosIndex(Request $request){

        // $data=$request->all();
        $Formatos = DB::table('archivos')->where('tipo_archivo',1)->orderBy('fecha_created_archivo', 'desc')->get();

        $formatos_alumno=[];

        foreach ($Formatos as $key => $formato) {
            # code...
            $datos_json=json_decode($formato->datos_tipo_archivo,true);
            // 2 es tutor
            // 1 es alumno
            if($datos_json['archivo_dirigido']=="1"){
                $formatos_alumno[]=$formato;
            }

        }

        return json_encode(['status'=>200,'data'=>$formatos_alumno]);
    }
    public function downloadFormato($id){

        $datos_file=DB::table('archivos')->where('id_archivo','=',$id)->get();

        $name_file_original=json_decode($datos_file[0]->{'datos_tipo_archivo'},true);

        $pathToFile=storage_path()."/app/".$datos_file[0]->{'ruta_archivo'};
        return Storage::disk('public')->download($datos_file[0]->{'ruta_archivo'},$name_file_original['nombre_archivo']);

    }


}
