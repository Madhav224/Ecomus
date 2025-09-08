<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];
     public $appends = [
        'brand_image_url',
        'total_products'
    ];

    public function getBrandImageUrlAttribute()
    {
        return asset(!empty($this->brand_image) && file_exists(public_path($this->brand_image)) ? $this->brand_image : 'upload/no-image.png');
    }
    public function getTotalProductsAttribute()
    {
        return $this?->Products()?->count() ?? 0;
    }

    public function Products()
    {
        return $this->hasMany(Product::class,'product_brand_id','id');
    }
}
