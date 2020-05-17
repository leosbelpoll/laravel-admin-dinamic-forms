<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $table = 'values';

    protected $fillable = [
        'user_id', 'project_id', 'standard_id', 'formulario_id', 'field_id', 'value'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class);
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
