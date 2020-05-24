<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'fields';

    protected $fillable = [
        'name', 'label', 'description', 'type', 'rules', 'position', 'selector', 'placeholder'
    ];

    public function formularios()
    {
        return $this->belongsToMany(Formulario::class);
    }

    public function setRulesAttribute($rules) {
        $this->attributes['rules'] = $rules ? implode("|", $rules) : null;
    }

    public function getRulesAttribute($rules) {
        return $rules ? explode("|", $rules) : null;
    }
}
