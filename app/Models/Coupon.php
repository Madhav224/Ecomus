<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $appends = [
        'apply_count'
    ];

    protected $guarded = [];

    public function AppliedCoupon()
    {
        return $this->hasMany(AppliedCoupon::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class, 'coupon_id', 'id');
    }

    public function getApplyCountAttribute()
    {
        return $this->order->count() ?? 0;
    }



}
