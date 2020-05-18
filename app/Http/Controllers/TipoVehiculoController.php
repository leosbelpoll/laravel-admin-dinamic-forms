<?php

namespace App\Http\Controllers;

use App\TipoVehiculo;

class TipoVehiculoController extends Controller
{
    public function getAll()
    {
        return TipoVehiculo::all();
    }
}
