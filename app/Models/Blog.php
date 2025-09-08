<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Blog extends Model
{
    protected $guarded = [];
    protected $casts = [
        'categories' => 'array',
    ];


    public function BlogCategories()
    {
        $categorie_ids = $this->categories ?? [];

        $categories = Categorie::whereIn('id', $categorie_ids)
            ->select('id', 'categorie_name', 'categorie_slug')
            ->get()
            ->toArray();
        return $categories ?? [];
    }

    public function CategorieName()
    {
        $categorie_ids = $this->categories ?? [];

        $categories = Categorie::whereIn('id', $categorie_ids)
            ->pluck( 'categorie_name')
            ->toArray();
        return $categories ?? [];
    }
}
