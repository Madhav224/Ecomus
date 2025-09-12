<?php

namespace App\View\Components;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Closure;
use Illuminate\Contracts\View\View;

class ProductCard extends Component
{
    public $product;
    public $productVariants;
    public $slug;
    public bool $inWishlist = false;

    public function __construct($slug)
    {
        // Load product by slug
        $product = Product::where('product_slug', $slug)->firstOrFail();

        // Assign properties
        $this->product = $product;
        $this->productVariants = $product->ProductVariants()->latest()->take(5)->get();
        $this->slug = $slug;

        // Check wishlist only if logged in
        if (Auth::check()) {
            $this->inWishlist = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->exists();
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.product-card');
    }
}
