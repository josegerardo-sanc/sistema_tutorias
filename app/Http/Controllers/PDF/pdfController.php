<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade as PDF;



class pdfController extends Controller
{


    public function pruebas_pdf(){

            $SEMESTRE=isset($data['filtro_semestre_escolar'])?$data['filtro_semestre_escolar']:"";
            $CARRERA=isset($data['filtro_carrera_escolar'])?$data['filtro_carrera_escolar']:"";
            $PERIODO=isset($data['filtro_periodo_escolar'])?$data['filtro_periodo_escolar']:"";
            $TURNO=isset($data['filtro_turno_escolar'])?$data['filtro_turno_escolar']:"";
            $GRUPO=isset($data['filtro_grupo_escolar'])?$data['filtro_grupo_escolar']:"";
            $MATRICULA=isset($data['filtro_matricula_escolar'])?$data['filtro_matricula_escolar']:"";

            $WHERE="";


            if($SEMESTRE!=""){
                $WHERE.=" AND datos_alumnos.semestre=".$SEMESTRE;
            }
            if($CARRERA!=""){
                $WHERE.="  AND datos_alumnos.carrera='$CARRERA'";
            }
            // if($PERIODO!=""){
            //     $WHERE.="  AND datos_alumnos.periodo='$PERIODO'";
            // }
            if($TURNO!=""){
                $WHERE.="  AND datos_alumnos.turno=".$TURNO;
            }
            // if($GRUPO!=""){
            //     $WHERE.="  AND datos_alumnos.grupo='$GRUPO'";
            // }
            if($MATRICULA!=""){
                $WHERE.=" OR datos_alumnos.matricula='$MATRICULA'";
            }

            $SQL=" select users.*,datos_alumnos.*,carreras.carrera as name_carrera from users
            LEFT JOIN datos_alumnos ON users.id=datos_alumnos.user_id_alumno
            LEFT JOIN carreras ON datos_alumnos.carrera=carreras.id_carrera
            WHERE users.tipo_usuario='alumno'
            $WHERE";

            $users = DB::select("
               $SQL
            ");

            // dd($users);

           return view('PDF.alumno',compact('users'));



        // pdf para el tutor

        $users=DB::table('users')
        ->leftJoin('asignacion','users.id','=','asignacion.user_id_asignado')
        ->leftJoin('carreras','carreras.id_carrera','=','asignacion.carrera')
        ->select('users.*','asignacion.*','carreras.carrera as name_carrera')
        ->where('users.tipo_usuario','=','tutor')->get();

        foreach ($users as $key => $user) {
            $total_horas=0;
            $html_horario="";


                $horario=json_decode($user->{'horario'},true);
                    // print_r($horario['jueves_hora']);
                $total_horas=abs($horario['lunes_hora'])+abs($horario['martes_hora'])+abs($horario['miercoles_hora'])+abs($horario['jueves_hora'])+abs($horario['viernes_hora']);


                $users[$key]->{'lunes_hora'}=$horario['lunes_hora'];

                $users[$key]->{'martes_hora'}=$horario['martes_hora'];

                $users[$key]->{'miercoles_hora'}=$horario['miercoles_hora'];

                $users[$key]->{'jueves_hora'}=$horario['jueves_hora'];

                $users[$key]->{'viernes_hora'}=$horario['viernes_hora'];

                $asignacion_horas=1;
                if($horario['lunes_hora']==0&&$horario['martes_hora']==0&&$horario['miercoles_hora']==0&&$horario['jueves_hora']==0&&$horario['viernes_hora']==0){
                    $asignacion_horas=0;
                }

                $users[$key]->{'asignacion_horas'}=$asignacion_horas;
                $users[$key]->{'total_horas'}=$total_horas;
        }


        // dd($users);
        return view('PDF.tutor',compact('users'));

    }


    public function usuarios(Request $request){


        $data=$request->all();

        $tipo_usuario=$request->get('usuario');

        // $carrera=$request->get('filtro_carrera_escolar');
        // $matricula=$request->get('filtro_matricula_escolar');
        // $semestrer=$request->get('filtro_semestre_escolar');
        // $turno=$request->get('filtro_turno_escolar');

        // return json_encode([
        //     'status'=>400,'data'=>$data,
        //     'usuario'=>$tipo_usuario,
        //     'carrera'=>$carrera

        // ]);

        switch ($tipo_usuario) {
            case 'tutor':

                $carrera=$request->get('filtro_carrera_escolar');

                    if($carrera!=null){
                        $users=DB::table('users')
                        ->leftJoin('asignacion','users.id','=','asignacion.user_id_asignado')
                        ->leftJoin('carreras','carreras.id_carrera','=','asignacion.carrera')
                        ->select('users.*','asignacion.*','carreras.carrera as name_carrera')
                        ->where('users.tipo_usuario','=','tutor')
                        ->where('carreras.id_carrera',$carrera)
                        ->get();
                    }else{
                        $users=DB::table('users')
                        ->leftJoin('asignacion','users.id','=','asignacion.user_id_asignado')
                        ->leftJoin('carreras','carreras.id_carrera','=','asignacion.carrera')
                        ->select('users.*','asignacion.*','carreras.carrera as name_carrera')
                        ->where('users.tipo_usuario','=','tutor')
                        ->get();
                    }



                    foreach ($users as $key => $user) {
                        $total_horas=0;
                        $html_horario="";


                            $horario=json_decode($user->{'horario'},true);
                            // print_r($horario['jueves_hora']);
                            $total_horas=abs($horario['lunes_hora'])+abs($horario['martes_hora'])+abs($horario['miercoles_hora'])+abs($horario['jueves_hora'])+abs($horario['viernes_hora']);

                            $users[$key]->{'lunes_hora'}=$horario['lunes_hora'];

                            $users[$key]->{'martes_hora'}=$horario['martes_hora'];

                            $users[$key]->{'miercoles_hora'}=$horario['miercoles_hora'];

                            $users[$key]->{'jueves_hora'}=$horario['jueves_hora'];

                            $users[$key]->{'viernes_hora'}=$horario['viernes_hora'];

                            $asignacion_horas=1;
                            if($horario['lunes_hora']==0&&$horario['martes_hora']==0&&$horario['miercoles_hora']==0&&$horario['jueves_hora']==0&&$horario['viernes_hora']==0){
                                $asignacion_horas=0;
                            }

                            $users[$key]->{'asignacion_horas'}=$asignacion_horas;
                            $users[$key]->{'total_horas'}=$total_horas;
                    }

                    $pdf= PDF::loadView('PDF.tutor',compact('users'))->setPaper('a4', 'landscape');

                break;
            case 'alumno':

                $SEMESTRE=isset($data['filtro_semestre_escolar'])?$data['filtro_semestre_escolar']:"";
                $CARRERA=isset($data['filtro_carrera_escolar'])?$data['filtro_carrera_escolar']:"";
                $PERIODO=isset($data['filtro_periodo_escolar'])?$data['filtro_periodo_escolar']:"";
                $TURNO=isset($data['filtro_turno_escolar'])?$data['filtro_turno_escolar']:"";
                $GRUPO=isset($data['filtro_grupo_escolar'])?$data['filtro_grupo_escolar']:"";
                $MATRICULA=isset($data['filtro_matricula_escolar'])?$data['filtro_matricula_escolar']:"";

                $WHERE="";


                if($SEMESTRE!=""){
                    $WHERE.=" AND datos_alumnos.semestre=".$SEMESTRE;
                }
                if($CARRERA!=""){
                    $WHERE.="  AND datos_alumnos.carrera='$CARRERA'";
                }
                // if($PERIODO!=""){
                //     $WHERE.="  AND datos_alumnos.periodo='$PERIODO'";
                // }
                if($TURNO!=""){
                    $WHERE.="  AND datos_alumnos.turno=".$TURNO;
                }
                // if($GRUPO!=""){
                //     $WHERE.="  AND datos_alumnos.grupo='$GRUPO'";
                // }
                if($MATRICULA!=""){
                    $WHERE.=" AND datos_alumnos.matricula='$MATRICULA'";
                }

                $SQL=" select users.*,datos_alumnos.*,carreras.carrera as name_carrera from users
                LEFT JOIN datos_alumnos ON users.id=datos_alumnos.user_id_alumno
                LEFT JOIN carreras ON datos_alumnos.carrera=carreras.id_carrera
                WHERE users.tipo_usuario='alumno'
                $WHERE";

                $users = DB::select("
                   $SQL
                ");

                $pdf= PDF::loadView('PDF.alumno',compact('users'))->setPaper('a4', 'landscape');
                break;
            case 'director':
                $users=DB::table('users')->where('tipo_usuario','=',"director")->get();
                $pdf= PDF::loadView('PDF.usuarios',compact('users'));
                break;
            case 'subdirector':
                $users=DB::table('users')->where('tipo_usuario','=',"subdirector")->get();
                $pdf= PDF::loadView('PDF.usuarios',compact('users'));
                break;
            case 'administrador':
                $users=DB::table('users')->where('tipo_usuario','=',"administrador")->get();
                $pdf= PDF::loadView('PDF.usuarios',compact('users'));
                break;
            default:
                $users=DB::table('users')->get();
                $pdf= PDF::loadView('PDF.usuarios',compact('users'));
                # code...
                break;
        }

        // https://www.nicesnippets.com/blog/laravel-8-pdf-file-download-using-jquery-ajax-request-example
        // https://styde.net/genera-pdfs-en-laravel-con-el-componente-dompdf/
        // return view('PDF.usuarios',compact('users'));


        $path = public_path('pdf/');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);


        return response()->download($pdf);

        return json_encode(['status'=>400,'info'=>'descargar pdf']);


    }


    public function modif_env(){


        $valor=\Config::get('mail.from.address');

        $searchArray =[
            'MAIL_HOST='.\Config::get('mail.host'),
            'MAIL_PORT='.\Config::get('mail.port'),
            'MAIL_FROM_ADDRESS='.\Config::get('mail.from.address'),
            'MAIL_FROM_NAME='.\Config::get('mail.from.name'),
            'MAIL_USERNAME='.\Config::get('mail.username'),
            'MAIL_PASSWORD='.\Config::get('mail.password'),
            'MAIL_ENCRYPTION='.\Config::get('mail.encryption')
           ];

        dd($searchArray);
    }


    public function evaluacion(Request $request){

        $id_cuestionario=$request->get('id_cuestionario');

        // $id_cuestionario=8;
        
        $preguntas = DB::table('preguntas')->get();

        $cuestionario=DB::table('cuestionario')
        ->leftJoin('carreras','carreras.id_carrera','=','cuestionario.carrera')
        ->leftJoin('users','users.id','=','cuestionario.id_user_alumno')
        ->leftJoin('datos_alumnos','datos_alumnos.user_id_alumno','=','cuestionario.id_user_alumno')
        ->where('id_cuestionario','=',$id_cuestionario)
        ->select('users.nombre','users.ap_paterno','users.ap_materno', 'datos_alumnos.matricula', 
                'carreras.carrera','cuestionario.semestre','cuestionario.turno','cuestionario.grupo',
                'cuestionario.respuestas_cuestionario','cuestionario.observacion')
        ->get();


        
        // return view('PDF.evaluacion',compact('preguntas','cuestionario'));

        $pdf= PDF::loadView('PDF.evaluacion',compact('preguntas','cuestionario'))->setPaper('a4', 'landscape');

        $path = public_path('pdf/');
        $fileName =  time().'evaluaciones.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);
        $pdf = public_path('pdf/'.$fileName);

        return response()->download($pdf);

        
    }

}
