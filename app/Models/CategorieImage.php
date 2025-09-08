<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieImage extends Model
{
    protected $guarded = [];
    public $appends = [
        'categorie_image_url'
    ];


    // Accessor for the custom 'table_name' attribute
    public function getTableNameAttribute()
    {
        return encrypt_to($this->getTable()); // Will return 'categorie_images'
    }

    public function categories()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function getCategorieImageUrlAttribute()
    {
        $Images = json_decode($this->categorie_image_path) ?? [];

        if ($Images) {
            foreach ($Images as $key => $value) {
                $Images[$key] = asset(file_exists(public_path($value)) ? $value : 'upload/no-image.png');
            }
        } else {
            $Images[] = asset('upload/no-image.png');
        }
        return $Images;
    }

}
