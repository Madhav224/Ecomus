<?php

// namespace App\Livewire;

// use Livewire\Component;
// use App\Models\Cart;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Str;

// class CartPage extends Component
// {
//     public $cart;
//      public $images = [];

//     public function mount()
//     {
//         $this->loadCart();
//     }

//     public function loadCart()
//     {
//         $this->cart = Cart::with('child.product', 'child.productVariant')
//             ->where('user_id', Auth::id())
//             ->first();

//              if ($this->cart) {
//             foreach ($this->cart->child as $child) {
//                 $raw = $child->product->product_images ?? [];

//                 if (is_string($raw)) {
//                     $decoded = json_decode($raw, true);
//                     if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
//                         $rawImages = $decoded;
//                     } else {
//                         $trimmed = trim($raw, "[] \t\n\r\0\x0B\"'");
//                         $rawImages = $trimmed === '' ? [] : array_map('trim', explode(',', $trimmed));
//                     }
//                 } elseif (is_array($raw)) {
//                     $rawImages = $raw;
//                 } else {
//                     $rawImages = [];
//                 }

//                 $processed = [];
//                 foreach ($rawImages as $item) {
//                     if (!$item) continue;

//                     if (is_array($item)) {
//                         $path = $item['path'] ?? $item['url'] ?? $item['image'] ?? null;
//                     } elseif (is_object($item)) {
//                         $path = $item->path ?? $item->url ?? null;
//                     } else {
//                         $path = (string) $item;
//                     }

//                     $path = trim($path);
//                     if (!$path) continue;

//                     if (preg_match('/^https?:\/\//i', $path)) {
//                         $processed[] = $path;
//                         continue;
//                     }

//                     $path = ltrim($path, '/');
//                     if (Str::startsWith($path, 'storage/')) {
//                         $processed[] = asset($path);
//                     } else {
//                         $processed[] = asset('storage/' . $path);
//                     }
//                 }

//                 // Save images indexed by product ID
//                 $this->images[$child->product->id] = array_values(array_unique($processed));
//             }
//         }
//     }

//     public function removeItem($childId)
//     {
//         $this->cart?->child()->where('id', $childId)->delete();
//         $this->loadCart();
//     }

   
    
//     public function incrementQty($childId)
//     {
//         $child = $this->cart?->child()->find($childId);
//         if ($child) {
//             $child->update(['qty' => $child->qty + 1]);
//             $this->loadCart();
//         }
//     }

//     public function decrementQty($childId)
//     {
//         $child = $this->cart?->child()->find($childId);
//         if ($child && $child->qty > 1) {
//             $child->update(['qty' => $child->qty - 1]);
//             $this->loadCart();
//         }
//     }

//     public function render()
//     {
//         return view('livewire.cart-page', [
//             'cart' => $this->cart,
//             'images' => $this->images,
//         ])->extends('frontend.cart')->section('content');
//     }
// }



namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartPage extends Component
{
    public $cart;
    public $images = [];
    public $subtotal = 0;
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

public function loadCart()
{
    $this->cart = Cart::with('child.product', 'child.productVariant')
        ->where('user_id', Auth::id())
        ->first();

       $this->subtotal = 0;
    $shippingCharge = 0;


    if ($this->cart) {
        foreach ($this->cart->child as $child) {
            // Calculate total price per child
            $child->total_price = $child->qty * $child->product->price;

            // Add to subtotal
            $this->subtotal += $child->total_price;

            // Load images (your existing code)
            $raw = $child->product->product_images ?? [];
            if (is_string($raw)) {
                $decoded = json_decode($raw, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $rawImages = $decoded;
                } else {
                    $trimmed = trim($raw, "[] \t\n\r\0\x0B\"'");
                    $rawImages = $trimmed === '' ? [] : array_map('trim', explode(',', $trimmed));
                }
            } elseif (is_array($raw)) {
                $rawImages = $raw;
            } else {
                $rawImages = [];
            }

            $processed = [];
            foreach ($rawImages as $item) {
                if (!$item) continue;
                if (is_array($item)) {
                    $path = $item['path'] ?? $item['url'] ?? $item['image'] ?? null;
                } elseif (is_object($item)) {
                    $path = $item->path ?? $item->url ?? null;
                } else {
                    $path = (string) $item;
                }

                $path = trim($path);
                if (!$path) continue;

                if (preg_match('/^https?:\/\//i', $path)) {
                    $processed[] = $path;
                    continue;
                }

                $path = ltrim($path, '/');
                if (Str::startsWith($path, 'storage/')) {
                    $processed[] = asset($path);
                } else {
                    $processed[] = asset('storage/' . $path);
                }
            }

            $this->images[$child->product->id] = array_values(array_unique($processed));
        }
    }
      // ✅ Apply shipping rule
    if ($this->subtotal < 2000) {
        $shippingCharge = 100; // Example shipping fee
    }

   // Save total with shipping included
    $this->total = $this->subtotal + $shippingCharge;
}


    public function removeItem($childId)
    {
        $this->cart?->child()->where('id', $childId)->delete();
        $this->loadCart();
    }

    public function incrementQty($childId)
    {
        $child = $this->cart?->child()->find($childId);
        if ($child) {
            $child->update(['qty' => $child->qty + 1]);
            $this->loadCart();
        }
    }

    public function decrementQty($childId)
    {
        $child = $this->cart?->child()->find($childId);
        if ($child && $child->qty > 1) {
            $child->update(['qty' => $child->qty - 1]);
            $this->loadCart();
        }
    }

    public function render()
    {
        return view('livewire.cart-page', [
            'cart' => $this->cart,
            'images' => $this->images,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
        ])->extends('frontend.cart')->section('content');
    }
}

