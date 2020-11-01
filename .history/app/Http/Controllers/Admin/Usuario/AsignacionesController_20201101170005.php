<?php

namespace App\Http\Controllers\Admin\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsignacionesController extends Controller
{
    
    public function create(){


        return view('admin.asignaciones.create')

    }
}
