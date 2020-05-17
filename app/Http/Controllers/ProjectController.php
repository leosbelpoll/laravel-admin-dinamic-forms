<?php

namespace App\Http\Controllers;

use App\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function getAll(){
        return Project::all();
    }

    public function get($id){
        $project =  Project::find($id);
        if (!$project) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        return $project;
    }
}
