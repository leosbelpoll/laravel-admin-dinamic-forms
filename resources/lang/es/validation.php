<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'unique' => 'Este :attribute ya ha sido asignado.',
    'required' => 'El campo :attribute es obligatorio.',
    'numeric' => 'El campo :attribute es numérico.',
    'max' => [
        'numeric' => 'El campo :attribute no puede ser mayor que :max.',
        'file' => 'El campo :attribute no puede exceder los :max kilobytes.',
        'string' => 'El campo :attribute no puede tener más de :max caracteres.',
        'array' => 'EL campo :attribute no puede tener  más de :max elementos.',
    ],
];
