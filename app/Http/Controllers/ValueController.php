<?php

namespace App\Http\Controllers;

use App\User;
use App\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ValueController extends Controller
{
    public function saveValues(Request $request)
    {
        $errors = new MessageBag();

        $knownValues = [
            'username' => $request->input('username'),
            'project_id' => $request->input('project_id'),
            'standard_id' => $request->input('standard_id'),
            'formulario_id' => $request->input('formulario_id'),
        ];

        $validator = Validator::make($knownValues, [
            'username' => 'required',
            'project_id' => 'required|numeric',
            'standard_id' => 'required|numeric',
            'formulario_id' => 'required|numeric'
        ]);

        $errors->merge($validator->errors());

        if ($errors->isNotEmpty()) {
            return response()->json([
                'errors' => $errors
            ], 400);
        } else {
            // $user = null;
            // if (!$username = $request->input('username')) {
            //     $user = User::where('username', $username)->first();
            // }

            // $fields = json_decode($request->input('fields'));

            // foreach ($fields as $key => $value) {
            //     var_dump($key);
            //     var_dump($value);
            // }

            return response()->json(200);
        }
    }
}
