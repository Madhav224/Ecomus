<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleCountry extends Model
{
    protected $guarded = [];

    public function Users()
    {
        return $this->hasMany(User::class, 'user_country_id');
    }
    public function UserAddress()
    {
        return $this->hasMany(UserAddress::class, 'country_id', 'id');
    }
    public function OrderAddress()
    {
        return $this->hasMany(User::class);
    }
}
