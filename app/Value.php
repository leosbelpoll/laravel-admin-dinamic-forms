<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $table = 'values';

    protected $fillable = [
        'user_id', 'project_id', 'standard_id', 'form_id', 'field_id', 'value'
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

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
