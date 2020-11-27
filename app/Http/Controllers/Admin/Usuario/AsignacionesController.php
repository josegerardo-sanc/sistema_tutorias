<?php

namespace App\Http\Controllers\Admin\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use DateTime;


class AsignacionesController extends Controller
{

    public function create(){

        $users_tutores = DB::table('users')
        ->leftJoin('asignacion','users.id', '=', 'asignacion.user_id_asignado')
        ->leftJoin('carreras','asignacion.carrera', '=', 'carreras.id_carrera')
        ->where('tipo_usuario','=','tutor')
        ->get();


        foreach ($users_tutores as $key => $user) {
            $count_alumnos=0;

            if($user->{'id_asignacion'}!=null){
                $count_alumnos = DB::table('datos_alumnos')
                ->where('carrera','=',$user->{'id_carrera'})
                ->where('semestre','=',$user->{'semestre'})
                ->where('turno','=',$user->{'turno'})
                ->where('grupo','=',$user->{'grupo'})
                ->count();
            }
          $users_tutores[$key]->{'COUNT_ALUMNOS'}=$count_alumnos;
        }
        // dd($users_tutores);
        return view('admin.asignaciones.create',compact('users_tutores'));

    }

    public function store(Request $request){

        $data=$request->all();
        //return json_encode(['data'=>$data]);
        $msg_success="";
        $carrera=trim($data['carrera']);
        $semestre=trim($data['semestre']);
        $turno=trim($data['turno']);
        $grupo=trim($data['grupo']);
        $id_user_asignacion=$data['id_user_asignacion'];
        $user_register=$data['id_user_register'];
        $action_update_save=trim($data['action_update_save']);

        $horario=$data['horario_tutor'];

        if($horario['lunes_hora']==0||$horario['lunes_hora']==""){
            $horario['lunes']="false";
        }
        if($horario['martes_hora']==0||$horario['martes_hora']==""){
            $horario['martes']="false";
        }
        if($horario['miercoles_hora']==0||$horario['miercoles_hora']==""){
            $horario['miercoles']="false";
        }
        if($horario['jueves_hora']==0||$horario['jueves_hora']==""){
            $horario['jueves']="false";
        }
        if($horario['viernes_hora']==0||$horario['viernes_hora']==""){
            $horario['viernes']="false";
        }

        $data['horario_tutor']=$horario;
        // return ['lunes'=>$data['horario_tutor']];

        $horario=json_encode($data['horario_tutor']);

        #STORE_SAVE   #UPDATE_SAVE
        if($action_update_save=="UPDATE_SAVE"){

            $id_asignacion=trim($data['id_asignacion']);

            $count_asignacion = DB::table('asignacion')
            ->where('user_id_asignado','!=',$id_user_asignacion)
            ->where('carrera','=',$carrera)
            ->where('semestre','=',$semestre)
            ->where('turno','=',$turno)
            ->where('grupo','=',$grupo)
            ->count();

            if($count_asignacion>=1){
                return json_encode(['status'=>400,'countAsignacion'=>$count_asignacion,'info'=>'ya se encuntra registrado esta asignacion']);
            }

            try {
                DB::table('asignacion')
                ->where('id_asignacion',$id_asignacion)
                ->update([
                        'user_id_asignado' => $id_user_asignacion,
                        'semestre' =>$semestre,
                        'carrera' => $carrera,
                        'turno' => $turno,
                        'horario'=>$horario,
                        'grupo'=>$grupo,
                    ]);

            $msg_success="<i class='fas fa-history'></i> ASIGNACIÓN ACTUALIZADA CON EXITO";

            } catch (\Throwable $th) {
                return json_encode(['data'=>[],'status'=>400,'info'=>'Intentelo de nuevo, error al registrar asignación']);
            }

        }else{
            #STORE_SAVE
            $count_asignacion = DB::table('asignacion')
                ->where('carrera','=',$carrera)
                ->where('semestre','=',$semestre)
                ->where('turno','=',$turno)
                ->where('grupo','=',$grupo)
                ->count();

                if($count_asignacion>=1){
                    return json_encode(['status'=>400,'countAsignacion'=>$count_asignacion,'info'=>'ya se encuntra registrado esta asignacion']);
                }
                $fecha_actual= new DateTime();

                try {
                    DB::table('asignacion')->insert(
                        [
                            'semestre' =>$semestre,
                            'carrera' => $carrera,
                            'turno' => $turno,
                            'grupo' => $grupo,
                            'fecha_created' =>$fecha_actual->format('Y-m-d h:i:s'),
                            'user_register'=>$user_register,
                            'user_id_asignado' => $id_user_asignacion,
                            'horario'=>$horario
                        ]
                    );

                    $msg_success="<i class='fas fa-database'></i> ASIGNACIÓN REGISTRADA CON EXITO";
                } catch (\Throwable $th) {
                    return json_encode(['data'=>[],'status'=>400,'info'=>'Intentelo de nuevo, error al registrar asignación']);
                }
        }

        $Tutores = DB::table('users')
        ->where('tipo_usuario','=','tutor')
        ->get();

        $users_tutores = DB::table('users')
        ->leftJoin('asignacion','users.id', '=', 'asignacion.user_id_asignado')
        ->leftJoin('carreras','asignacion.carrera', '=', 'carreras.id_carrera')
        ->where('tipo_usuario','=','tutor')
        ->where('asignacion.id_asignacion','!=',null)
        ->get();


        foreach ($users_tutores as $key => $user) {
            $count_alumnos=0;

            if($user->{'id_asignacion'}!=null){
                $count_alumnos = DB::table('datos_alumnos')
                ->where('carrera','=',$user->{'id_carrera'})
                ->where('semestre','=',$user->{'semestre'})
                ->where('turno','=',$user->{'turno'})
                ->where('grupo','=',$user->{'grupo'})
                ->count();
            }
          $users_tutores[$key]->{'COUNT_ALUMNOS'}=$count_alumnos;
        }

       return json_encode(['ListTutores'=>$Tutores,'data'=>$users_tutores,'status'=>200,'info'=>$msg_success]);
    }


    public function getListaAlumnos(Request $request){
        $data_post=$request->all();

        // return json_encode(['data'=>$data_post]);

        $semestre=$data_post['semestre'];
        $id_carrera=$data_post['id_carrera'];
        $turno=$data_post['turno'];
        $grupo=$data_post['grupo'];

        $data= DB::table('users')
        ->leftJoin('datos_alumnos','users.id', '=', 'datos_alumnos.user_id_alumno')
        ->where('users.tipo_usuario','=','alumno')
        ->where('datos_alumnos.carrera','=',$id_carrera)
        ->where('datos_alumnos.semestre','=',$semestre)
        ->where('datos_alumnos.turno','=',$turno)
        ->where('datos_alumnos.grupo','=',$grupo)
        ->get();

        return json_encode(['data'=>$data,'status'=>200]);
    }

    public function destroy(Request $request,$id){

        //$data=$request->all();
        // return json_encode(['data'=>$data]);
        try {
            DB::table('asignacion')->where('id_asignacion', '=', $id)->delete();

            $users_tutores = DB::table('users')
            ->leftJoin('asignacion','users.id', '=', 'asignacion.user_id_asignado')
            ->where('tipo_usuario','=','tutor')
            ->get();

            return json_encode(['ListTutores'=>$users_tutores,'status'=>200]);

        } catch (\Throwable $th) {

            return json_encode(['status'=>400]);
        }

    }
}
