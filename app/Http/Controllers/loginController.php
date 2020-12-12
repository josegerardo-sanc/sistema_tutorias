<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\GaleriaImages;
use Exception;

// use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse\RedirectResponse\redirect;


class loginController extends Controller
{



    public function cerrarSesion(){

        try {
            Auth::logout();
            return json_encode(['status'=>200,'info'=>'SESION CERRADA']);
        } catch (\Exception $e) {
            return json_encode(['status'=>400,'info'=>'ERROR: AL INTENTAR CERRAR SESIÓN'.$e->getMessage()]);
        }

    }
    public function IniciarSesion(Request $request)
    {

        $data=$request->all();
        //return json_encode(['data'=>$data,'status'=>400]);

        if(!isset($_SESSION)){
            session_start();
        }

        unset($_SESSION['auth_user']);

        $curp_usuario=isset($data['USUARIO_CURP'])?$data['USUARIO_CURP']:'';
        $curp_usuario=strtoupper($curp_usuario);

        $clave_usuario=isset($data['CLAVE_USUARIO'])?$data['CLAVE_USUARIO']:'';

        $MENSAJE_ERROR="";
        if($curp_usuario==""){
            $MENSAJE_ERROR.="<li>DEBES INGRESAR TU CURP</li>";
        }

        if($clave_usuario==""){
            $MENSAJE_ERROR.="<li>DEBES INGRESAR TU CLAVE DE ACCESO</li>";
        }
        if($MENSAJE_ERROR!=""){
            return json_encode(['status'=>400,'info'=>$MENSAJE_ERROR]);
        }

        $Permanecer_registrado=$data['Permanecer_registrado'];


        $user = DB::table('users')
        ->where('curp',$curp_usuario)
        ->get();




        // validacion de datos
        if(count($user)<=0){
            return json_encode(['status'=>400,'info'=>'<i class="fas fa-exclamation-circle"></i> La curp que ingresaste no coincide con ninguna cuenta.']);
        }
        // saber si esta activa la cuenta
        if($user[0]->{'active'}=="2"){
            return json_encode(['status'=>400,'info'=>'<i class="fas fa-exclamation-circle"></i> Tu cuenta se encuentra inactiva, para mayor información acercate a con control escolar.']);
        }else if($user[0]->{'active'}=="3"){

            return json_encode(['status'=>400,
                                'info'=>'<i class="fas fa-exclamation-circle"></i> No has confirmado tu Correo electronico.']);
        }
        if (! (Hash::check($clave_usuario,$user[0]->{'password'})) ) {
            return json_encode(['status'=>400,'info'=>'<i class="fas fa-exclamation-circle"></i> La contraseña que ingresaste es incorrecta']);
        }

        if (Auth::attempt(['email' => $user[0]->{'email'},'password' =>$clave_usuario],$Permanecer_registrado)) {
            return json_encode(['status'=>200,'data'=>$user,'count'=>count($user),'info_secret'=>'attempt 200']);
        }else{
            return json_encode(['status'=>400,'info'=>'<i class="fas fa-exclamation-circle"></i> La contraseña que ingresaste es incorrecta']);
        }

        $_SESSION['auth_user']=$user[0];
        return json_encode([
                'status'=>200,
                'data'=>$user,
                'count'=>count($user),
                'info_secret'=>'attempt 400'
            ]);

    }

    public function perfil_account_settings_view(){

        if (!Auth::check()) {
            return redirect('/');
        }

        $user=auth()->user();

        // dd($user);
        $domicilio= DB::table('codigos')
        ->where('codigo','=',$user->code_postal)
        ->where('id',$user->localidad)
        ->first();

        $datos_user="";
        if($user->tipo_usuario=="alumno"){
            $datos_user=DB::table('datos_alumnos')
            ->leftJoin('carreras', 'datos_alumnos.carrera', '=', 'carreras.id_carrera')
            ->where('user_id_alumno','=',$user->id)
            ->first();
        }else if($user->tipo_usuario!="alumno"&&$user->tipo_usuario!="administrador"){
            $datos_user=DB::table('datos_docentes')
            ->where('user_id_docente','=',$user->id)
            ->first();
        }

        // dd($datos_user);


        return view('myperfil.perfil',compact('user','domicilio','datos_user'));

    }
    public function change_password_user(Request $request){

        $data=$request->all();
        $user=auth()->user();

        $error_msg="";
        if($data['password_actual']==""||$data['password_nueva']==""||$data['password_confirm']==""){
            $error_msg="TODOS LOS CAMPOS SON REQUERIDOS.";
            return json_encode(['status'=>400,'info'=>$error_msg]);
        }

        if($data['password_nueva']!=$data['password_confirm']){
            $error_msg="LA CONTRASEÑA DE CONFIRMACION NO COINCIDE.";
            return json_encode(['status'=>400,'info'=>$error_msg]);
        }

        if (!(Hash::check($data['password_actual'],$user->password)) ) {

            return json_encode(['status'=>400,'info'=>'LA CONTRASEÑA ACTUAL ES INCORRECTA.']);
        }

        $password_new_has=Hash::make($data['password_nueva']);
        try {
            DB::table('users')->where('users.id',$user->id)->update(['password' =>$password_new_has]);

            return json_encode(['status'=>200,'info'=>'TU CLAVE DE ACCESO FUE ACTUALIZADA CON EXITO']);

        } catch (\Exception $e) {
            return json_encode(['status'=>400,'info'=>'PROBLEMAS CON EL SERVIDOR, INTENTELO DE NUEVO'.$e->getMessage().' Line'.$e->getLine()]);
        }

    }

    public function ConfirmCorreo(Request $request,$id){


        $datos_get=explode('---',base64_decode($id));


        // dd($datos_get);

        $data_user=DB::table('users')->where('id','=',$datos_get[0])->get();
        if(count($data_user)<=0){
            return redirect('/');
        }

        // dd($data_user);

        $fecha_now=date('Y-m-d H:i:s');

        if(count($data_user)>0){
            DB::table('users')->where('id','=',$datos_get[0])
            ->update([
                'email_verified_at' =>$fecha_now,
                'active'=>1
                ]);

           if (Auth::attempt(['email' => $data_user[0]->{'email'},'password' =>'password'],false)) {

                $msg=ucwords($data_user[0]->{'nombre'})." Has activado tu cuenta.";

                // dd($data_user[0]->tipo_usuario);
                if($data_user[0]->tipo_usuario=="tutor"){
                    return redirect('/tutor')->with('status_confirm',$msg);
                }
                if($data_user[0]->tipo_usuario=="alumno"){
                    return redirect('/alumno')->with('status_confirm',$msg);
                }
                if($data_user[0]->tipo_usuario=="director"){
                    return redirect('/director')->with('status_confirm',$msg);

                }
                if($data_user[0]->tipo_usuario=="subdirector"){
                    return redirect('/subdirector')->with('status_confirm',$msg);

                }
                if($data_user[0]->tipo_usuario=="administrador"){
                    return redirect('/Admin/user')->with('status_confirm',$msg);

                }
               return redirect('/')->with('status_confirm','Lo sentimos no tienes ningun perfil,comunicate con tu tutor');

            }
        }else{
           return redirect('/')->with('status_confirm_error', 'Lo sentimos, ha ocurrido un error al querer verificar su cuenta</br> Intentelo de nuevo, si el error persiste acercate a control escolar.');
        }
    }

}
