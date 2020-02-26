<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['group_id', 'name', 'description'];

    public function group()
    {
        return $this->belongsTo(Groups::class, 'group_id');
    }
}
