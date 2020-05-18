<?php

namespace App\Http\Controllers;

use App\TipoCombustible;

class TipoCombustibleController extends Controller
{
    public function getAll()
    {
        return TipoCombustible::all();
    }
}
