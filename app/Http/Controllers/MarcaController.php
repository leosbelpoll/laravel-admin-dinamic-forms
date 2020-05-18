<?php

namespace App\Http\Controllers;

use App\Marca;

class MarcaController extends Controller
{
    public function getAll()
    {
        return Marca::all();
    }
}
