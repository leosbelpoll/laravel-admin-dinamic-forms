<?php

namespace App\Http\Controllers;

use App\Standard;
use Illuminate\Http\Request;

class StandardController extends Controller
{

    public function getAll(){
        return Standard::all();
    }

    public function get($id){
        $standard =  Standard::find($id);
        if (!$standard) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        return $standard;
    }

    public function create(Request $request){
        $standard =  Standard::where("name", $request->input("name"))->first();
        if ($standard) {
            return response()->json([
                'error' => 'This name is already used'
            ], 409);
        }

        return Standard::create($request->all());
    }

    public function update($id, Request $request){
        $standard =  Standard::find($id);
        if (!$standard) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        $standard =  Standard::where("name", $request->input("name"))->first();
        if ($standard && $standard->id !== $id) {
            return response()->json([
                'error' => 'This name is already used'
            ], 409);
        }

        $item = Standard::findOrFail($id);
        $item->fill($request->all())->save();
        return $item;
    }

    public function delete($id){
        $standard =  Standard::find($id);
        if (!$standard) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        $item = Standard::findOrFail($id);
        $item->delete();
        return $item;
    }
}
