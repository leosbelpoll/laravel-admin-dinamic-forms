<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name', 'description',
    ];

    public function standards()
    {
        return $this->belongsToMany(Standard::class);
    }
}
