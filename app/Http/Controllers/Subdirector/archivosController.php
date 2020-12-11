<?php

namespace App\Http\Controllers\Subdirector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class archivosController extends Controller
{
    // reportes enviados por los tutores
    public function reportes_enviados(){
        $users_tutores = DB::table('users')
        ->where('tipo_usuario','=','tutor')
        ->get();
        return view('subDirector.indexReportes',compact('users_tutores'));
    }
    public function reportes_enviadosListar(Request $request){

        $data=$request->all();

        $Reportes=[];

        if($data['action']=="todos_reportes"){
            $Reportes = DB::table('archivos')->where('tipo_archivo',2)->orderBy('fecha_created_archivo', 'desc')->get();
        }
        else if($data['action']=="obtener_reportes_tutor_seleccionado"){
            $Reportes = DB::table('archivos')->where('tipo_archivo',2)
            ->where('archivos.id_user_upload','=',$data['id_tutor'])
            ->orderBy('fecha_created_archivo', 'desc')->get();
        }
        return json_encode(['status'=>200,'data'=>$Reportes]);
    }

    public function download_archivo($id){

        $datos_file=DB::table('archivos')->where('id_archivo','=',$id)->get();

        $name_file_original=json_decode($datos_file[0]->{'datos_tipo_archivo'},true);

        $pathToFile=storage_path()."/app/".$datos_file[0]->{'ruta_archivo'};
        return Storage::disk('public')->download($datos_file[0]->{'ruta_archivo'},$name_file_original['nombre_archivo']);

    }


    // formatos

    public function formatos_enviados(){

        return view('subDirector.indexFormatos');
    }

    public function formatos_enviadosListar(Request $request){
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
}
