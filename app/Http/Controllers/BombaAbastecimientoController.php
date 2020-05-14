<?php

namespace App\Http\Controllers;

use App\BombaAbastecimiento;

class BombaAbastecimientoController extends Controller
{
    public function getAll()
    {
        return BombaAbastecimiento::all();
    }
}
