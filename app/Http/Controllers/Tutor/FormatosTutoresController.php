<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FormatosTutoresController extends Controller
{


    public function index(){


        // dd($formatos_tutores);
        return view('tutor.formatos.index');
    }

    public function formatosIndex(Request $request){

        // $data=$request->all();
        $Formatos = DB::table('archivos')->where('tipo_archivo',1)->orderBy('fecha_created_archivo', 'desc')->get();

        $formatos_tutores=[];

        foreach ($Formatos as $key => $formato) {
            # code...
            $datos_json=json_decode($formato->datos_tipo_archivo,true);
            // 2 es tutor
            if($datos_json['archivo_dirigido']=="2"){
                $formatos_tutores[]=$formato;
            }

        }

        return json_encode(['status'=>200,'data'=>$formatos_tutores]);
    }

    public function downloadFormato($id){

        $datos_file=DB::table('archivos')->where('id_archivo','=',$id)->get();

        $name_file_original=json_decode($datos_file[0]->{'datos_tipo_archivo'},true);

        $pathToFile=storage_path()."/app/".$datos_file[0]->{'ruta_archivo'};
        return Storage::disk('public')->download($datos_file[0]->{'ruta_archivo'},$name_file_original['nombre_archivo']);

    }

}
