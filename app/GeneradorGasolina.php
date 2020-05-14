<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneradorGasolina extends Model
{
    protected $table = 'generadores_gasolina';

    protected $fillable = [
        'name', 'description',
    ];
}
