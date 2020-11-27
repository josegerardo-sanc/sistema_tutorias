<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



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
        $validator = Validator::make($request->all(), [
            'carrera' => 'required|string|unique:carreras|max:100'
        ]);

        if ($validator->fails()) {
            return json_encode(['errors'=>$validator->errors()]);
        }

        $carrera=strtolower($data['carrera']);
        $CARRERA=ucwords($carrera);

        try {
            DB::table('carreras')->insert([
                'carrera'=>$CARRERA
            ]);
        } catch (\Exception $e) {
            return json_encode(['status'=>400,'<i class="fas fa-exclamation-circle"></i> SE HA PERDIDO COMUNICACIÓN CON EL SERVIDOR'.$e->getMessage()]);
        }

        $Listcarreras=DB::table('carreras')->get();

        return json_encode(['data'=>$Listcarreras,'status'=>200,'info'=>"<i class='fas fa-database'></i> SE HA REGISTRADO CON EXITO LA CARRERA:  ".$CARRERA]);

    }



    public function getCarreras(){
        try {
            $Listcarreras=DB::table('carreras')->get();
            return json_encode(['data'=>$Listcarreras,'status'=>200]);
        } catch (\Exception $e) {
            return json_encode(['status'=>400,'<i class="fas fa-exclamation-circle"></i> SE HA PERDIDO COMUNICACIÓN CON EL SERVIDOR'.$e->getMessage()]);
        }
    }

}
