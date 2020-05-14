<?php

namespace App\Http\Controllers;

use App\GeneradorGasolina;

class GeneradorGasolinaController extends Controller
{
    public function getAll()
    {
        return GeneradorGasolina::all();
    }
}
