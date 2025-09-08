<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFlag extends Model
{
    protected $guarded = [];
    public $casts = [
        'product_id' => 'array'
    ];

    public function getProductNamesAttribute()
    {
        $productIds = $this->product_id ?? [] ;
        if (!$productIds)
            return '--';

        $products = Product::whereIn('id', $productIds)->pluck('product_name')->toArray();
        return implode(', ', $products);
    }
}
