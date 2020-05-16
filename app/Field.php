<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'fields';

    protected $fillable = [
        'name', 'description', 'type', 'rules',
    ];

    public function forms()
    {
        return $this->belongsToMany(Form::class);
    }

    public function values()
    {
        return $this->hasMany(Value::class);
    }
}
