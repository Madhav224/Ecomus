<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartChild;
use App\Models\Product;
use Auth;

class CartButton extends Component
{
   public $productId;
    public $variantId = null;
    public $quantity = 1;

    public function addToCart()
    {
        if (!Auth::check()) {
            return redirect()->route('frontend.login.form'); // redirect if not logged in
        }

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()],
        );

        // Check if child exists for product + variant
        $child = CartChild::where('cart_id', $cart->id)
            ->where('product_id', $this->productId)
            ->where('product_variant_id', $this->variantId)
            ->first();

        if ($child) {
            $child->increment('qty', $this->quantity);
        } else {
            CartChild::create([
                'cart_id' => $cart->id,
                'product_id' => $this->productId,
                'product_variant_id' => $this->variantId,
                'qty' => $this->quantity,
            ]);
        }

            // Dispatch event for JS/Alpine to handle cart icon/count update
                $count = CartChild::where('cart_id', $cart->id)->sum('qty');
                $this->dispatch('cart-updated', ['totalItems' => $count]);
    }

    public function render()
    {
        return view('livewire.cart-button')->extends('frontend.cart')->section('content');
    }
}
