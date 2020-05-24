<?php

namespace App\Http\Controllers;

use App\Model\Field;
use App\Model\FieldTypeEnum;
use App\Model\User;
use App\Model\Value;
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
            'formulario_id' => $request->input('formulario_id'),
        ];

        $validator = Validator::make($knownValues, [
            'username' => 'required',
            'formulario_id' => 'required|numeric'
        ]);

        $errors->merge($validator->errors());

        if ($errors->isNotEmpty()) {
            return response()->json([
                'errors' => $errors
            ], 400);
        } else {
            $user = null;

            if ($username = $request->input('username')) {
                $user = User::where('username', $username)->first();
            }

            $fields = json_decode($request->input('fields'));

            $datetime = date('Y-m-d H:i:s');
            $uniqueGroup =  md5(microtime());

            foreach ($fields as $field) {
                $dbField = Field::find($field->id);
                $value = new Value([
                    'user_id' => $user->id,
                    'formulario_id' => $request->input('formulario_id'),
                    'field_id' => $field->id,
                    'value' => $field->value
                ]);

                if ($dbField->type === FieldTypeEnum::IMAGE) {
                    if ($image = $request->file('field_' . $dbField->id)) {
                        $imageName = md5(microtime()) . '.' . $image->getClientOriginalExtension();
                        $image->move('app/public/', $imageName);
                        $value->value = $imageName;
                    }
                }

                $value->timestamps = false;
                $value->created_at = $datetime;
                $value->updated_at = $datetime;
                $value->unique_group = $uniqueGroup;

                $value->save();
            }

            return response()->json(200);
        }
    }
}
