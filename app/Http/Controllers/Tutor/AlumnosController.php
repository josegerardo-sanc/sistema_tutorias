<?php

namespace App\Http\Controllers\Tutor;


use Exception;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Mail\MessageRegistroUsuario;
use Illuminate\Support\Facades\Mail;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class AlumnosController extends Controller
{

    public function index(){


        $user=auth()->user();

        $asignaciones=DB::table('asignacion')->where('user_id_asignado','=',$user->id)
        ->leftJoin('carreras','asignacion.carrera', '=', 'carreras.id_carrera')
        ->select('asignacion.*','carreras.carrera as name_carrera')
        ->get();


        $alumnos=[];
        $data_codigoPostal=[];
        if(count($asignaciones)>0){
            $alumnos=DB::table('users')
                        ->leftJoin('datos_alumnos','users.id', '=', 'datos_alumnos.user_id_alumno')
                        ->leftJoin('carreras','datos_alumnos.carrera', '=', 'carreras.id_carrera')
                        ->where('users.tipo_usuario','=','alumno')
                        ->where('datos_alumnos.carrera','=',$asignaciones[0]->carrera)
                        ->where('datos_alumnos.semestre','=',$asignaciones[0]->semestre)
                        ->where('datos_alumnos.turno','=',$asignaciones[0]->turno)
                        ->where('datos_alumnos.grupo','=',$asignaciones[0]->grupo)
                        ->select('users.*','datos_alumnos.*','carreras.carrera as name_carrera','users.id as id_user_principal')
                        ->get();
        }else{
            $asignaciones=[];
        }
        // dd($data_codigoPostal);
         return view('tutor.index',compact('asignaciones','alumnos'));
    }


    public function create(){
        $user=auth()->user();

        $asignaciones=DB::table('asignacion')->where('user_id_asignado','=',$user->id)
        ->leftJoin('carreras','asignacion.carrera', '=', 'carreras.id_carrera')
        ->select('asignacion.*','carreras.carrera as name_carrera','carreras.id_carrera')
        ->get();

        // dd($asignaciones);
       return view('tutor.RegistrarAlumno',compact('asignaciones'));
    }

    public function edit($id){

        $user=auth()->user();

        $asignaciones=DB::table('asignacion')->where('user_id_asignado','=',$user->id)->get();

        $usersData="";
        $user = DB::table('users')->where('id',$id)->first();
        // dd($user);

        if($user==null || empty($user)){
            abort(403,'EL ALUMNO QUE INTENTAS BUSCAR NO ESTA REGISTRADO EN LA BASE DE DATOS.');
        }

        $usersData=DB::table('users')
            ->leftJoin('datos_alumnos','users.id', '=', 'datos_alumnos.user_id_alumno')
            ->leftJoin('carreras', 'datos_alumnos.carrera', '=', 'carreras.id_carrera')
            ->where('users.tipo_usuario','=','alumno')
            ->where('datos_alumnos.carrera','=',$asignaciones[0]->carrera)
            ->where('datos_alumnos.semestre','=',$asignaciones[0]->semestre)
            ->where('datos_alumnos.turno','=',$asignaciones[0]->turno)
            ->where('datos_alumnos.grupo','=',$asignaciones[0]->grupo)
            ->where('users.id','=',$id)
            ->select('users.*','datos_alumnos.*','users.id as id_user_principal','carreras.carrera as name_carrera','carreras.id_carrera')
            ->get();

        if(!count($usersData)>0){
            abort(403,'INTENTAS OBTENER INFORMACION DE UN ALUMNO QUE NO ESTA ASIGNADO A TUS TUTORADOS');
        }

        // dd($usersData);
        return view('tutor.ActualizarDatosAlumno',compact('usersData','asignaciones'));

    }


    public function registerAlumnos(Request $request){
        $data=$request->all();

        // return json_encode(['data'=>$data,'status'=>400,'file'=>$_FILES]);

        $file_permitido=false;
        $ruta_image_perfil="Recursos_sistema/upload_image.png";

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
            return json_encode(['status'=>400,'info'=>'No se pudo realizar la verificacion del archivo']);
        }

           // validacion datos personales
           $validatedData = Validator::make($data, [
                'curp'=>['required','string','max:20','unique:users'],
                'telefono'=>['required','string','max:15','unique:users'],
                'email'=>['required','email','max:50','unique:users'],
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

            $validatedDatos_complementarios = Validator::make($data, [
                'matricula'=>['required','string','max:10','unique:datos_alumnos'],
                'semestre_escolar'=>'required',
                'carrera_escolar'=>'required',
                'periodo_escolar'=>'required',
                'turno_escolar'=>'required',
                'grupo_escolar'=>'required'
            ]);

            if($validatedDatos_complementarios->fails()) {
                return json_encode(['withErrrors'=>$validatedDatos_complementarios->errors()->all()]);
            }

            // return json_encode(['data'=>$data,'status'=>400]);
            $periodo_escolar=isset($data['periodo_escolar'])?$data['periodo_escolar']:"";

            if($periodo_escolar==0||$periodo_escolar==null){
                return json_encode(['status'=>400,'info'=>'<i class="fas fa-exclamation-circle"></i> Debes seleccionar el periodo escolar']);
            }

            $tipo_usuario="alumno";
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
            $turno_escolar=isset($data['turno_escolar'])?$data['turno_escolar']:"";
            $grupo_escolar=isset($data['grupo_escolar'])?$data['grupo_escolar']:"";


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
                        'tipo_usuario'=> "alumno",
                        'curp'=> $curp ,
                        'rfc'=>$rfc,
                        'nombre'=> $nombre ,
                        'ap_paterno'=>$ap_paterno ,
                        'ap_materno'=> $ap_materno,
                        'genero'=> $genero,
                        'fecha_nacimiento'=> $fecha_nacimiento,
                        'code_postal'=> $codigo_postal,
                        'localidad'=> $localidad,
                        'telefono'=>$telefono  ,
                        'email'=>  $correo,
                        'active'=>'3',
                        'password'=>Hash::make('password'),
                        'photo'=> $ruta_image_perfil,
                        'created_at'=>$FECHA_REGISTER
                    ]
                );


                DB::table('datos_alumnos')->insert([
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

                DB::commit();

                $user=User::find($user_id_created);
                $user->assignRole(ucwords("Alumno"));

                // envio de correo
                $token=md5('token_confirm_correo');
                $data['id_generado_user']=base64_encode($user_id_created.'---'.$token);
                Mail::to($data['email'])->send(new MessageRegistroUsuario($data));
                return json_encode(['status'=>"200",'info'=>"Registro exitoso",'register_alumno'=>true]);
            } catch (\Throwable $e) {
                DB::rollBack();
                if($request->hasFile('img_perfil')) {
                    Storage::delete('public/'.$ruta_image_perfil);
                }
                return json_encode(['status'=>"400",'info'=>"Se produjo un problema de comunicación con el servidor"]);
            }
    }


    public function actualizarAlumnos(Request $request,$id){

        $data=$request->all();
        // return json_encode(['status'=>200,'request'=>$data]);

        $usersData="";
        $user_id_alumno="";

        $user = DB::table('users')->where('id',$id)->first();
        //return json_encode(['status'=>200,'usersData'=>$user]);
        if($user==null || empty($user)){
           return json_encode(['status'=>400,'info'=>'NO SE ENCONTRO ESTE USUARIO EN LA BASE DE DATOS.']);
        }

        if($user->tipo_usuario=="alumno"){
                $usersData = DB::table('users')
                ->join('datos_alumnos', 'users.id', '=', 'datos_alumnos.user_id_alumno')
                ->select('datos_alumnos.*','datos_alumnos.id_datos_alumnos AS id_alumno','users.*')
                ->where('users.id','=',$id)
                ->get();
            $user_id_alumno=$usersData[0]->id_alumno;
        }else{
            return json_encode(['status'=>400,'info'=>'SOLO PUEDES CREAR Y ACTUALIZAR DATOS DE UN ALUMNO, NO TIENES EL PERFIL DE ADMINISTRADOR']);
        }

        //$user=$usersData[0];
        // return json_encode(['status'=>200,'usersData'=>$usersData,'id_alumno'=>$user_id_alumno]);
        $validatedDatos_complementarios = Validator::make($data, [
            // 'matricula'=>'required','string','max:10',Rule::unique('datos_alumnos','matricula')->ignore($user_id_alumno, 'id_datos_alumnos'),
            'matricula' => ['required','string','max:10', Rule::unique('datos_alumnos')->ignore($user_id_alumno, 'id_datos_alumnos')],
            'semestre_escolar'=>'required',
            'carrera_escolar'=>'required',
            'periodo_escolar'=>'required',
            'turno_escolar'=>'required',
            'grupo_escolar'=>'required'
        ]);

        if($validatedDatos_complementarios->fails()) {
            return json_encode(['withErrrors'=>$validatedDatos_complementarios->errors()->all()]);
        }


        $user=$usersData[0];

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
              'curp'=>['required','string','max:20','sometimes','unique:users,curp,'.$user->id],
              'telefono'=>['required','string','max:15','sometimes','unique:users,telefono,'.$user->id],
              'email'=>['required','email','max:50','sometimes','unique:users,email,'.$user->id],
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

          $status_cuenta_user_=isset($data['status_cuenta_user_'])?true:false;

          if($status_cuenta_user_){
            $status_cuenta_user_=$data['status_cuenta_user_']!=""&&$data['status_cuenta_user_']!=null?$data['status_cuenta_user_']:$user->active;
          }else{
              $status_cuenta_user_=$user->active;
          }

            // validacion datos_academicos_alumno
            $matricula=isset($data['matricula'])?$data['matricula']:"";
            $semestre_escolar=isset($data['semestre_escolar'])?$data['semestre_escolar']:"";
            $carrera_escolar=isset($data['carrera_escolar'])?$data['carrera_escolar']:"";
            $periodo_escolar=isset($data['periodo_escolar'])?$data['periodo_escolar']:"";
            $turno_escolar=isset($data['turno_escolar'])?$data['turno_escolar']:"";
            $grupo_escolar=isset($data['grupo_escolar'])?$data['grupo_escolar']:"";


        //   return json_encode(['data'=>$data]);
          try {
              DB::beginTransaction();

              if(isset($data['img_perfil'])){
                  if($data['img_perfil']!="undefined"||$data['img_perfil']!=null){
                      if($request->hasFile('img_perfil')) {

                        if($user->photo!='Recursos_sistema/upload_image.png'){
                            Storage::delete('public/'.$user->photo);
                         }
                         $ruta_image_perfil =$request->file('img_perfil')->store('Users','public');
                       }
                  }

              }

              $FECHA_REGISTER=date('Y-m-d H:i:s');

              $user_id_created = DB::table('users')
              ->where('id',$id)
              ->update(
                  [
                      'tipo_usuario'=>  $tipo_usuario,
                      'curp'=> $curp ,
                      'rfc'=>$rfc,
                      'nombre'=> $nombre ,
                      'ap_paterno'=>$ap_paterno ,
                      'ap_materno'=> $ap_materno,
                      'genero'=> $genero,
                      'fecha_nacimiento'=> $fecha_nacimiento,
                      'code_postal'=> $codigo_postal,
                      'localidad'=> $localidad,
                      'telefono'=>$telefono  ,
                      'email'=>  $correo,
                      'active'=>$status_cuenta_user_,
                      'photo'=> $ruta_image_perfil,
                      'created_at'=>$FECHA_REGISTER
                  ]
              );

              DB::table('datos_alumnos')
              ->where('id_datos_alumnos',$user_id_alumno)
              ->update([
                      'matricula'=>$matricula,
                      'periodo'=> $periodo_escolar ,
                      'semestre'=>$semestre_escolar ,
                      'carrera'=>$carrera_escolar ,
                      'grupo'=> $grupo_escolar,
                      'turno'=> $turno_escolar
                  ]);

             DB::commit();
              return json_encode(['status'=>"200",'info'=>"Datos actualizado con exitoso",'actualizar_alumno'=>true]);

          } catch (Exception  $e) {
              DB::rollBack();
              if($request->hasFile('img_perfil')) {
                Storage::delete('public/'.$ruta_image_perfil);
              }
              return json_encode(['status'=>"400",'info'=>"Se produjo un problema de comunicación con el servidor"]);
          }

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
