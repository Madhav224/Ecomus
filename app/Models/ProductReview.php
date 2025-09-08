<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $guarded = [];

    public $casts = [
        'review_images' => 'array'
    ];

    protected $appends = [
        'since',
        'review_images_url'
    ];

    public function getReviewImagesUrlAttribute()
    {
        $images = $this->review_images;

        if ($images) {
            foreach ($images as $key => $value) {
                $images[$key] = asset(file_exists(public_path($value)) ? $value : 'upload/no-image.png');
            }
        } else {
            $images[] = asset('upload/no-image.png');
        }
        return $images;
    }
    public function getSinceAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
