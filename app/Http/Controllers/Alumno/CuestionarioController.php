<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class CuestionarioController extends Controller
{
     #cuestionario grupal
     public function pageCuestionarioGrupal(){



        $user=auth()->user();
        $id_user_logueado=$user->id;

        $MisDatos= DB::table('users')
        ->join('datos_alumnos','users.id', '=', 'datos_alumnos.user_id_alumno')
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
        $preguntas= DB::table('preguntas')
        ->orderBy('id_pregunta', 'asc')
        ->get();


        $periodo="";
        $mes_actual=date("n");
        //'FEBRERO-JULIO','AGOSTO-DICIEMBRE'
        if($mes_actual>=8){
            $periodo="AGOSTO-DICIEMBRE";
        }else{
            $periodo="FEBRERO-JULIO";
        }

        $cuestionario= DB::table('cuestionario')
        ->where('tipo_cuestionario','=','grupal')
        ->where('id_user_alumno','=',$id_user_logueado)
        ->where('id_user_tutor','=',$tutor[0]->user_id_asignado)
        ->where('periodo','=',$periodo)
        ->get();


        // dd($cuestionario);

        return view('alumno.cuestionario',compact('tutor','preguntas','cuestionario'));
    }

    public function RegistrarMi_CuestionarioGrupal(Request $request){

        $data=$request->all();
        $user=auth()->user();
        $id_user_logueado=$user->id;

        $periodo="";
        $mes_actual=date("n");
        //'FEBRERO-JULIO','AGOSTO-DICIEMBRE'
        if($mes_actual>=8){
            $periodo="AGOSTO-DICIEMBRE";
        }else{
            $periodo="FEBRERO-JULIO";
        }

        $MisDatos= DB::table('users')
        ->join('datos_alumnos','users.id', '=', 'datos_alumnos.user_id_alumno')
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

        $cuestionario= DB::table('cuestionario')
        ->where('tipo_cuestionario','=','grupal')
        ->where('id_user_alumno','=',$id_user_logueado)
        ->where('id_user_tutor','=',$tutor[0]->user_id_asignado)
        ->where('periodo','=',$periodo)
        ->get();

        if(count($cuestionario)>0){

            return json_encode([
            'status'=>400,
            'info'=>"<li>El cuestionario se lleva acabo cada semestre, y tu has completado el registro del periodo {$periodo}</li>"]);
        }

        try {
            DB::beginTransaction();


            $json_cuestionario=json_encode($data['data']);
            $observaciones=trim($data['observaciones']);
            $tipo_cuestionario=$data['tipo_cuestionario'];
            $id_user_tutor=$data['id_user_tutor'];



            $FECHA_REGISTER=date('Y-m-d H:i:s');
            DB::table('cuestionario')->insert(
                [
                    'respuestas_cuestionario' =>$json_cuestionario,
                    'observacion' =>$observaciones,
                    'tipo_cuestionario' =>$tipo_cuestionario,
                    'fecha_created_cuestionario' => $FECHA_REGISTER,
                    'id_user_alumno' =>$id_user_logueado,
                    'id_user_tutor' =>$id_user_tutor,
                    'periodo' =>$periodo
                ]
            );
            DB::commit();
            return json_encode([
                'status'=>200,
                'data'=>$data,
                'info'=>'<i class="fas fa-database"></i> Registro sastifactorio.</br>Muchas gracias por tu participación'
            ]);

        } catch (\Throwable $th) {
             DB::rollBack();
            return json_encode(['status'=>400,'info'=>'Se produjo un problema de comunicación con el servidor. recargue la pagina F5']);
        }
    }





    // cuestionarioIndividual
    public function RegistrarMi_CuestionarioIndividual(Request $request){

        $data=$request->all();
        $user=auth()->user();
        $id_user_logueado=$user->id;

        $periodo="";
        $mes_actual=date("n");
        //'FEBRERO-JULIO','AGOSTO-DICIEMBRE'
        if($mes_actual>=8){
            $periodo="AGOSTO-DICIEMBRE";
        }else{
            $periodo="FEBRERO-JULIO";
        }

        $MisDatos= DB::table('users')
        ->join('datos_alumnos','users.id', '=', 'datos_alumnos.user_id_alumno')
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

        $cuestionario= DB::table('cuestionario')
        ->where('tipo_cuestionario','=','grupal')
        ->where('id_user_alumno','=',$id_user_logueado)
        ->where('id_user_tutor','=',$tutor[0]->user_id_asignado)
        ->where('periodo','=',$periodo)
        ->get();

        if(count($cuestionario)>0){

            return json_encode([
            'status'=>400,
            'info'=>"<li>El cuestionario se lleva acabo cada semestre, y tu has completado el registro del periodo {$periodo}</li>"]);
        }

        try {
            DB::beginTransaction();


            $json_cuestionario=json_encode($data['data']);
            $observaciones=trim($data['observaciones']);
            $tipo_cuestionario=$data['tipo_cuestionario'];
            $id_user_tutor=$data['id_user_tutor'];



            $FECHA_REGISTER=date('Y-m-d H:i:s');
            DB::table('cuestionario')->insert(
                [
                    'respuestas_cuestionario' =>$json_cuestionario,
                    'observacion' =>$observaciones,
                    'tipo_cuestionario' =>$tipo_cuestionario,
                    'fecha_created_cuestionario' => $FECHA_REGISTER,
                    'id_user_alumno' =>$id_user_logueado,
                    'id_user_tutor' =>$id_user_tutor,
                    'periodo' =>$periodo
                ]
            );
            DB::commit();
            return json_encode([
                'status'=>200,
                'data'=>$data,
                'info'=>'<i class="fas fa-database"></i> Registro sastifactorio.</br>Muchas gracias por tu participación'
            ]);

        } catch (\Throwable $th) {
             DB::rollBack();
            return json_encode(['status'=>400,'info'=>'Se produjo un problema de comunicación con el servidor. recargue la pagina F5']);
        }
    }


     public function pageCuestionarioIndividual(){



        $user=auth()->user();
        $id_user_logueado=$user->id;

        $MisDatos= DB::table('users')
        ->join('datos_alumnos','users.id', '=', 'datos_alumnos.user_id_alumno')
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
        $preguntas= DB::table('preguntas')
        ->orderBy('id_pregunta', 'asc')
        ->get();


        $periodo="";
        $mes_actual=date("n");
        //'FEBRERO-JULIO','AGOSTO-DICIEMBRE'
        if($mes_actual>=8){
            $periodo="AGOSTO-DICIEMBRE";
        }else{
            $periodo="FEBRERO-JULIO";
        }

        $cuestionario= DB::table('cuestionario')
        ->where('tipo_cuestionario','=','grupal')
        ->where('id_user_alumno','=',$id_user_logueado)
        ->where('id_user_tutor','=',$tutor[0]->user_id_asignado)
        ->where('periodo','=',$periodo)
        ->get();


        // dd($cuestionario);

        return view('alumno.cuestionarioIndividual',compact('tutor','preguntas','cuestionario'));
    }
}
