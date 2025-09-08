<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $guarded = [];

    public $casts = [
        'billing_address' => 'array',
        'delivery_address' => 'array',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $lastNum = (int) Order::max(DB::raw('CAST(SUBSTRING(order_number, 6) AS UNSIGNED)')) ?? 0;
            $order->order_number = 'ORDER' . str_pad($lastNum + 1, 2, '0', STR_PAD_LEFT);
        });
    }

    public function child()
    {
        return $this->hasMany(OrderChild::class);
    }

    public function address()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function PaymentHistory()
    {
        return $this->hasMany(PaymentHistory::class, 'order_id', 'id');
    }

    public function OrderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status', 'id');
    }

    public function Coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }
}
