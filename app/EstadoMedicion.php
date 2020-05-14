<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoMedicion extends Model
{
    protected $table = 'estados_medicion';

    protected $fillable = [
        'name', 'description',
    ];
}
