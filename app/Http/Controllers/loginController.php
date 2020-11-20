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

        if(count($user)<=0){
            return json_encode(['status'=>400,'info'=>'<i class="fas fa-exclamation-circle"></i> La curp que ingresaste no coincide con ninguna cuenta.']);
        }
        if($user[0]->{'active'}=="2"){
            return json_encode(['status'=>400,'info'=>'<i class="fas fa-exclamation-circle"></i> Tu cuenta se encuentra inactiva, para mayor información acercate con tu tutor.']);
        }else if($user[0]->{'active'}=="3"){
            return json_encode(['status'=>400,'info'=>'<i class="fas fa-exclamation-circle"></i> No has verificado tu cuenta.']);
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
        return json_encode(['status'=>200,'data'=>$user,'count'=>count($user),'info_secret'=>'attempt 400']);

    }

    public function perfil_account_settings_view(){



        $user=auth()->user();

        $domicilio= DB::table('codigos')
        ->where('codigo','=',$user->code_postal)
        ->where('id',$user->localidad)
        ->first();


        return view('myperfil.perfil',compact('user','domicilio'));

    }
}
