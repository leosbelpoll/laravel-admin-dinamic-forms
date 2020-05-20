<?php

namespace App\Http\Controllers;

use App\Formulario;
use App\Standard;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StandardController extends Controller
{

    public function getAll(Request $request)
    {
        if ($request->get('parent')) {
            return Standard::where('standard_id', $request->get('parent'))->get();
        } else if ($idProject = $request->get('project')) {
            return Standard::whereHas('projects', function ($p) use ($idProject) {
                $p->where('project_id', $idProject);
            })->get();
        } else {
            return Standard::where('standard_id', null)->get();
        }
    }


    public function get($id)
    {
        $standard =  Standard::with('standards')->find($id);
        if (!$standard) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        $standard->formulario = Formulario::with('fields')->with('permissions')->with('roles')->find($standard->formulario_id);

        if ($standard->formulario) {
            $user = Auth::user();

            try {
                if ($standard->formulario->permissions) {
                    $standard->formulario->permissions->each(function ($permission) use ($user) {
                        if (!in_array($permission->name, $user->permissions->pluck('name')->toArray())) {
                            throw new Exception('No tiene permisos.');
                        }
                    });
                }

                if ($standard->formulario->roles) {
                    $standard->formulario->roles->each(function ($role) use ($user) {
                        if (!in_array($role->name, $user->roles->pluck('name')->toArray())) {
                            throw new Exception('No tiene permisos.');
                        }
                    });
                }
            } catch (Exception $e) {
                return response()->json([
                    'error' => 'No tiene permisos en este formulario'
                ], 401);
            }
        }

        return $standard;
    }
}
