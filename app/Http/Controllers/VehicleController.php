<?php

namespace App\Http\Controllers;

use App\User;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    public function store(Request $request)
    {
        $userIdValidation = 'numeric';
        $user = null;
        if (!$username = $request->input('username')) {
            $userIdValidation = 'required|numeric';
        } else {
            $user = User::where('username', $username)->first();
        }

        $validator = Validator::make($request->all(), [
            'user_id' => $userIdValidation,
            'project_id' => 'required|numeric',
            'standard_id' => 'required|numeric',
            'no_placa_id' => 'required|numeric',
            'recorrido_inicial' => 'required|numeric',
            'recorrido_inicial_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'recorrido_final' => 'required|numeric',
            'recorrido_final_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'galones_comprados' => 'required|numeric',
            'galones_comprados_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bomba_abastecimiento_id' => 'required|numeric',
            'sistema_amortiguacion_id' => 'required|numeric',
            'explicacion_capacitacion' => 'required',
            'estado_medicion_id' => 'required|numeric',
            'presion_neumaticos' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        } else {
            $vehicle = new Vehicle($request->all());

            if ($request->input('username')) {
                $vehicle->user_id = $user->id;
            }

            if ($recorridoInicialImage = $request->file('recorrido_inicial_image')) {
                $recorridoInicialImageName = time() . '.' . $recorridoInicialImage->getClientOriginalExtension();
                $recorridoInicialImage->move('app/public/', $recorridoInicialImageName);
                $vehicle->recorrido_inicial_image = $recorridoInicialImageName;
            }

            if ($recorridoFinalImage = $request->file('recorrido_final_image')) {
                $recorridoFinalImageName = time() . '.' . $recorridoFinalImage->getClientOriginalExtension();
                $recorridoFinalImage->move('app/public/', $recorridoFinalImageName);
                $vehicle->recorrido_final_image = $recorridoFinalImageName;
            }

            if ($galonesCompadosImage = $request->file('galones_comprados_image')) {
                $galonesCompadosImageName = time() . '.' . $galonesCompadosImage->getClientOriginalExtension();
                $galonesCompadosImage->move('app/public/', $galonesCompadosImageName);
                $vehicle->galones_comprados_image = $galonesCompadosImageName;
            }

            $vehicle->save();

            return $vehicle;
        }
    }
}
