<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderChild extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function ProductVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
