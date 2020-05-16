<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'forms';

    protected $fillable = [
        'name', 'description',
    ];

    public function standards()
    {
        return $this->hasMany(Standard::class);
    }

    public function fields()
    {
        return $this->belongsToMany(Field::class);
    }

    public function values()
    {
        return $this->hasMany(Value::class);
    }
}
