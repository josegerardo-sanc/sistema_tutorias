<?php

namespace App\Http\Controllers\Admin\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use DateTime;

class asignacionIndividualController extends Controller
{

    // asignacion_individual

    public function create(){

        $users_tutores = DB::table('users')
        ->where('tipo_usuario','=','tutor')
        ->get();

        $users_alumnos = DB::table('users')
        ->leftJoin('datos_alumnos', 'users.id', '=', 'datos_alumnos.user_id_alumno')
        ->select('users.*','users.id as id_users','datos_alumnos.*')
        ->where('tipo_usuario','=','alumno')
        ->get();

        $asignacionIndividuales= DB::table('asignacion_individual as asig')
        ->leftJoin('users as tutor', 'tutor.id', '=', 'asig.id_user_tutor')
        ->leftJoin('users as alumno', 'alumno.id', '=', 'asig.id_user_alumno')
        ->leftJoin('datos_alumnos AS dt_alumno', 'alumno.id', '=', 'dt_alumno.user_id_alumno')
        ->select(
            'tutor.nombre as nombre_tutor','tutor.ap_paterno as paterno_tutor','alumno.nombre as nombre_alumno','alumno.ap_paterno as paterno_alumno','dt_alumno.matricula'
            ,'asig.fecha_created','asig.id_asignacion_individual as idAsignacionIndividual','tutor.id as idTutor','alumno.id as idAlumno')
        ->get();

        // dd($asignacionIndividuales);

        return view('admin.asignaciones.createAsigIndividual',compact('users_tutores','users_alumnos','asignacionIndividuales'));
    }
    public function store(Request $request){

        $data=$request->all();
        // return json_encode(['data'=>$data]);

        $fecha_actual= new DateTime();

        $users = DB::table('asignacion_individual')
            ->where('id_user_tutor','=',$data['id_tutor'])
            ->where('id_user_alumno','=',$data['id_alumno'])
            ->get();

        if(count($users)>0){
            return json_encode([
                'status'=>400,
                'count'=>count($users),
                'info'=>'<i class="fas fa-exclamation-circle"></i> YA SE ENCUNTRA EN USO ESTA ASIGNACIÓN'
                ]);
        }

        if($data['action']=="save"){
            try {

                DB::table('asignacion_individual')->insert([
                        'id_user_tutor' =>$data['id_tutor'],
                        'id_user_alumno' =>$data['id_alumno'],
                        'fecha_created'=>$fecha_actual->format('Y-m-d h:i:s')
                    ]);

                } catch (\Exception $e) {
                    return json_encode(['status'=>400,'<i class="fas fa-exclamation-circle"></i> SE HA PERDIDO COMUNICACIÓN CON EL SERVIDOR'.$e->getMessage()]);
                }
            }

        $asignacionIndividuales= DB::table('asignacion_individual as asig')
        ->leftJoin('users as tutor', 'tutor.id', '=', 'asig.id_user_tutor')
        ->leftJoin('users as alumno', 'alumno.id', '=', 'asig.id_user_alumno')
        ->leftJoin('datos_alumnos AS dt_alumno', 'alumno.id', '=', 'dt_alumno.user_id_alumno')
        ->select('tutor.nombre as nombre_tutor','tutor.ap_paterno as paterno_tutor','alumno.nombre as nombre_alumno','alumno.ap_paterno as paterno_alumno','dt_alumno.matricula',
                 'asig.fecha_created','asig.id_asignacion_individual as idAsignacionIndividual','tutor.id as idTutor','alumno.id as idAlumno')
        ->get();

        return json_encode(['data'=>$asignacionIndividuales,'status'=>200,'info'=>"<i class='fas fa-database'></i> SE HA REGISTRADO CON EXITO LA ASIGNACION"]);
    }

    public function destroy($id){
        try {
            DB::table('asignacion_individual')->where('id_asignacion_individual', '=',$id)->delete();
        } catch (\Exception $e) {
            return json_encode(['status'=>400,'<i class="fas fa-exclamation-circle"></i> SE HA PERDIDO COMUNICACIÓN CON EL SERVIDOR'.$e->getMessage()]);
        }

        $asignacionIndividuales= DB::table('asignacion_individual as asig')
        ->leftJoin('users as tutor', 'tutor.id', '=', 'asig.id_user_tutor')
        ->leftJoin('users as alumno', 'alumno.id', '=', 'asig.id_user_alumno')
        ->leftJoin('datos_alumnos AS dt_alumno', 'alumno.id', '=', 'dt_alumno.user_id_alumno')
        ->select('tutor.nombre as nombre_tutor','tutor.ap_paterno as paterno_tutor','alumno.nombre as nombre_alumno','alumno.ap_paterno as paterno_alumno','dt_alumno.matricula',
                 'asig.fecha_created','asig.id_asignacion_individual as idAsignacionIndividual','tutor.id as idTutor','alumno.id as idAlumno')
            ->get();

        return json_encode(['data'=>$asignacionIndividuales,'status'=>200,'info'=>'<i class="fas fa-trash-alt"></i> SE HA ELIMIANDO CON EXITO LA ASIGNACION']);
    }

    public function tipoUsuarioData(Request $request){

        $data=$request->all();
        $userData=[];

        if($data['tipo_usuario']=="alumno"){

            $userData = DB::table('users')
            ->leftJoin('datos_alumnos', 'users.id', '=', 'datos_alumnos.user_id_alumno')
            ->leftJoin('carreras', 'datos_alumnos.carrera', '=', 'carreras.id_carrera')
            ->select('users.*','users.id as id_users','users.created_at as fecha_registro','datos_alumnos.*','carreras.*')
            ->where('tipo_usuario','=','alumno')
            ->where('users.id','=',$data['id_alumno'])
            ->get();

        }else if($data['tipo_usuario']=="tutor"){

             $userData = DB::table('users')
            ->leftJoin('datos_docentes', 'users.id', '=', 'datos_docentes.user_id_docente')
            ->select('users.*','users.id as id_users','datos_docentes.*')
            ->where('tipo_usuario','=','tutor')
            ->where('users.id','=',$data['id_tutor'])
            ->get();
        }

        return json_encode(['status'=>200,'data'=>$userData]);

    }

}
