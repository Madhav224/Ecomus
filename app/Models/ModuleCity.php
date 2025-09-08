<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleCity extends Model
{
    protected $guarded = [];

    public function Users()
    {
        return $this->hasMany(User::class,'user_city_id');
    }
}
