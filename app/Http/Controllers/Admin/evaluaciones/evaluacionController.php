<?php

namespace App\Http\Controllers\Admin\evaluaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;


class evaluacionController extends Controller
{

    public function index(Request $request){

        if($request->ajax()){
            $cuestionario=[];
            $arreglo_respuesta2=[];
            $carrera_selecionada="";
            $SQL="";
            $preguntas=DB::table('preguntas')->get();


            $periodo="";
            $mostrar_datos_bsuqueda=false;
            $carrera_selecionada="";

            $data=$request->all();

            $tipoEvaluacion=isset($data['tipo_evaluacion'])?$data['tipo_evaluacion']:"grupal";


             if(isset($data['busquedaPersonalizada'])){
                    $mostrar_datos_bsuqueda=true;
                    $WHERE="";

                   $dataCarrera=DB::table('carreras')->where('id_carrera','=',$data['id_carrera'])->get();

                   if($data['id_carrera']!=0){
                       $WHERE.=" AND ca.id_carrera=".$data['id_carrera'];

                       if(count($dataCarrera)>0){
                           $carrera_selecionada=$dataCarrera[0]->{'carrera'};
                        }else{
                            $carrera_selecionada="No se encontraron carreras registradas";
                        }
                    }


                    if($data['fecha']!="" && $data['fecha']!="undefined"){


                        $fecha=date("Y-m-d", strtotime($data["fecha"]));
                        $fecha_explode=explode("-",$fecha);


                        // $mes_inicio="";
                        // $mes_final="";

                        if(abs($fecha_explode['1'])>=8){
                            $periodo="Agosto-Diciembre {$fecha_explode[0]}";
                            $mes_inicio="08";
                            $mes_final="12";

                        }else{
                            $periodo="Febrero-Julio {$fecha_explode[0]}";
                            $mes_inicio="01";
                            $mes_final="07";
                        }
                                                                          //  "mes"             "año"
                        $cantidadDias = cal_days_in_month(CAL_GREGORIAN, $fecha_explode[1], $fecha_explode[0]);

                        $fecha_inicio="{$fecha_explode[0]}-{$mes_inicio}-01 00:00:00";
                        $fecha_final="{$fecha_explode[0]}-{$mes_final}-{$cantidadDias} 23:59:59";


                        $WHERE.=" AND cuest.fecha_created_cuestionario BETWEEN '{$fecha_inicio}' AND '{$fecha_final}' ";
                    }

                    if(count($dataCarrera)>0){
                        $SQL="SELECT * FROM carreras AS ca
                        INNER JOIN datos_alumnos AS dtalumno ON ca.id_carrera=dtalumno.carrera
                        INNER JOIN cuestionario AS cuest ON dtalumno.user_id_alumno=cuest.id_user_alumno
                        WHERE cuest.tipo_cuestionario='$tipoEvaluacion' $WHERE";

                    }else{

                        $SQL="SELECT * FROM datos_alumnos AS dtalumno
                        INNER JOIN cuestionario AS cuest ON dtalumno.user_id_alumno=cuest.id_user_alumno
                        WHERE cuest.tipo_cuestionario='$tipoEvaluacion' $WHERE";
                    }

                    $cuestionario = DB::select("$SQL");


                }else{
                    $cuestionario=DB::table('cuestionario')
                    ->where('tipo_cuestionario','=',$tipoEvaluacion)
                    ->get();
                }

                // return json_encode(['status'=>400,'sql'=>$SQL,'info'=>'probando...','where'=>$WHERE]);


                if(count($cuestionario)>0){
                        $total_respuestas=count($cuestionario)*15;
                            $total_registros_respuestas=count($cuestionario);

                            $arreglo_respuestas=[
                                            'count_siempre'=>0,'count_casi_siempre'=>0,'count_a_veces'=>0,'count_nunca'=>0,
                                            'porcentaje_siempre'=>0,'porcentaje_casi_siempre'=>0,'porcentaje_a_veces'=>0,'porcentaje_nunca'=>0
                                            ];


                            foreach ($cuestionario as $index_item => $item) {
                                $respuestas_cuestionario=json_decode($item->{'respuestas_cuestionario'},true);

                                // echo "<pre>";
                                // print_r($respuestas_cuestionario);

                                //  iterando las respuestas
                                foreach ($respuestas_cuestionario as $key => $respuesta) {

                                        // respuestas mas selecionadas
                                        if($respuesta['respuesta']=="siempre"){
                                            $arreglo_respuestas['count_siempre']=$arreglo_respuestas['count_siempre']+1;
                                        }
                                        if($respuesta['respuesta']=="casi_siempre"){
                                            $arreglo_respuestas['count_casi_siempre']=$arreglo_respuestas['count_casi_siempre']+1;
                                        }
                                        if($respuesta['respuesta']=="a_veces"){
                                            $arreglo_respuestas['count_a_veces']=$arreglo_respuestas['count_a_veces']+1;
                                        }
                                        if($respuesta['respuesta']=="nunca"){
                                            $arreglo_respuestas['count_nunca']=$arreglo_respuestas['count_nunca']+1;
                                        }


                                        foreach ($preguntas as $key => $pregunta_db) {
                                            # code...
                                                if($pregunta_db->{'id_pregunta'}==$respuesta['id_pregunta']){

                                                    $count_siempre=0;
                                                    $count_casi_siempre=0;
                                                    $count_a_veces=0;
                                                    $count_nunca=0;

                                                    if($respuesta['respuesta']=="siempre"){
                                                        $count_siempre=1;
                                                    }
                                                    if($respuesta['respuesta']=="casi_siempre"){
                                                        $count_casi_siempre=1;
                                                    }
                                                    if($respuesta['respuesta']=="a_veces"){
                                                        $count_a_veces=1;
                                                    }
                                                    if($respuesta['respuesta']=="nunca"){
                                                        $count_nunca=1;
                                                    }

                                                    $preguntas[$key]->{'count_siempre'}=isset($preguntas[$key]->{'count_siempre'})?$preguntas[$key]->{'count_siempre'}+$count_siempre:$count_siempre;
                                                    $preguntas[$key]->{'count_casi_siempre'}=isset($preguntas[$key]->{'count_casi_siempre'})?$preguntas[$key]->{'count_casi_siempre'}+$count_casi_siempre:$count_casi_siempre;
                                                    $preguntas[$key]->{'count_a_veces'}=isset($preguntas[$key]->{'count_a_veces'})?$preguntas[$key]->{'count_a_veces'}+$count_a_veces:$count_a_veces;
                                                    $preguntas[$key]->{'count_nunca'}=isset($preguntas[$key]->{'count_nunca'})?$preguntas[$key]->{'count_nunca'}+$count_nunca:$count_nunca;

                                                }

                                        }

                                }

                            }

                            // dd($preguntas);
                            foreach ($preguntas as $key => $item) {
                                # code...
                                $preguntas[$key]->{'pregunta_porc_siempre'}=round(($preguntas[$key]->{'count_siempre'}/$total_registros_respuestas)*100);
                                $preguntas[$key]->{'pregunta_porc_casi_siempre'}=round(($preguntas[$key]->{'count_casi_siempre'}/$total_registros_respuestas)*100);
                                $preguntas[$key]->{'pregunta_porc_a_veces'}=round(($preguntas[$key]->{'count_a_veces'}/$total_registros_respuestas)*100);
                                $preguntas[$key]->{'pregunta_porc_nunca'}=round(($preguntas[$key]->{'count_nunca'}/$total_registros_respuestas)*100);

                            }
                            // dd($preguntas[0]->{'pregunta_porc_siempre'});
                            $arreglo_respuestas['porcentaje_siempre']=round(($arreglo_respuestas['count_siempre']/$total_respuestas)*100);
                            $arreglo_respuestas['porcentaje_casi_siempre']=round(($arreglo_respuestas['count_casi_siempre']/$total_respuestas)*100);
                            $arreglo_respuestas['porcentaje_a_veces']=round(($arreglo_respuestas['count_a_veces']/$total_respuestas)*100);
                            $arreglo_respuestas['porcentaje_nunca']=round(($arreglo_respuestas['count_nunca']/$total_respuestas)*100);

                            $arreglo_respuesta2[]=$arreglo_respuestas;

                }else{

                    $preguntas=[];
                    $arreglo_respuesta2=[];
                }

               return json_encode(['status'=>200,'preguntas'=>$preguntas,'respuestasFrecuentes'=>$arreglo_respuesta2,
                //,'sql'=>$SQL,
                 'periodo'=>$periodo,
                 'mostrarDatosBuqueda'=>$mostrar_datos_bsuqueda,
                 'carrera'=>$carrera_selecionada
               ]);

        }
        //  dd($arreglo_respuestas);
        // dd($cuestionario);
        return view('admin.evaluacion.index');

    }

