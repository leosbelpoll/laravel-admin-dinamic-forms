<?php

namespace App\Http\Controllers;

use App\SistemaAmortiguacion;

class SistemaAmortiguacionController extends Controller
{
    public function getAll()
    {
        return SistemaAmortiguacion::all();
    }
}
