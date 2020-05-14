<?php

namespace App\Http\Controllers;

use App\BombaAbastecimiento;
use Illuminate\Http\Request;

class BombaAbastecimientoController extends Controller
{
    public function getAll()
    {
        return BombaAbastecimiento::all();
    }
}