    public function seguimientoActividadTutorial(Request $request){
        // $data=$request->all();
        return view('admin.evaluacion.evaluacion_spicologa');

    }

    public function seguimientoActividadTutorialStore(Request $request){

        $data=$request->all();

        $idTutor=isset($data['idtutor'])?$data['idtutor']:0;
        $idCarrera=isset($data['idcarrera'])?$data['idcarrera']:0;
        $fecha=isset($data['fechaEvaluacion'])?$data['fechaEvaluacion']:"";

        $msg="";
        $exclamation='<i class="fas fa-exclamation-circle"></i>';

        if($idTutor<=0||$idTutor=="undefined"){
            $msg.="<li>{$exclamation} Selecciona un tutor</li>";
        }

        if($idCarrera<=0||$idTutor=="undefined"){
            $msg.="<li>{$exclamation} Selecciona una carrera</li>";
        }

        if($fecha==""||$fecha=="undefined"){
            $msg.="<li>{$exclamation} Selecione la fecha</li>";
        }
        if($msg!=""){
            return json_encode(['status'=>400,'info'=>$msg]);
        }


        $fecha=date("Y-m-d", strtotime($data["fechaEvaluacion"]));
        $fecha_explode=explode("-",$fecha);
        $periodo="";
        if(abs($fecha_explode['1'])>=8){
            $periodo="Agosto-Diciembre";
            $mes_inicio="08";
            $mes_final="12";
        }else{
            $periodo="Febrero-Julio";
            $mes_inicio="01";
            $mes_final="07";
        }


        $count_evaluacion = DB::table('evaluacion_tutor_spicologa')
            ->whereYear('fecha_evaluacion',$fecha_explode[0])
            ->where('id_carrera','=',$idCarrera)
            ->where('id_user','=',$idTutor)
            ->where('periodo','=',$periodo)
            ->count();

        if($count_evaluacion>=1){
            return json_encode(['status'=>400,'countAsignacion'=>$count_evaluacion,'info'=>"{$exclamation} El tutor ya fue evaluado en el periodo {$periodo} {$fecha_explode[0]}"]);
        }

        $respuestasEvaluacion=json_encode($data['respuestasEvaluacion']);
        $FECHA_REGISTER=date('Y-m-d H:i:s');

        try {

            DB::table('evaluacion_tutor_spicologa')
            ->insert([
                'respuestas_evaluacion'=>$respuestasEvaluacion,
                'fecha_evaluacion'=>$FECHA_REGISTER,
                'id_user'=>$idTutor,
                'id_carrera'=>$idCarrera,
                'periodo'=>$periodo
            ]);

           return json_encode(['info'=>'Registro exitoso','status'=>200]);

        } catch (\Throwable $th) {
            return json_encode(['data'=>[],'status'=>400,'info'=>'Intentelo de nuevo, error al registrar asignación']);

        }

    }

