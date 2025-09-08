<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\Categorie;
use App\Models\Brand; 
use App\Models\Product; 
use App\Models\Blog; 

class HomeController extends Controller
{
   
   public function index()
    {
        // Only fetch active sliders, newest first
        $sliders = Slider::where('status', 'active')->orderByDesc('id')->get();

        // Fetch active banners, newest first
        $banners = Banner::where('status', 'active')->orderByDesc('id')->get();

        // Get parent categories with their banner images (removed product count)
        $categories = Categorie::with(['images' => function($query) {
            $query->where('categorie_image_type', 'banner');
        }])
        ->whereNull('categorie_parent_id') // Only parent categories
        ->get();

        // Get all brands (add this line)
        $brands = Brand::orderBy('brand_name')->get();

          // 👇 Add products (e.g. best sellers / latest)
    $products = Product::where('status', 'active')
        ->latest()
        ->take(8) // show 8 items
        ->get();

       


    return view('frontend.home', compact('sliders', 'banners', 'categories', 'brands', 'products',));
    }

    public function allCategories()
    {
        $categories = Categorie::with(['images' => function($query) {
            $query->where('categorie_image_type', 'banner');
        }])
        ->whereNull('categorie_parent_id')
        ->paginate(12);

        return view('frontend.categories', compact('categories'));
    }

    public function categoryProducts($slug)
    {
        $category = Categorie::with(['images', 'children'])
            ->where('categorie_slug', $slug)
            ->firstOrFail();
        
        // For now, just pass empty products collection
        $products = collect();
        
        return view('frontend.category-products', compact('category', 'products'));
    }


}
