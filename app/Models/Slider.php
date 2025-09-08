<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    protected $guarded = [];
    public $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        return asset(!empty($this->image)&& file_exists(public_path($this->image)) ? $this->image : 'upload/no-image.png');
    }
}
