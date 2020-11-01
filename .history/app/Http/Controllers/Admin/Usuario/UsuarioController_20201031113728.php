<?php

namespace App\Http\Controllers\Admin\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UsuarioController extends Controller
{


    public function index(Request $request){

      if($request->ajax()){

        $data=$request->all();

        //token=$request['_token'];


        $tipo_usuario=$data['tipo_user'];

        if($tipo_usuario=="alumno"){

            $SEMESTRE=$data['filtro_semestre_escolar'];
            $CARRERA=$data['filtro_carrera_escolar'];
            $PERIODO=$data['filtro_periodo_escolar'];
            $TURNO=$data['filtro_turno_escolar'];
            $GRUPO=$data['filtro_grupo_escolar'];
            $MATRICULA=$data['filtro_matricula_escolar'];

            $WHERE="";
          
           
            if($SEMESTRE!=""){
                
            }
            $users = DB::select('select * from users where active = ?');
            // $users = DB::table('users')
            // ->join('datos_alumnos', 'users.id', '=', 'datos_alumnos.user_id_alumno')
            // ->where('users.tipo_usuario', '=','alumno')
            // ->where('datos_alumnos.semestre', '=',$SEMESTRE)
            // ->where('datos_alumnos.carrera', '=',$CARRERA)
            // ->where('datos_alumnos.periodo', '=',$PERIODO)
            // ->where('datos_alumnos.turno', '=',$TURNO)
            // ->where('datos_alumnos.grupo', '=',$GRUPO)
            // ->where('datos_alumnos.matricula', '=',$MATRICULA)
            // ->orderBy('users.id','desc')->get();

        

        }
        if($tipo_usuario!="alumno"&& $tipo_usuario!="administrador"){



        }
        if($tipo_usuario=="administrador"){

        }



        return json_encode(['data'=>$users,'status'=>400]);
      }
    $users = DB::table('users')
    ->orderBy('id','desc')->limit(100)->get();
    // return json_encode(['data'=>$users]);
    return view('Admin.usuario.index',compact('users'));

    }


    public function store(Request $request){

      //return json_encode(['files'=>$_FILES,'$request'=>$request->all(),'file'=>$_FILES['img_perfil']]);

      $data=$request->all();
      $file_permitido=false;
      $ruta_image_perfil="Recursos_sistema/upload_image.png"; #default

      #empty — Determina si una variable está vacía
      try {
        if($request->hasFile('img_perfil')){
            $info=$this->Image_validar($_FILES);
            $file_permitido=$info['validacion'];
         }

        if($file_permitido==true){
            return json_encode(['info'=>$info['info'],'status'=>400,'file_error'=>'error' ]);
         }

      } catch (\Throwable $th) {
          return json_encode(['status'=>400,'No se pudo realizar la verificacion del archivo']);
      }


        // validacion datos personales
       $validatedData = Validator::make($data, [
            'tipo_usuario'=>'required',
            'curp'=>['required','string','max:20','unique:users'],
            'telefono'=>['required','string','max:15','unique:users'],
            'email'=>['required','email','max:50','unique:users'],
            'rfc'=>'required',
            'nombre'=>'required',
            'ap_paterno'=>'required',
            'genero'=>'required',
            'fecha_nacimiento'=>'required',
            'codigo_postal'=>'required',
            'localidad'=>'required'
        ]);

        if($validatedData->fails()) {
            return json_encode(['withErrrors'=>$validatedData->errors()->all()]);
        }

        $tipo_usuario=trim($data['tipo_usuario']);
        $curp=trim($data['curp']);
        $telefono=trim($data['telefono']);
        $correo=trim($data['email']);
        $rfc=trim($data['rfc']);
        $nombre=trim($data['nombre']);
        $ap_paterno=trim($data['ap_paterno']);
        $ap_materno=trim($data['ap_materno']);
        $genero=trim($data['genero']);
        $fecha_nacimiento=trim($data['fecha_nacimiento']);
        $codigo_postal=trim($data['codigo_postal']);
        $localidad=trim($data['localidad']);

        // validacion datos_academicos_alumno
        $matricula=isset($data['matricula'])?$data['matricula']:"";
        $semestre_escolar=isset($data['semestre_escolar'])?$data['semestre_escolar']:"";
        $carrera_escolar=isset($data['carrera_escolar'])?$data['carrera_escolar']:"";
        $periodo_escolar=isset($data['periodo_escolar'])?$data['periodo_escolar']:"";
        $turno_escolar=isset($data['turno_escolar'])?$data['turno_escolar']:"";
        $grupo_escolar=isset($data['grupo_escolar'])?$data['grupo_escolar']:"";

        if($tipo_usuario=="alumno"){
            // alumno
            $validatedDatos_complementarios = Validator::make($data, [
                'matricula'=>['required','string','max:10','unique:datos_alumnos'],
                'semestre_escolar'=>'required',
                'carrera_escolar'=>'required',
                'periodo_escolar'=>'required',
                'turno_escolar'=>'required',
                'grupo_escolar'=>'required'
            ]);
        }

         // validacion datos_academicos_alumno
        $cedula_profesional=isset($data['cedula_profesional'])?$data['cedula_profesional']:"";
        if($tipo_usuario!="alumno" && $tipo_usuario!="administrador"){
            // diferente de alumno y administardior, solictar cedula profesional etc.
            $validatedDatos_complementarios = Validator::make($data, [
                'cedula_profesional'=>['required','string','max:10','unique:datos_docentes']
                //'grupo_escolar'=>'required'
            ]);
        }

        if($validatedDatos_complementarios->fails()) {
            return json_encode(['withErrrors'=>$validatedDatos_complementarios->errors()->all()]);
        }

        // //ver post
        //return json_encode(['data'=>$data]);

        try {

            DB::beginTransaction();

            if(isset($data['img_perfil'])){
                if($data['img_perfil']!="undefined"||$data['img_perfil']!=null){
                    if($request->hasFile('img_perfil')) {
                        $ruta_image_perfil =$request->file('img_perfil')->store('Users','public');
                     }
                }
               
            }

            $FECHA_REGISTER=date('Y-m-d H:i:s');

            $user_id_created = DB::table('users')->insertGetId(
                [
                    'tipo_usuario'=>  $tipo_usuario,
                    'curp'=> $curp ,
                    'rfc'=>$rfc,
                    'nombre'=> $nombre ,
                    'ap_paterno'=>$ap_paterno ,
                    'ap_materno'=> $ap_materno,
                    'genero'=> $genero,
                    'fecha_nacimiento'=> $fecha_nacimiento,
                    'localidad'=> $localidad,
                    'telefono'=>$telefono  ,
                    'email'=>  $correo,
                    'active'=>'1',
                    'password'=> Hash::make('password'),
                    'photo'=> $ruta_image_perfil,
                    'created_at'=>$FECHA_REGISTER
                ]
            );

            if($user_id_created<=0){
                 throw new Exception ("NO SE PUDO REALIZAR EL REGISTRO DE USUARIO, EXEPTION");
            }

            if($tipo_usuario=="alumno"){
                $status=DB::table('datos_alumnos')->insert([
                    [
                        'matricula'=>$matricula,
                        'periodo'=> $periodo_escolar ,
                        'semestre'=>$semestre_escolar ,
                        'carrera'=>$carrera_escolar ,
                        'grupo'=> $grupo_escolar,
                        'turno'=> $turno_escolar,
                        'user_id_alumno'=> $user_id_created
                    ],
                ]);
              if(!$status){
                  throw new Exception("NO SE PUDO REALIZAR EL REGISTRO DE DATOS DEL ALUMNO, EXEPTION");
              }
            }
            if($tipo_usuario!="alumno" && $tipo_usuario!="administrador"){
                $status=DB::table('datos_docentes')->insert([
                    [
                        'cedula_profesional'=>$cedula_profesional,
                        'user_id_docente'=> $user_id_created
                    ],
                ]);
                if(!$status){
                 throw new Exception("NO SE PUDO REALIZAR EL REGISTRO DE DATOS DEL DOCENTE, EXEPTION");
                }
            }

           DB::commit();
            return json_encode(['status'=>"200",'info'=>"Registro exitoso"]);

        } catch (\Throwable $e) {
            DB::rollBack();

            return json_encode(['status'=>"400",'info'=>"Se produjo un problema de comunicación con el servidor",'Exeception_db'=>$e->getMessage(),'line'=>$e->getLine()]);
        }
    }

