<?php

namespace App\View\Components;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class ProductCard extends Component
{
    public $product;
    public $productVariant;
    public $slug;
    public $wishlistActive;

    public function __construct($slug)
    {  
      $product = Product::where('product_slug', $slug)->firstOrFail();
        $user = Auth::guard('web')->user();
        $productVariant=$product?->ProductVariants()->latest()->take(5)->get();

        $this->product = $product;
        $this->productVariant = $productVariant;
        $this->slug = $slug;
        $wishlist = $product?->WishList()->where('user_id', $user?->id)->first();

        $this->wishlistActive = $wishlist ? "active" : "";
    }
    public function render(): View|Closure|string
    {
        return view('components.product-card');
    }
}
