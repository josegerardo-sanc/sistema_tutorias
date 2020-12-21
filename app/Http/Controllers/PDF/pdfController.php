<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;



class pdfController extends Controller
{
    public function usuarios($tipo_usuario){

        // dd($tipo_usuario);


        $users="";
        if($tipo_usuario=="all_todos_users"){
            $users=DB::table('users')->get();
        }else{
            $users=DB::table('users')->where('tipo_usuario','=',$tipo_usuario)->get();
        }

        // return view('PDF.usuarios',compact('users'));

        $pdf = PDF::loadView('PDF.usuarios',compact('users'));
        return $pdf->download('usuarios.pdf');

        // Storage::disk('public')->put('usuarios.pdf', $pdf);
        // $data = PDF::loadView('vista-pdf', $data)
        // ->save(storage_path('app/public/') . 'archivo.pdf');


    }
}
