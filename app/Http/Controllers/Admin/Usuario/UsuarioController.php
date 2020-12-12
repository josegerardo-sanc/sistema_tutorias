<?php

namespace App\Http\Controllers\Admin\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Mail\MessageRegistroUsuario;
use Illuminate\Support\Facades\Mail;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;


class UsuarioController extends Controller
{

    public function __construct(){
        // $this->middleware(['permission:registrar AdminUsuario|desactivarCuenta AdminUsuario|listar AdminUsuario|actualizar AdminUsuario|crearFormato AdminUsuario']);
    }

    public function index(Request $request){


      $ID_SESION_USER=Auth::user()->id;

      if($request->ajax()){

        $data=$request->all();
        //general
        $numeroPagina=isset($data['numeroPagina'])?$data['numeroPagina']:"1";
        $cantidad=isset($data['cantidad'])?$data['cantidad']:"100";

        $inicio=(($numeroPagina*$cantidad)-$cantidad);

        //token=$request['_token'];


        $tipo_usuario=$data['tipo_user'];

        if($tipo_usuario=="alumno"){
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

            $SQL=" select *,users.created_at as fecha_registro from users LEFT JOIN datos_alumnos ON users.id=datos_alumnos.user_id_alumno
            LEFT JOIN carreras ON datos_alumnos.carrera=carreras.id_carrera
            WHERE users.tipo_usuario='alumno'
            and users.id!=$ID_SESION_USER
            $WHERE LIMIT $inicio,$cantidad";

            $users = DB::select("
               $SQL
            ");

            $TotalRegistros_of_users =DB::table('users')
                                      ->leftJoin('datos_alumnos','users.id', '=', 'datos_alumnos.user_id_alumno')
                                      ->where('users.tipo_usuario', '=','alumno')
                                      ->where('users.id','!=',$ID_SESION_USER)
                                      ->count();

        }
        if($tipo_usuario!="alumno"&& $tipo_usuario!="administrador" && $tipo_usuario!="all_todos_users"){

            $WHERE="";
            $CEDULA_PROFESIONAL=isset($data['filtro_cedulaProfesional'])?$data['filtro_cedulaProfesional']:"";

            if($CEDULA_PROFESIONAL!=""){
                $WHERE.=" AND datos_docentes.cedula_profesional='$CEDULA_PROFESIONAL'";
            }

            $SQL=" select *,users.created_at as fecha_registro from users LEFT JOIN datos_docentes ON users.id=datos_docentes.user_id_docente
            WHERE users.tipo_usuario='$tipo_usuario' and users.id!=$ID_SESION_USER
            $WHERE LIMIT $inicio,$cantidad";

            $users = DB::select("$SQL");

            $TotalRegistros_of_users =DB::table('users')
                                      ->leftJoin('datos_docentes','users.id', '=', 'datos_docentes.user_id_docente')
                                      ->where('users.tipo_usuario', '=',$tipo_usuario)
                                      ->where('users.id','!=',$ID_SESION_USER)
                                      ->count();

        }
        if($tipo_usuario=="administrador"){
            $SQL="";
            $users = DB::table('users')
            ->where('users.tipo_usuario', '=','administrador')
            ->orderBy('users.id','desc')->get();
            $TotalRegistros_of_users =DB::table('users')->where('users.tipo_usuario', '=','administrador')->count();
        }

        if($tipo_usuario=="all_todos_users"){

          $SQL="select *,users.created_at as fecha_registro from users where users.id!=$ID_SESION_USER LIMIT $inicio,$cantidad";
          $users = DB::select($SQL);
          $TotalRegistros_of_users =DB::table('users')->where('users.id','!=',$ID_SESION_USER)->count();

        }

        $cantidad=$numeroPagina*$cantidad;
        return json_encode([
          'data'=>$users,
          'inicio'=>$inicio,
          'cantidad'=>$cantidad,
          'TotalRegistros_of_users'=>$TotalRegistros_of_users,
          'tipousers'=>$tipo_usuario,
          'status'=>400,
          'SQL'=>$SQL
        ]);

      }

      //general
      $numeroPagina=1;
      $cantidad=100;

      $inicio=(($numeroPagina*$cantidad)-$cantidad);

      $SQL_USERS="select *,users.created_at as fecha_registro from users WHERE id!=$ID_SESION_USER LIMIT $inicio,$cantidad";
      $users = DB::select($SQL_USERS);
      $TotalRegistros_of_users =DB::table('users')->where('id','!=',$ID_SESION_USER)->count();

      // return json_encode(['total'=>$TotalRegistros_of_users,
      //                      'inicio_limit'=>$inicio,
      //                      'fin_limit'=>$cantidad,
      //                     'sql_users_all'=>$SQL_USERS]);

      $tipousers='all_todos_users';
      $cantidad=$numeroPagina*$cantidad;
      return view('admin.usuario.index',compact('users','TotalRegistros_of_users','inicio','cantidad','tipousers'));

    }

    public function store(Request $request){


        // // envio de correo
        // $data=$request->all();
        // $token=md5('token_confirm_correo');
        // $data['id_generado_user']=base64_encode('7'.'---'.$token);
        // Mail::to($data['email'])->send(new MessageRegistroUsuario($data));

        // return json_encode(['status'=>400,'info'=>'probando confirmacion de correo']);

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
            return json_encode(['status'=>400,'info'=>'No se pudo realizar la verificacion del archivo']);
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

            if($tipo_usuario!="administrador"){
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
            }

            // //ver post
            // return json_encode(['data'=>$data]);
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

            $user=User::find($user_id_created);
            $user->assignRole(ucwords($tipo_usuario));

            // envio de correo
            $token=md5('token_confirm_correo');
            $data['id_generado_user']=base64_encode($user_id_created.'---'.$token);
            Mail::to($data['email'])->send(new MessageRegistroUsuario($data));
            return json_encode(['status'=>"200",'info'=>"Registro exitoso"]);

            } catch (\Throwable $e) {
                DB::rollBack();
                if($request->hasFile('img_perfil')){
                    Storage::delete('public/'.$ruta_image_perfil);
                }
                return json_encode(['status'=>"400",'info'=>"Se produjo un problema de comunicación con el servidor Exeception_db: ".$e->getMessage()." line: ".$e->getLine(),'Exeception_db'=>$e->getMessage(),'line'=>$e->getLine()]);
            }
    }


