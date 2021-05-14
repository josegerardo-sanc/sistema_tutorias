<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;



use App\User;
use App\SocialProfile;

use Exception;

// use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse\RedirectResponse\redirect;

use App\Mail\MessageResetPassword;
use Illuminate\Support\Facades\Mail;


use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;


class loginController extends Controller
{


    public function redirectToProvider($driver)
    {


        // dd(env('FACEBOOK_CLIENT_PUBLIC'));

        $drivers = ['facebook', 'google'];

        if(in_array($driver, $drivers)){

            //el metodo socialite busca en el archivo de services las credenciales
            return Socialite::driver($driver)->redirect();
        }else{
            return redirect()->route('login')->with('info', $driver . 'No tenemos disponible esa red social aun para authenticacion');
        }


    }


    public function handleProviderCallback(Request $request, $driver)
    {
        

        if($request->get('error')){
            return redirect()->route('inicio');
        }

        $userSocialite = Socialite::driver($driver)->user();
        
        // dd($userSocialite);


        $idRedsocial=$userSocialite->getId();
        $correRedsocial=$userSocialite->getEmail();


        $userData = DB::table('users as us')
                    ->where('us.email','=',$correRedsocial)
                    ->get();
        

        $id_usuario="";

        if(count($userData)<=0){
            
            $social_profile = DB::table('social_profiles')
                   ->where('name','=',$driver)
                   ->where('email','=',$userSocialite->getEmail())
                   ->get();

            if(count($social_profile)<=0){
                return redirect('/')
                ->with('status_confirm',"El correo de {$driver} no esta registrado en la plataforma, debes iniciar sesión y luego dirigete a tu perfil y agregar el correo.");
            }

            $id_usuario=$social_profile[0]->{'id_user'};

        }else{
            $id_usuario=$userData[0]->{'id'};
        }

        

        // dd($id_usuario);

        //if(!$social_profile){

          
                    // if(!$user){
                    //     $user = User::create([
                    //         'name' => $userSocialite->getName(),
                    //         'email'=> $userSocialite->getEmail(),
                    //     ]);
                    // }

                    // $social_profile = SocialProfile::create([
                    //     'user_id' => $user->id,
                    //     'social_id' => $userSocialite->getId(),
                    //     'social_name' => $driver,
                    //     'social_avatar'  => $userSocialite->getAvatar()
                    // ]);
        //}

       

        $user = User::where('id', $id_usuario)->first();

        // dd($user);

        $msg=ucwords($user->nombre)." Has iniciado sesión con {$driver}.";

            auth()->login($user);

            if($user->tipo_usuario=="tutor"){
                return redirect('/tutor')->with('status_confirm',$msg);
            }
            if($user->tipo_usuario=="alumno"){
                return redirect('/alumno')->with('status_confirm',$msg);
            }
            if($user->tipo_usuario=="director"){
                return redirect('/director')->with('status_confirm',$msg);

            }
            if($user->tipo_usuario=="subdirector"){
                return redirect('/subdirector')->with('status_confirm',$msg);

            }
            if($user->tipo_usuario=="administrador"){
                return redirect('/Admin/user')->with('status_confirm',$msg);
            }

          return redirect('/')->with('status_confirm','Lo sentimos no tienes ningun perfil,comunicate con tu tutor');
        // return redirect()->route('home');
    }

   

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

        $datos_user=[];
        if($user->tipo_usuario=="alumno"){
            $datos_user=DB::table('datos_alumnos')
            ->leftJoin('carreras', 'datos_alumnos.carrera', '=', 'carreras.id_carrera')
            ->where('user_id_alumno','=',$user->id)
            ->first();
        }else if($user->tipo_usuario=="director"||$user->tipo_usuario=="subdirector"){
            $datos_user=DB::table('datos_docentes')
            ->where('user_id_docente','=',$user->id)
            ->first();
        }else if($user->tipo_usuario=="tutor"){

            $datos_user = DB::table('users')
                ->leftJoin('asignacion', 'users.id', '=', 'asignacion.user_id_asignado')
                ->leftJoin('carreras', 'asignacion.carrera', '=', 'carreras.id_carrera')
                ->leftJoin('datos_docentes', 'users.id', '=', 'datos_docentes.user_id_docente')
                ->select('datos_docentes.*','asignacion.*','carreras.carrera','carreras.id_carrera')
                ->where('users.id','=',$user->id)
                ->get();

            $datos_user=$datos_user[0];

        }