    public function obtenerlistaSegumiento(Request $request){

        $data=$request->all();
        $msg="";
        $exclamation='<i class="fas fa-exclamation-circle"></i>';

        $idTutor=isset($data['idtutor'])?$data['idtutor']:0;
        $idCarrera=isset($data['idcarrera'])?$data['idcarrera']:0;
        $fecha=isset($data['fechaEvaluacion'])?$data['fechaEvaluacion']:"";

        if($idTutor<=0||$idTutor=="undefined"){
            $msg.="<li>{$exclamation} Selecciona un tutor</li>";
        }

        if($idCarrera<=0||$idTutor=="undefined"){
            $msg.="<li>{$exclamation} Selecciona una carrera</li>";
        }

        if($msg!=""){
            return json_encode(['status'=>400,'info'=>$msg]);
        }


        $datos=[];

        if($fecha!=""&&$fecha!="undefined"){
            $fecha=date("Y-m-d", strtotime($data["fechaEvaluacion"]));
            $fecha_explode=explode("-",$fecha);

            $periodo="";
            if(abs($fecha_explode['1'])>=8){
                $periodo="Agosto-Diciembre";
                // $mes_inicio="08";
                // $mes_final="12";
            }else{
                $periodo="Febrero-Julio";
                // $mes_inicio="01";
                // $mes_final="07";
            }

            $datos = DB::table('evaluacion_tutor_spicologa')
                        ->whereYear('fecha_evaluacion',$fecha_explode[0])
                        ->where('id_carrera','=',$idCarrera)
                        ->where('id_user','=',$idTutor)
                        ->where('periodo','=',$periodo)
                        ->orderBy('id_evaluacion', 'desc')
                        ->get();
            return json_encode(['status'=>200,'info'=>'un solo registro','data'=>$datos]);
        }else{
            $datos = DB::table('evaluacion_tutor_spicologa')
                    ->where('id_carrera','=',$idCarrera)
                    ->where('id_user','=',$idTutor)
                    ->orderBy('id_evaluacion', 'desc')
                    ->get();
            return json_encode(['status'=>200,'info'=>'todos los registros','data'=>$datos]);
        }

    }

}
