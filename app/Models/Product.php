<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Predis\Command\Traits\Get\Get;
use Carbon\Carbon;

class Product extends Model
{
    protected $guarded = [];
    public $casts = [
        'product_images' => 'array',
        'product_details' => 'array',
        'product_additional_details' => 'array',
        'product_categorie_id' => 'array',
        'frequently_bought' => 'array',
    ];

    public $appends = [
        'size_variants',
        'color_variants',
        'category_names',
        'product_thumbnail_image_url',
        'product_images_url',
        'product_variant_parent_ids',
        'product_variants_data',
        'product_variants_child_ids',
    ];

    public function getCategoryNamesAttribute()
    {
        $productIds = $this->product_categorie_id;

        if (!$productIds)
            return [];

        $products_categpries = Categorie::whereIn('id', $productIds)->pluck('categorie_name')->toArray();
        return $products_categpries ?? [];
    }

    public function getProductThumbnailImageUrlAttribute()
    {
        return asset(!empty($this->product_thumbnail_image) && file_exists(public_path($this->product_thumbnail_image)) ? $this->product_thumbnail_image : 'upload/no-image.png');
    }

    public function getProductImagesUrlAttribute()
    {
        $productImages = $this->product_images;
        if ($productImages) {
            foreach ($productImages as $key => $value) {
                $productImages[$key] = asset(file_exists(public_path($value)) ? $value : 'upload/no-image.png');
            }
        }
        return $productImages;
    }
    public function getProductVariantParentIdsAttribute()
    {
        return $this->ProductVariants->pluck('variant_parent_ids')->flatten()->unique()->toArray();
    }
    public function getProductVariantsDataAttribute()
    {
        return Variant::whereIn('id', $this->product_variant_parent_ids)
            ->with(['children'])
            ->get()
            ->toArray();
    }

    public function getProductVariantsChildIdsAttribute()
    {
        return $this->ProductVariants->pluck('variant_ids')->flatten()->unique()->toArray();
    }

    public function ProductVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function ProductReview()
    {
        return $this->hasMany(ProductReview::class);
    }
    public function starRatingBreakdown()
    {
        $total = $this->ProductReview()->count();

        return collect(range(5, 1))->mapWithKeys(function ($star) use ($total) {
            $count = $this->ProductReview()->where('stars', $star)->count();
            $percent = $total ? round(($count / $total) * 100) : 0;
            return [$star => ['count' => $count, 'percent' => $percent]];
        });
    }

    public function allReviewImages()
    {
        return $this->ProductReview()
            ->get()
            ->flatMap(function ($review) {
                return $review->review_images_url ?? [];
            })
            ->filter()
            ->values();
    }

    public function averageStarRating()
    {
        $avg = $this->ProductReview()->avg('stars');
        return $avg ? round($avg) : 0;
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

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'product_brand_id', 'id');
    }

    public function getSizeVariantsAttribute()
    {
        $sizeParent = Variant::whereIn('variant_name', ['size', 'Size'])->first();
        if (!$sizeParent) {
            return [];
        }
        $childIds = $this->product_variants_child_ids;
        if (empty($childIds)) {
            return [];
        }
        return Variant::select('id', 'variant_name', 'variant_value')
            ->where('status', 'active')
            ->where('variant_parent_id', $sizeParent->id)
            ->whereIn('id', $childIds)
            ->get()
            ->toArray();
    }

    public function getColorVariantsAttribute()
    {
        $colorParent = Variant::whereIn('variant_name', ['color', 'colors', 'colour'])->first();
        if (!$colorParent) {
            return [];
        }
        $childIds = $this->product_variants_child_ids;
        if (empty($childIds)) {
            return [];
        }
        return Variant::select('id', 'variant_name', 'variant_value')
            ->where('status', 'active')
            ->where('variant_parent_id', $colorParent->id)
            ->whereIn('id', $childIds)
            ->get()
            ->toArray();
    }

    public function isNewProduct()
    {
        return $this->created_at && $this->created_at->gt(Carbon::now()->subDays(2));
    }
}
