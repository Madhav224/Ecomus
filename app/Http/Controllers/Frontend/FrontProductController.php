<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class FrontProductController extends Controller
{
public function show($product_slug)
{
    $product = Product::with([
        'ProductVariants.variant.parent'
    ])->where('product_slug', $product_slug)->firstOrFail();

    return view('frontend.products.show', compact('product'));
}

}