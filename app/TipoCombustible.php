<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCombustible extends Model
{
    protected $table = 'tipos_combustible';

    protected $fillable = [
        'name', 'description',
    ];
}
