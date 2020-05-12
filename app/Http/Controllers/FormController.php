<?php

namespace App\Http\Controllers;

use App\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function getAll(){
        return Form::all();
    }

    public function get($id){
        $form =  Form::find($id);
        if (!$form) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        return $form;
    }

    public function create(Request $request){
        $form =  Form::where("name", $request->input("name"))->first();
        if ($form) {
            return response()->json([
                'error' => 'This name is already used'
            ], 409);
        }

        return Form::create($request->all());
    }

    public function update($id, Request $request){
        $form =  Form::find($id);
        if (!$form) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        $form =  Form::where("name", $request->input("name"))->first();
        if ($form && $form->id !== $id) {
            return response()->json([
                'error' => 'This name is already used'
            ], 409);
        }

        $item = Form::findOrFail($id);
        $item->fill($request->all())->save();
        return $item;
    }

    public function delete($id){
        $form =  Form::find($id);
        if (!$form) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        $item = Form::findOrFail($id);
        $item->delete();
        return $item;
    }
}
