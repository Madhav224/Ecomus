<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartChild extends Model
{
    protected $guarded = [];

    protected $appends = [
        'price',
        'total_price',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
    public function ProductVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function getPriceAttribute()
    {
        $product = $this->product;
        $productVariant = $product?->ProductVariants()->where('id', $this?->product_variant_id)->where('product_id', $this?->product_id)->first();
        $price = $productVariant?->product_variant_price ?? $product?->product_price;

        return $price ?? 0;
    }
    public function getTotalPriceAttribute()
    {
        return ($this->price * $this->qty) ?? 0;
    }



}
