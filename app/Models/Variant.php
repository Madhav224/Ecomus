<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(Variant::class, 'variant_parent_id');
    }

    public function children()
    {
        return $this->hasMany(Variant::class, 'variant_parent_id');
    }
}
