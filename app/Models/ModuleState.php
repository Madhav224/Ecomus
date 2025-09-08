<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleState extends Model
{
    protected $guarded = [];

    public function Users()
    {
        return $this->hasMany(User::class, 'user_state_id');
    }
    public function UserAddress()
    {
        return $this->hasMany(UserAddress::class, 'state_id', 'state_id', 'id');
    }
    public function OrderAddress()
    {
        return $this->hasMany(User::class);
    }
}