        // dd($datos_user);

        $dataSocialiteProfile=DB::table('social_profiles')
        ->where('id_user','=',$user->id)
        ->get();

        $user->{'facebook'}=$user->email;
        $user->{'gmail'}=$user->email;

        foreach ($dataSocialiteProfile as $key => $redSocial) {
            
            if($redSocial->name=="facebook"){
                $user->{'facebook'}=$redSocial->email;
            }

            if($redSocial->name=="google"){
                $user->{'gmail'}=$redSocial->email;
            }
        }
        // dd($user);
        return view('myperfil.perfil',compact('user','domicilio','datos_user'));

    }


    public function change_cuentas_social(Request $request){
        
        $data=$request->all();
        $user=auth()->user();
        $MENSAJE_ERROR="";

        if($data['facebook_socialite']==""){
            $MENSAJE_ERROR.="<li>Si no cuentas con cuenta de Facebook ,ingresa el correo con el que te diste de alta</li>";
        }

        if($data['gmail_socialite']==""){
            $MENSAJE_ERROR.="<li>Si no cuentas con cuenta de Gmail ,ingresa el correo con el que te diste de alta.</li>";
        }
        
        if($MENSAJE_ERROR!=""){
            return json_encode(['status'=>400,'info'=>$MENSAJE_ERROR]);
        }



        try {
             $social_profiles = DB::table('social_profiles')->count();

            //  return json_encode(['status'=>200,'info'=>'Registro de cuenta exitoso']);
            
            $data['facebook_socialite']=trim($data['facebook_socialite']);
            $data['gmail_socialite']=trim($data['gmail_socialite']);

             if($social_profiles<=0){

                    DB::table('social_profiles')->insert([
                        ['email' =>$data['facebook_socialite'], 'name' =>"facebook",'id_user'=>$user->id],
                        ['email' =>$data['gmail_socialite'], 'name' =>"google",'id_user'=>$user->id]
                    ]);

                    return json_encode(['status'=>200,'info'=>'Registro de cuenta exitoso']);

                }else{
                    $updateFacebook=DB::table('social_profiles')
                    ->where('id_user',$user->id)
                    ->where('name',"facebook")
                    ->update(
                        [
                            'email' =>$data['facebook_socialite']
                        ]);

                    $updateGmail=DB::table('social_profiles')
                    ->where('id_user',$user->id)
                    ->where('name',"gmail")
                    ->update([
                        'email' =>$data['gmail_socialite']
                        ]);

                    return json_encode(['status'=>200,'info'=>'Actualizacion de cuenta exitoso']);
             }

        } catch (\Exception $e) {
            return json_encode(['status'=>400,'info'=>'Se perdio comunicación con el servidor, intentelo de nuevo']);
        }

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


        //dd($datos_get);

        $data_user=DB::table('users')->where('id','=',$datos_get[0])->get();
		$password_email=$datos_get[1];

        if(count($data_user)<=0){
             $mensaje_activacion="No hemos encontrado registro con tu correo ,comunicate con tu tutor.";
             return redirect('/')->with('status_confirm',$mensaje_activacion);
        }


        if($data_user[0]->{'active'}==1||$data_user[0]->{'active'}=="1"){
            $mensaje_activacion=ucwords($data_user[0]->{'nombre'})." ya has utilizado este enlace para activar tu cuenta.";
            return redirect('/')->with('status_confirm',$mensaje_activacion);
        }
        if($data_user[0]->{'active'}==2||$data_user[0]->{'active'}=="2"){
            $mensaje_activacion=ucwords($data_user[0]->{'nombre'})." Tu cuenta fue desactivada, por tu tutor o el administrador,comunicate con ellos.";
            return redirect('/')->with('status_confirm',$mensaje_activacion);
        }

           //dd($data_user);

           if (Auth::attempt(['email' => $data_user[0]->{'email'},'password' =>$password_email],false)) {

			   //dd($data_user[0]->tipo_usuario);


			    $fecha_now=date('Y-m-d H:i:s');

       			 if(count($data_user)>0){
					DB::table('users')->where('id','=',$datos_get[0])
					->update([
						'email_verified_at' =>$fecha_now,
						'active'=>1
					]);


                $msg=ucwords($data_user[0]->{'nombre'})." Has activado tu cuenta.";


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
           return redirect('/')->with('status_confirm', 'Lo sentimos, ha ocurrido un error al querer verificar su cuenta                         Intentelo de nuevo, si el error persiste acercate a control escolar.');
        }
    }


    public function enviarCorreo_resetPassword(Request $request){
        $data=$request->all();
        // return json_encode(['status'=>200]);

        $data_user=DB::table('users')->where('email','=',$data['correo'])->get();

        if(count($data_user)<=0){

            return json_encode(['status'=>400,
            'info'=>'<i class="fas fa-exclamation-circle"></i> La cuenta de correo electrónico no se encunetra en la bases de datos.']);

        }

        $data['nombre']=$data_user[0]->{'nombre'};
        $data['ap_paterno']=$data_user[0]->{'ap_paterno'};
        $data['ap_materno']=$data_user[0]->{'ap_materno'};
        $data['curp']=$data_user[0]->{'curp'};
        $data['id_generado_user']=$data_user[0]->{'id'};

        // envio de correo
        try {

            $token=md5($data['nombre'].'token_reset_password_correo'.$data['ap_paterno'].$data['ap_materno'].$data['curp']);
            $data['id_generado_user']=base64_encode($data['id_generado_user'].'---'.$token);
            Mail::to($data['correo'])->send(new MessageResetPassword($data));

            return json_encode(['status'=>200]);

        } catch (\Throwable $th) {
            return json_encode(['status'=>400,'info'=>'Lo sentimos, ha ocurrido un error,intentelo de nuevo']);
        }
    }

    public function redirect_view_password_reset_user($id){

        $datos_get=explode('---',base64_decode($id));

        $data_user=DB::table('users')->where('id','=',$datos_get[0])->get();


        // dd($data_user);
        if(count($data_user)<=0){
            $mensaje_activacion=ucwords($data_user[0]->{'nombre'})." <i class='fas fa-exclamation-circle'></i> Tu enlace fue corrompido,Intentelo de nuevo";
            return redirect('/')->with('status_confirm',$mensaje_activacion);
        }
        # /restablecer_password



        return view('Correos.nuevo_password',compact('data_user'));
        //return redirect()->route('restablecer_password',['id'=>$id_user]);

    }


    public function NuevoPassword_user(Request $request){


        $data=$request->all();
        $data_user=DB::table('users')->where('id','=',$data['id_user_db'])->get();
        $password_new=$data['password_nueva'];


        // dd($data_user);

        if(count($data_user)>0){

            DB::table('users')->where('id','=',$data['id_user_db'])
            ->update([
                'password'=>Hash::make($password_new)
              ]);

           if (Auth::attempt(['email' => $data_user[0]->{'email'},'password' =>$password_new],false)) {

                $msg=ucwords($data_user[0]->{'nombre'})." Has cambiado tu clave de acceso sastifactoriamente.";

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
           return redirect('/')->with('status_confirm', 'Lo sentimos, ha ocurrido un error al querer verificar su cuenta</br> Intentelo de nuevo, si el error persiste acercate a control escolar.');
        }
    }




}
