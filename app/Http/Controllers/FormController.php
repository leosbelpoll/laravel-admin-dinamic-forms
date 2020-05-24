<?php

namespace App\Http\Controllers;

use App\Model\Formulario;

class FormController extends Controller
{

    public function getAll(){
        return Formulario::all();
    }

    public function get($id){
        $form =  Formulario::find($id);
        if (!$form) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        return $form;
    }
}
