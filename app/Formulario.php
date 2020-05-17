<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $table = 'formularios';

    protected $fillable = [
        'name', 'description',
    ];

    public function standards()
    {
        return $this->belongsTo(Standard::class);
    }

    public function fields()
    {
        return $this->belongsToMany(Field::class);
    }
}
