<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = 'modelos';

    protected $fillable = [
        'marca_id', 'name', 'description',
    ];

    public function marca() {
        return $this->belongsTo(Marca::class);
    }
}
