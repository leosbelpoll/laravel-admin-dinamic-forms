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

    public function create(Request $request){
        $project =  Project::where("name", $request->input("name"))->first();
        if ($project) {
            return response()->json([
                'error' => 'This name is already used'
            ], 409);
        }

        return Project::create($request->all());
    }

    public function update($id, Request $request){
        $project =  Project::find($id);
        if (!$project) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        $project =  Project::where("name", $request->input("name"))->first();
        if ($project && $project->id !== $id) {
            return response()->json([
                'error' => 'This name is already used'
            ], 409);
        }

        $item = Project::findOrFail($id);
        $item->fill($request->all())->save();
        return $item;
    }

    public function delete($id){
        $project =  Project::find($id);
        if (!$project) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        $item = Project::findOrFail($id);
        $item->delete();
        return $item;
    }
}
