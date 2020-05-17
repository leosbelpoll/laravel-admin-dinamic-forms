<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'fields';

    protected $fillable = [
        'name', 'description', 'type', 'rules', 'position',
    ];

    public function formularios()
    {
        return $this->belongsToMany(Formulario::class);
    }

    public function setRulesAttribute($rules) {
        $this->attributes['rules'] = $rules ? implode ("|", $rules) : null;
    }

    public function getRulesAttribute($rules) {
        return $rules ? explode("|", $rules) : null;
    }
}
