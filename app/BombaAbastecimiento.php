<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BombaAbastecimiento extends Model
{
    protected $table = 'bombas_abastecimiento';

    protected $fillable = [
        'name', 'description',
    ];
}
