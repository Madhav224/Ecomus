<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $guarded = [];
    public $casts = [
        'variant_ids' => 'array',
        'variant_combination' => 'array',
        'product_variant_images' => 'array'
    ];

    public $appends = [
        'product_variant_thumbnail_image_url',
        'product_variant_images_url',
        'variant_combination_names',
        'variant_ids_names',
        // 'variant_child_ids',
        'variant_parent_ids',
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

        public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }


    public function getProductVariantThumbnailImageUrlAttribute()
    {
        // return asset(!empty($this->product_variant_thumbnail_image) && file_exists(public_path($this->product_variant_thumbnail_image)) ? $this->product_variant_thumbnail_image : 'upload/no-image.png');
        return !empty($this->product_variant_thumbnail_image) && file_exists(public_path($this->product_variant_thumbnail_image)) ?
            asset($this->product_variant_thumbnail_image) : null;
    }

    public function getProductVariantImagesUrlAttribute()
    {
        $variantImages = $this->product_variant_images;
        if ($variantImages) {
            foreach ($variantImages as $key => $value) {
                $variantImages[$key] = asset(file_exists(public_path($value)) ? $value : 'upload/no-image.png');
            }
        }
        return $variantImages;
    }


    public function getVariantCombinationNamesAttribute($value)
    {
        $value = $this->variant_combination;
        return $value ? implode(',', $value) : '';
    }
    public function getVariantIdsNamesAttribute($value)
    {
        $value = $this->variant_ids;
        return $value ? implode(',', $value) : '';
    }


    public function getVariantParentIdsAttribute()
    {
        return collect($this->variant_ids)
            ->map(fn($id) => Variant::find($id)?->variant_parent_id)
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    public function CartChild()
    {
        return $this->hasMany(CartChild::class);
    }
    public function OrderChild()
    {
        return $this->hasMany(OrderChild::class);
    }
    public function WishList()
    {
        return $this->hasMany(WishList::class);
    }

}
