<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppliedCoupon extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function Cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
