<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(CategorieImage::class);
    }

    public function desktopImage()
    {
        return $this->hasOne(CategorieImage::class)
            ->select('id', 'categorie_id', 'categorie_image_path')
            ->where('categorie_image_type', 'desktop');
    }

    public function productCount()
    {
        return Product::whereJsonContains('product_categorie_id', (string) $this->id)->count();
    }
    public function productIds()
    {
        return Product::whereJsonContains('product_categorie_id', (string) $this->id)->pluck('id');
    }

    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'categorie_parent_id');
    }

    public function children()
    {
        return $this->hasMany(Categorie::class, 'categorie_parent_id');
    }

    public function allCategoryIds()
    {
        return collect([$this->id])->merge(
            $this->children->flatMap->allCategoryIds()
        );
    }


    public function allProductsCount()
    {
        $categoryIds = $this->allCategoryIds()->map(fn($id) => (string) $id)->toArray();

        return Product::where(function ($q) use ($categoryIds) {
            foreach ($categoryIds as $id) {
                $q->orWhereJsonContains('product_categorie_id', $id);
            }
        })->count() ?? 0;
    }

    public function allProductIds()
    {
        $categoryIds = $this->allCategoryIds()->map(fn($id) => (string) $id)->toArray();

        return Product::where(function ($q) use ($categoryIds) {
            foreach ($categoryIds as $id) {
                $q->orWhereJsonContains('product_categorie_id', $id);
            }
        })->pluck('id');
    }

}
