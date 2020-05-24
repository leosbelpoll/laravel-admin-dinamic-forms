<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $table = 'values';

    protected $fillable = [
        'field_id', 'value', 'unique_group',
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
