<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    protected $table = 'tipos_vehiculo';

    protected $fillable = [
        'name', 'description',
    ];
}
