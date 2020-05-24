<?php

namespace App\Http\Controllers;

use App\Model\Formulario;

class FormularioController extends Controller
{

    public function getAll(){
        return Formulario::all();
    }

    public function get($id){
        $form =  Formulario::find($id)->with('fields')->get();
        if (!$form) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        return $form;
    }
}
