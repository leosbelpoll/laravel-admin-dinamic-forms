<?php

namespace App\Http\Controllers;

use App\Modelo;

class ModeloController extends Controller
{
    public function getAll()
    {
        return Modelo::all();
    }
}
