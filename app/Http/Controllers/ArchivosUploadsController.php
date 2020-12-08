<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class ArchivosUploadsController extends Controller
{

    public function reportesIndex(Request $request){
        if($request->ajax()){

            $data=$request->all();
            $Formatos = DB::table('archivos')->where('tipo_archivo',2)->orderBy('fecha_created_archivo', 'desc')->get();

            return json_encode(['status'=>200,'data'=>$Formatos]);
        }

        return view('admin.Upload_Archivos.upload_reporte');
    }

    public function formatosIndex(Request $request){
        if($request->ajax()){

            $data=$request->all();
            $Formatos = DB::table('archivos')->where('tipo_archivo',1)->orderBy('fecha_created_archivo', 'desc')->get();

            return json_encode(['status'=>200,'data'=>$Formatos]);
        }
        return view('admin.Upload_Archivos.upload_formato');
    }

    public function DeleteArchivo(Request $request){

        $data=$request->all();
        // return json_encode(['status'=>400,'request'=>$data]);
        try {

            DB::beginTransaction();
            $status_multiples=false;

            if( isset($data['multiples']) ){

                $dataArchivos = DB::table('archivos')->whereIn('id_archivo',$data['id_archivo'])->get();
                $COUNT_REGISTRO=0;

                foreach ($dataArchivos as $key => $item) {
                    # code...
                    $datos[]=$item;
                    Storage::delete('public/'.$item->{'ruta_archivo'});
                    $COUNT_REGISTRO=$COUNT_REGISTRO+1;
                }
                DB::table('archivos')->whereIn('id_archivo',$data['id_archivo'])->delete();
                $msg_error="SE HAN ELIMINADO {$COUNT_REGISTRO} REGISTROS";
                $status_multiples=true;

            }else{
                $datos_file=DB::table('archivos')->where('id_archivo','=',$data['id_archivo'])->get();
                DB::table('archivos')->where('id_archivo','=',$datos_file[0]->{'id_archivo'})->delete();
                Storage::delete('public/'.$datos_file[0]->{'ruta_archivo'});
                $msg_error="SE HA ELIMINADO EL REGISTRO";
                $status_multiples=false;
            }


            DB::commit();
            return json_encode([
                'status'=>"200",
                'info'=>"<i class='fas fa-database'></i> {$msg_error}",
                'multiples'=>$status_multiples
            ]);


        } catch (\Exception $e) {

            return json_encode([
                'status'=>400,
                'info'=>'No se pudo realizar la eliminación del archivo.</br> Se perdio comunicación con el servidor.</br> Intentelo de nuevo'
                ]);
        }

    }

    public function download_archivo($id){

        $datos_file=DB::table('archivos')->where('id_archivo','=',$id)->get();

        $name_file_original=json_decode($datos_file[0]->{'datos_tipo_archivo'},true);

        $pathToFile=storage_path()."/app/".$datos_file[0]->{'ruta_archivo'};
        return Storage::disk('public')->download($datos_file[0]->{'ruta_archivo'},$name_file_original['nombre_archivo']);

    }


    public function SubirFormato(Request $request){

        $data=$request->all();

        if($request['id_archivo']!=""){
            $datos_file=DB::table('archivos')->where('id_archivo','=',$data['id_archivo'])->get();

            if(count($datos_file)<=0){
                return json_encode([
                        'status'=>400,
                        'count'=>count($datos_file),
                        'info'=>"<i class='fas fa-database'></i>. EL REGISTRO QUE INTENTAS ACTUALIZAR NO SE ENCUNETRA EN NUESTRA BASE DE DATOS.</br>COMUNIQUESE CON EL ADMINISTRADOR"]);
            }

            // return json_encode(['status'=>400,'info'=>'actualizar','ruta'=>$datos_file[0]->{'ruta_archivo'}]);

            if(isset($_FILES['archivo_file_input'])){
                try {
                    $file_permitido=false;
                    if($request->hasFile('archivo_file_input')){
                        $info=$this->Image_validar($_FILES);
                        $file_permitido=$info['validacion'];
                    }

                    if($file_permitido==true){
                        return json_encode([
                            'info'=>$info['info'],
                            'status'=>400,
                            'file_error'=>'error'
                        ]);
                    }

                } catch (\Exception $e) {
                    return json_encode([
                        'status'=>400,
                        'info'=>'No se pudo realizar la verificacion del archivo.</br> Se perdio comunicación con el servidor.</br> Intentelo de nuevo'
                        ]);
                }
            }

            $ruta_image_perfil="";

            try {
                DB::beginTransaction();

                if(isset($_FILES['archivo_file_input'])){
                    if($_FILES['archivo_file_input']!="undefined"||$_FILES['archivo_file_input']!=null){
                        Storage::delete('public/'.$datos_file[0]->{'ruta_archivo'});
                        if($request->hasFile('archivo_file_input')) {
                            $ruta_image_perfil =$request->file('archivo_file_input')->store('Archivos','public');
                         }
                    }
                }else{
                    $ruta_image_perfil=$datos_file[0]->{'ruta_archivo'};
                }

                $data_json=json_decode($datos_file[0]->{'datos_tipo_archivo'},true);

                // return json_encode(['status'=>400,'info'=>$data_json['nombre_archivo']]);
                $json_data_archivo=json_encode([
                                        'archivo_dirigido'=>$data['archivo_dirigido'],
                                        'nombre_archivo'=>isset($_FILES['archivo_file_input'])?$_FILES['archivo_file_input']['name']:$data_json['nombre_archivo'],
                                   ]);

                $FECHA_REGISTER=date('Y-m-d H:i:s');

                DB::table('archivos')
                ->where('id_archivo','=',$data['id_archivo'])
                ->update(
                    [
                     'titulo' =>$data['titulo'],
                     'descripcion' =>$data['descripcion'],
                     'ruta_archivo' => $ruta_image_perfil,
                     'datos_tipo_archivo' => $json_data_archivo ,//json
                     'tipo_archivo'=>1, // 1='formato',2='reporte'
                     'fecha_update_archivo'=>$FECHA_REGISTER
                    ]
                );

                DB::commit();
                return json_encode([
                    'status'=>"200",
                    'update_archivo'=>200,
                    'name_file'=>isset($_FILES['archivo_file_input'])?$_FILES['archivo_file_input']['name']:$data_json['nombre_archivo'],
                    'info'=>"<i class='fas fa-database'></i> ACTUALIZACIÓN SASTIFACTORIO"
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                Storage::delete('public/'.$ruta_image_perfil);
                return json_encode(['status'=>"400",'info'=>"Se produjo un problema de comunicación con el servidor Exeception_db: ".$e->getMessage()]);
            }

        }else{
            $data=$request->all();
            $file_permitido=false;
            if(!isset($_FILES['archivo_file_input'])){
                return json_encode(['status'=>400,'info'=>'<i class="fas fa-exclamation-triangle"></i> NO HAS SELECCIONADO EL ARCHIVO.']);
            }


            try {
                if($request->hasFile('archivo_file_input')){
                    $info=$this->Image_validar($_FILES);
                    $file_permitido=$info['validacion'];
                }

                if($file_permitido==true){
                    return json_encode(['info'=>$info['info'],'status'=>400,'file_error'=>'error' ]);
                }

            } catch (\Exception $e) {
                return json_encode([
                    'status'=>400,
                    'info'=>'No se pudo realizar la verificacion del archivo.</br> Se perdio comunicación con el servidor.</br> Intentelo de nuevo'
                    ]);
            }

            try {
                DB::beginTransaction();

                if(isset($data['archivo_file_input'])){
                    if($data['archivo_file_input']!="undefined"||$data['archivo_file_input']!=null){
                        if($request->hasFile('archivo_file_input')) {
                            $ruta_image_perfil =$request->file('archivo_file_input')->store('Archivos','public');
                         }
                    }
                }

                $json_data_archivo=json_encode([
                                    'archivo_dirigido'=>$data['archivo_dirigido'],
                                    'nombre_archivo'=>$_FILES['archivo_file_input']['name']
                                   ]);

                $FECHA_REGISTER=date('Y-m-d H:i:s');



                DB::table('archivos')->insert(
                    [
                     'titulo' =>$data['titulo'],
                     'descripcion' =>$data['descripcion'],
                     'ruta_archivo' => $ruta_image_perfil,
                     'datos_tipo_archivo' => $json_data_archivo ,//json
                     'tipo_archivo'=>1, // 1='formato',2='reporte'
                     'fecha_created_archivo'=>$FECHA_REGISTER
                    ]
                );

                DB::commit();
                return json_encode(['status'=>"200",'info'=>"<i class='fas fa-database'></i> REGISTRO SASTIFACTORIO"]);

            } catch (\Exception $e) {
                DB::rollBack();
                Storage::delete('public/'.$ruta_image_perfil);
                return json_encode(['status'=>"400",'info'=>"Se produjo un problema de comunicación con el servidor Exeception_db: ".$e->getMessage()]);
            }

        }

    }

    public function SubirReporte(Request $request){
        //  return json_encode(['files'=>$_FILES,'$request'=>$request->all(),'file'=>$_FILES['archivo_file_input']]);

        $data=$request->all();

        if($request['id_archivo']!=""){
            $datos_file=DB::table('archivos')->where('id_archivo','=',$data['id_archivo'])->get();

            if(count($datos_file)<=0){
                return json_encode([
                        'status'=>400,
                        'count'=>count($datos_file),
                        'info'=>"<i class='fas fa-database'></i>. EL REGISTRO QUE INTENTAS ACTUALIZAR NO SE ENCUNETRA EN NUESTRA BASE DE DATOS.</br>COMUNIQUESE CON EL ADMINISTRADOR"]);
            }

            // return json_encode(['status'=>400,'info'=>'actualizar','ruta'=>$datos_file[0]->{'ruta_archivo'},'file'=>$_FILES['archivo_file_input']]);

            if(isset($_FILES['archivo_file_input'])){
                try {
                    $file_permitido=false;
                    if($request->hasFile('archivo_file_input')){
                        $info=$this->Image_validar($_FILES);
                        $file_permitido=$info['validacion'];
                    }

                    if($file_permitido==true){
                        return json_encode([
                            'info'=>$info['info'],
                            'status'=>400,
                            'file_error'=>'error'
                        ]);
                    }

                } catch (\Exception $e) {
                    return json_encode([
                        'status'=>400,
                        'info'=>'No se pudo realizar la verificacion del archivo.</br> Se perdio comunicación con el servidor.</br> Intentelo de nuevo'
                        ]);
                }
            }

            $ruta_image_perfil="";

            try {
                DB::beginTransaction();

                if(isset($_FILES['archivo_file_input'])){
                    if($_FILES['archivo_file_input']!="undefined"||$_FILES['archivo_file_input']!=null){
                        Storage::delete('public/'.$datos_file[0]->{'ruta_archivo'});
                        if($request->hasFile('archivo_file_input')) {
                            $ruta_image_perfil =$request->file('archivo_file_input')->store('Archivos','public');
                         }
                    }
                }else{
                    $ruta_image_perfil=$datos_file[0]->{'ruta_archivo'};
                }

                $data_json=json_decode($datos_file[0]->{'datos_tipo_archivo'},true);

                // return json_encode(['status'=>400,'info'=>$data_json['nombre_archivo']]);
                $json_data_archivo=json_encode([
                                        'semestre'=>$data['semestre'],
                                        'carrera'=>$data['carrera_escolar'],
                                        'periodo'=>$data['periodo_escolar'],
                                        'turno'=>$data['turno_escolar'],
                                        'grupo'=>$data['grupo_escolar'],
                                        'nombre_archivo'=>isset($_FILES['archivo_file_input'])?$_FILES['archivo_file_input']['name']:$data_json['nombre_archivo'],
                                   ]);

                $FECHA_REGISTER=date('Y-m-d H:i:s');

                DB::table('archivos')
                ->where('id_archivo','=',$data['id_archivo'])
                ->update(
                    [
                     'titulo' =>$data['titulo'],
                     'descripcion' =>$data['descripcion'],
                     'ruta_archivo' => $ruta_image_perfil,
                     'datos_tipo_archivo' => $json_data_archivo ,//json
                     'tipo_archivo'=>2, // 1='formato',2='reporte'
                     'fecha_update_archivo'=>$FECHA_REGISTER
                    ]
                );

                DB::commit();
                return json_encode([
                    'status'=>"200",
                    'update_archivo'=>200,
                    'name_file'=>isset($_FILES['archivo_file_input'])?$_FILES['archivo_file_input']['name']:$data_json['nombre_archivo'],
                    'info'=>"<i class='fas fa-database'></i> ACTUALIZACIÓN SASTIFACTORIO"
                    ]);

            } catch (\Exception $e) {
                DB::rollBack();
                Storage::delete('public/'.$ruta_image_perfil);
                return json_encode(['status'=>"400",'info'=>"Se produjo un problema de comunicación con el servidor Exeception_db: ".$e->getMessage()]);

            }

        }else{

            if(!isset($_FILES['archivo_file_input'])){
                return json_encode(['status'=>400,'info'=>'<i class="fas fa-exclamation-triangle"></i> NO HAS SELECCIONADO EL ARCHIVO.']);
            }

            try {
                $file_permitido=false;
                if($request->hasFile('archivo_file_input')){
                    $info=$this->Image_validar($_FILES);
                    $file_permitido=$info['validacion'];
                }

                if($file_permitido==true){
                    return json_encode(['info'=>$info['info'],'status'=>400,'file_error'=>'error' ]);
                }

            } catch (\Exception $e) {
                return json_encode([
                    'status'=>400,
                    'info'=>'No se pudo realizar la verificacion del archivo.</br> Se perdio comunicación con el servidor.</br> Intentelo de nuevo'
                    ]);
            }
            $ruta_image_perfil="";
            try {
                DB::beginTransaction();

                if(isset($data['archivo_file_input'])){
                    if($data['archivo_file_input']!="undefined"||$data['archivo_file_input']!=null){
                        if($request->hasFile('archivo_file_input')) {
                            $ruta_image_perfil =$request->file('archivo_file_input')->store('Archivos','public');
                         }
                    }
                }

                $json_data_archivo=json_encode([
                                        'semestre'=>$data['semestre'],
                                        'carrera'=>$data['carrera_escolar'],
                                        'periodo'=>$data['periodo_escolar'],
                                        'turno'=>$data['turno_escolar'],
                                        'grupo'=>$data['grupo_escolar'],
                                        'nombre_archivo'=>$_FILES['archivo_file_input']['name'],
                                   ]);

                $FECHA_REGISTER=date('Y-m-d H:i:s');

                DB::table('archivos')->insert(
                    [
                     'titulo' =>$data['titulo'],
                     'descripcion' =>$data['descripcion'],
                     'ruta_archivo' => $ruta_image_perfil,
                     'datos_tipo_archivo' => $json_data_archivo ,//json
                     'tipo_archivo'=>2, // 1='formato',2='reporte'
                     'fecha_created_archivo'=>$FECHA_REGISTER
                    ]
                );

                DB::commit();
                return json_encode([
                    'status'=>"200",
                    'storage_archivo'=>200,
                    'info'=>"<i class='fas fa-database'></i> REGISTRO SASTIFACTORIO"]);

            } catch (\Exception $e) {
                DB::rollBack();
                Storage::delete('public/'.$ruta_image_perfil);
                return json_encode(['status'=>"400",'info'=>"Se produjo un problema de comunicación con el servidor Exeception_db: ".$e->getMessage()]);

            }
        }

    }


    public static function Image_validar($FILES){
        $validator=false;
        $arreglo=[];
        $peso_permitido=10;
        $peso_permitido_calculado=$peso_permitido*1048576;

        foreach ($FILES as $key => $file) {
            // # code...;
                $formato_image_ERROR='';
                $peso_image_ERROR='';
                $msg_erro_archivo="";
                $validator=false;

                $formatos_permitidos =  array('xlsx','xls','pdf','docx','doc');
                $archivo= $file['name'];
                $peso_byte=$file['size'];
                $extension =strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

                if($formatos_permitidos!=""&&$archivo!=""&&$peso_byte!=""){
                    if(!in_array($extension, $formatos_permitidos) ) {
                        $formato_image_ERROR='</br> Formato no permitido: '.strtoupper($extension);
                    }

                    if($peso_byte>$peso_permitido_calculado){
                        $peso_image_ERROR="</br> Peso Permitido: {$peso_permitido} MB, Peso Actual ".number_format(($peso_byte/1048576),2).'MB';
                    }

                    if($formato_image_ERROR!=""||$peso_image_ERROR!=""){

                        $formato_image_ERROR=$formato_image_ERROR!=""?$formato_image_ERROR:'';
                        $peso_image_ERROR=$peso_image_ERROR!=""?$peso_image_ERROR:'';

                        $msg_erro_archivo="Nombre del archivo: {$file['name']} {$formato_image_ERROR} {$peso_image_ERROR}";
                        $validator=true;
                    }

                }
           }

            return ['info'=>$msg_erro_archivo,'validacion'=>$validator];
    }



}
