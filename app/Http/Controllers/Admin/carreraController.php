<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;



class carreraController extends Controller
{
    public function create(){

        $Listcarreras=DB::table('carreras')->get();

        foreach ($Listcarreras as $key => $carrera) {
            $count_alumnos=0;

            $count_alumnos = DB::table('datos_alumnos')
            ->where('carrera','=',$carrera->{'id_carrera'})
            ->count();

          $Listcarreras[$key]->{'numero_alumnos'}=$count_alumnos;
        }


        // dd($Listcarreras);
        return view('admin.carreras',compact('Listcarreras'));
    }

    public function store(Request $request){

        $data=$request->all();
        $msg_carrera="";
        // return json_encode(['status'=>400,'info'=>$data]);

        if($data['action']=="store"&&$data['id_carrera']==""){
                $validator = Validator::make($request->all(), [
                    'carrera' => 'required|string|unique:carreras|max:100'
                ]);

                if ($validator->fails()) {
                    return json_encode(['errors'=>$validator->errors()]);
                }

                try {
                    DB::table('carreras')->insert([
                        'carrera'=>$data['carrera']
                    ]);
                } catch (\Exception $e) {
                    return json_encode(['status'=>400,'<i class="fas fa-exclamation-circle"></i> SE HA PERDIDO COMUNICACIÓN CON EL SERVIDOR'.$e->getMessage()]);
                }

            $msg_carrera="<i class='fas fa-database'></i> SE HA REGISTRADO CON EXITO LA CARRERA: ".$data['carrera'];

        }else if($data['action']=="update"&&$data['id_carrera']!=""){

            $carreras = DB::table('carreras')->where('id_carrera','=',$data['id_carrera'])->first();


            $validatedData = Validator::make($data, [
                'carrera'=>'required','string','max:50',Rule::unique('carreras','carrera')->ignore($carreras->id_carrera, 'id_carrera'),
            ]);

            if($validatedData->fails()) {
                return json_encode(['withErrrors'=>$validatedData->errors()->all()]);
            }

            DB::table('carreras')
              ->where('id_carrera',$data['id_carrera'])
              ->update(['carrera' =>$data['carrera']]);

            $msg_carrera="<i class='fas fa-database'></i> SE HA ACTUALIZADO CON EXITO LA CARRERA";
        }

        $Listcarreras=DB::table('carreras')->get();

        foreach ($Listcarreras as $key => $carrera) {
            $count_alumnos=0;

            $count_alumnos = DB::table('datos_alumnos')
            ->where('carrera','=',$carrera->{'id_carrera'})
            ->count();

          $Listcarreras[$key]->{'numero_alumnos'}=$count_alumnos;
        }

        return json_encode(['data'=>$Listcarreras,'status'=>200,'info'=>$msg_carrera]);
    }



    public function getCarreras(){
        try {
            $Listcarreras=DB::table('carreras')->get();
            return json_encode(['data'=>$Listcarreras,'status'=>200]);
        } catch (\Exception $e) {
            return json_encode(['status'=>400,'<i class="fas fa-exclamation-circle"></i> SE HA PERDIDO COMUNICACIÓN CON EL SERVIDOR'.$e->getMessage()]);
        }
    }


    public function destroy($id){

        $carreras = DB::table('carreras')->where('id_carrera','=',$id)->first();
        $count_alumnos = DB::table('datos_alumnos')->where('carrera','=',$carreras->{'id_carrera'})->count();

        if($count_alumnos>0){
            return json_encode(['status'=>400,'info'=>'NOTA:NO SE PUEDE ELIMINAR UNA CARRERA CUANDO TIENE ALUMNOS ASIGNADOS. <i class="fas fa-graduation-cap"></i> NUMERO DE ALUMNOS #'.$count_alumnos]);
        }


        $carreras = DB::table('carreras')->where('id_carrera','=',$id)->delete();

        $Listcarreras=DB::table('carreras')->get();

        foreach ($Listcarreras as $key => $carrera) {
            $count_alumnos=0;

            $count_alumnos = DB::table('datos_alumnos')
            ->where('carrera','=',$carrera->{'id_carrera'})
            ->count();

          $Listcarreras[$key]->{'numero_alumnos'}=$count_alumnos;
        }
        return json_encode(['status'=>200,'info'=>'Carrera eliminada con exito','data'=>$Listcarreras]);

    }
}
