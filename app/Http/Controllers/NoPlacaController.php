<?php

namespace App\Http\Controllers;

use App\BombaAbastecimiento;

class NoPlacaController extends Controller
{
    public function getAll(){
        return BombaAbastecimiento::all();
    }
}