    public function actualizar(Request $request, $id){

        $usersData="";
        $user = DB::table('users')->where('id',$id)->first();
        //return json_encode(['status'=>200,'usersData'=>$user]);

        $user_id_alumno="";
        $user_id_docente="";

        if($user==null || empty($user)){
           return json_encode(['status'=>400,'info'=>'NO SE ENCONTRO ESTE USUARIO']);
        }else{
            if($user->tipo_usuario=="alumno"){
                $usersData = DB::table('users')
                ->join('datos_alumnos', 'users.id', '=', 'datos_alumnos.user_id_alumno')
                ->select('datos_alumnos.*','datos_alumnos.id_datos_alumnos AS id_alumno','users.*')
                ->where('users.id','=',$id)
                ->get();

                $user_id_alumno=$usersData[0]->id_alumno;
            }else{

                if($user->tipo_usuario!="alumno" && $user->tipo_usuario!="administrador"){
                    $usersData = DB::table('users')
                    ->join('datos_docentes', 'users.id', '=', 'datos_docentes.user_id_docente')
                    ->select('datos_docentes.id_datos_docentes AS id_docente','users.*')
                    ->where('users.id','=',$id)
                    ->get();
                    $user_id_docente=$usersData[0]->id_docente;
                }

                if($user->tipo_usuario=="administrador"){
                    $usersData = DB::table('users')
                    ->select('users.*')
                    ->where('users.id','=',$id)
                    ->get();
                }
            }

        //$user=$usersData[0];
        // return json_encode(['status'=>200,'usersData'=>$usersData]);

        }

        $user=$usersData[0];

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
              'curp'=>['required','string','max:20','sometimes','unique:users,curp,'.$user->id],
              'telefono'=>['required','string','max:15','sometimes','unique:users,telefono,'.$user->id],
              'email'=>['required','email','max:50','sometimes','unique:users,email,'.$user->id],
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

          if($tipo_usuario!="administrador"){
            if($tipo_usuario=="alumno"){
                // alumno
                $validatedDatos_complementarios = Validator::make($data, [
                    // 'matricula'=>'required','string','max:10',Rule::unique('datos_alumnos','matricula')->ignore($user_id_alumno, 'id_datos_alumnos'),
                    'matricula' => ['required','string','max:10', Rule::unique('datos_alumnos')->ignore($user_id_alumno, 'id_datos_alumnos')],
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
                    // 'cedula_profesional'=>'required','string','max:10',Rule::unique('datos_docentes','cedula_profesional')->ignore($user_id_docente, 'id_datos_docentes'),
                    'cedula_profesional' => ['required','string','max:10', Rule::unique('datos_docentes')->ignore($user_id_docente, 'id_datos_docentes')],

                    //'grupo_escolar'=>'required'
                ]);
            }

            if($validatedDatos_complementarios->fails()) {
                return json_encode(['withErrrors'=>$validatedDatos_complementarios->errors()->all()]);
            }

          }
          // //ver post
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

              if($user_id_created<=0){
                   throw new Exception ("NO SE PUDO REALIZAR EL REGISTRO DE USUARIO, EXEPTION");
              }
              $affected="";
              if($tipo_usuario=="alumno"){
                $affected=DB::table('datos_alumnos')
                  ->where('id_datos_alumnos',$user_id_alumno)
                  ->update([
                          'matricula'=>$matricula,
                          'periodo'=> $periodo_escolar ,
                          'semestre'=>$semestre_escolar ,
                          'carrera'=>$carrera_escolar ,
                          'grupo'=> $grupo_escolar,
                          'turno'=> $turno_escolar
                      ]);

              }
              if($tipo_usuario!="alumno" && $tipo_usuario!="administrador"){
                  $affected=DB::table('datos_docentes')
                  ->where('id_datos_docentes',$user_id_docente)
                  ->update([
                     'cedula_profesional'=>$cedula_profesional
                  ]);

              }

             DB::commit();
              return json_encode(['status'=>"200",'info'=>"Datos actualizado con exitoso",'update_datosComplementarios'=>$affected]);

          } catch (Exception  $e) {
              DB::rollBack();

              if($request->hasFile('img_perfil')){
                Storage::delete('public/'.$ruta_image_perfil);
              }
              return json_encode(['status'=>"400",'info'=>"Se produjo un problema de comunicación con el servidor Exeception_db: ".$e->getMessage(),'Exeception_db'=>$e->getMessage(),'line'=>$e->getLine()]);
          }
    }

    public function create(){

        $data="";
        return view('admin.usuario.create',compact('data'));
    }
    public function edit($id){

        $usersData="";
        $user = DB::table('users')->where('id',$id)->first();

        if($user==null || empty($user)){
            abort(404);
        }else{
            if($user->tipo_usuario=="alumno"){
                $usersData = DB::table('users')
                ->leftJoin('datos_alumnos', 'users.id', '=', 'datos_alumnos.user_id_alumno')
                ->leftJoin('carreras', 'datos_alumnos.carrera', '=', 'carreras.id_carrera')
                ->select('users.*','users.id AS id_user','datos_alumnos.*','carreras.id_carrera')
                ->where('users.id','=',$id)
                ->get();

            }else if($user->tipo_usuario!="alumno" && $user->tipo_usuario!="administrador"){
                $usersData = DB::table('users')
                ->join('datos_docentes', 'users.id', '=', 'datos_docentes.user_id_docente')
                ->select('users.*','users.id AS id_user','datos_docentes.*')
                ->where('users.id','=',$id)
                ->get();
            }else{
                $usersData = DB::table('users')
                ->select('users.*','users.id AS id_user')
                ->where('users.id','=',$id)
                ->get();
            }

        }

        // dd($usersData);
        return view('admin.usuario.edit',compact('usersData'));
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
