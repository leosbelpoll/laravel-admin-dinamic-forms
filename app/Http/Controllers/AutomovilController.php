<?php

namespace App\Http\Controllers;

use App\Automovil;

class AutomovilController extends Controller
{
    public function getAll(){
        return Automovil::all();
    }
}
