<?php

namespace App\Http\Controllers\helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CodepostalController extends Controller
{


    public function GetCodePostal(Request $request){

        $data=$request->all();

        $codigoPostal=$data['codigoPostal'];

        $mexico = DB::table('codigos')->where('codigo', $codigoPostal)->get();
        return response()->json(['data'=>$mexico,'codigoPostalReferencia'=>$codigoPostal]);

    }

}
