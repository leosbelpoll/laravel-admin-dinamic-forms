<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SistemaAmortiguacion extends Model
{
    protected $table = 'sistemas_amortiguacion';

    protected $fillable = [
        'name', 'description',
    ];
}
