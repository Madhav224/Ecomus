<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

use Illuminate\Http\Request;

class FrontShopController extends Controller
{
      public function index()
    {
        $products = Product::latest()->paginate(12); // 12 products per page

          $saleProducts = Product::inRandomOrder()->take(3)->get(); 
          
      // Get 6 random products
    $galleryProducts = Product::inRandomOrder()->take(6)->get();

    // Pick a random image for each product (from product_images array or fallback to thumbnail)
    $galleryImages = $galleryProducts->map(function ($product) {
        $images = $product->product_images_url; // array from accessor
        if ($images && count($images) > 0) {
            $randomImage = $images[array_rand($images)];
        } else {
            $randomImage = $product->product_thumbnail_image_url;
        }

        return [
            'url' => route('shop', $product->product_slug),
            'image' => $randomImage,
            'name' => $product->product_name,
        ];
    });

    return view('frontend.shop', compact('products', 'galleryImages','saleProducts'));
    }






public function quickView($id)
{
    $product = Product::with('ProductVariants')->findOrFail($id);

    $images = $product->product_images_url ?: [$product->product_thumbnail_image_url];

    return response()->json([
        'id'          => $product->id,
        'name'        => $product->product_name,
        'price'       => number_format($product->product_price, 2),
        'description' => \Illuminate\Support\Str::limit($product->product_short_description, 120),
        'images'      => $images,
        'url'         => route('product', $product->product_slug),

        // Variants
        'variants'    => $product->ProductVariants->map(function ($variant) {
            return [
                'id'        => $variant->id,
                'price'     => number_format($variant->product_variant_price, 2),
                'thumbnail' => $variant->product_variant_thumbnail_image_url,
                'images'    => $variant->product_variant_images_url,

                // From JSON
                'combination' => $variant->variant_combination, // e.g. ["Red","M"]
                'ids'         => $variant->variant_ids,         // e.g. [3, 7]
            ];
        }),
    ]);
}




}