    public function create(){

        $data="";
        return view('Admin.usuario.create',compact('data'));
    }

    public function cuentaUser(Request $request){
        $data=$request->all();

        $id_user=$data['id'];

        $users = DB::table('users')->where('id',$id_user)->first();

        if(empty($users)){
            return json_encode(['data'=>$users,'status'=>400,'info'=>'No se encontraron resultados con este usuario,Intentelo de nuevo']);
        }


        $new_status_count=0;
        if($users->{'active'}=="2"||$users->{'active'}=="3"){
            $new_status_count=1;
        }else{
            $new_status_count=2;
        }


        $affected = DB::table('users')
          ->where('id', $id_user)
          ->update(['active' =>$new_status_count]);

        if(!$affected){
           return json_encode(['data'=>$users,'status'=>400,'status_update'=>$affected,'info'=>'Se produjo un problema de comunicación con el servidor,Intentelo de nuevo']);
        }

        $users = DB::table('users')->where('id',$id_user)->first();

        return json_encode(['user'=>$users,'status'=>200,'status_update'=>$affected]);
        //Storage::delete('public/Users/5YWJeD1yCBWdmmRKvUSQf2sxKoaCwGhlsH8WTEgb.png');
    }

    public static function Image_validar($FILES){
        $validator=false;
        $arreglo=[];
        foreach ($FILES as $key => $file) {
            // # code...;
                $formato_image_ERROR='';
                $peso_image_ERROR='';

                $formatos_permitidos =  array('jpg','jpeg' ,'png');
                $archivo= $file['name'];
                $peso_byte=$file['size'];
                $extension =strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                if($formatos_permitidos!=""&&$archivo!=""&&$peso_byte!=""){
                    if(!in_array($extension, $formatos_permitidos) ) {
                        $formato_image_ERROR='Formato no permitido: '.strtoupper($extension);
                    }
                    if($peso_byte>2097152){
                        $peso_image_ERROR="Peso Permitido:2MB, Peso Actual ".number_format(($peso_byte/1048576),2).'MB';
                    }
                    if($formato_image_ERROR!=""||$peso_image_ERROR!=""){
                        $arreglo=["info"=>"Intentelo de nuevo","status"=>400,"formato"=>$formato_image_ERROR,"peso"=>$peso_image_ERROR,"image"=>'Nombre del archivo: '.$file['name']];
                        $validator=true;
                    }

                }
           }

            $info=['info'=>$arreglo,'validacion'=>$validator];
            return $info;
    }
}
