<?php

namespace App\Http\Controllers;

use App\NoPlaca;

class NoPlacaController extends Controller
{
    public function getAll(){
        return NoPlaca::all();
    }
}
