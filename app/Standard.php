<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    protected $table = 'standards';

    protected $fillable = [
        'name', 'description', 'standard_id', 'type',
    ];

    public function standards()
    {
        return $this->hasMany(Standard::class);
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
