<?php

namespace App\Http\Controllers;

use App\EstadoMedicion;

class EstadoMedicionController extends Controller
{
    public function getAll()
    {
        return EstadoMedicion::all();
    }
}
