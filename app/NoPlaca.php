<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoPlaca extends Model
{
    protected $table = 'no_placas';

    protected $fillable = [
        'name', 'description',
    ];
}
