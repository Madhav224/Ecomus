<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderChild;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;

class CheckoutPage extends Component
{
    public $name, $phone;
    public $country, $country_id, $state, $state_id, $city;
    public $flat, $area, $landmark, $pincode;

    public $cart, $subtotal = 0, $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->subtotal = 0;
        $shippingCharge = 0;
        $this->cart = Cart::with('child.product')->where('user_id', Auth::id())->first();

        if ($this->cart) {
            foreach ($this->cart->child as $child) {
                $price = $child->product?->product_price ?? 0;
                $child->total_price = $price * $child->qty;
                $this->subtotal += $child->total_price;
            }
             // ✅ Shipping rule
        if ($this->subtotal < 2000) {
            $shippingCharge = 100; // Example shipping fee
        }

        $this->total = $this->subtotal + $shippingCharge;
        }
    }

    public function placeOrder()
    {
        $this->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'country' => 'required|string',
            'state'   => 'required|string',
            'city'    => 'required|string',
            'flat'    => 'required|string',
            'area'    => 'required|string',
            'pincode' => 'required|string|max:20',
        ]);

        if (!$this->cart || $this->cart->child->isEmpty()) {
            session()->flash('error', 'Your cart is empty!');
            return;
        }

        $order = Order::create([
            'user_id'        => Auth::id(),
            'order_status' => OrderStatus::where('orderstatus_name', 'pending')->first()?->id ?? 1,
            'payment_type'   => 'COD',
            'payment_status' => 'pending',
            'sub_amount'     => $this->subtotal,
            'discount_amount'=> 0,
            'tax_amount'     => 0,
            'total_amount'   => $this->total,
        ]);

        OrderAddress::create([
            'order_id'       => $order->id,
            'address_type'   => 'billing',
            'address_line_1' => $this->flat,
            'address_line_2' => $this->area,
            'landmark'       => $this->landmark,
            'city'           => $this->city,
            'state_name'     => $this->state,
            'state_id'       => $this->state_id,
            'country_name'   => $this->country,
            'country_id'     => $this->country_id,
            'pincode'        => $this->pincode,
        ]);

        foreach ($this->cart->child as $item) {
            OrderChild::create([
                'order_id'          => $order->id,
                'product_id'        => $item->product_id,
                'product_variant_id'=> $item->product_variant_id,
                'qty'               => $item->qty,
            ]);
        }

        $this->cart->child()->delete();
        $this->cart->delete();

        session()->flash('success', 'Order placed successfully!');
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.checkout-page', [
            'cart'     => $this->cart,
            'subtotal' => $this->subtotal,
            'total'    => $this->total,
        ])->extends('frontend.layouts.app')->section('content');
    }
}














// namespace App\Livewire;

// use Livewire\Component;
// use App\Models\Cart;
// use App\Models\Order;
// use App\Models\OrderChild;
// use App\Models\OrderAddress;
// use App\Models\OrderStatus;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Str;

// class CheckoutPage extends Component
// {
//     // Billing fields
//     public $first_name, $last_name, $email, $phone;
//     public $country, $state, $city, $address, $landmark, $pincode;
    
//     public $cart;
//     public $subtotal = 0;
//     public $total = 0;
//     public $images = [];

//     public function mount()
//     {
//         $this->loadCart();
//     }

//     public function loadCart()
//     {
//         $this->subtotal = 0;
//         $this->images = [];

//         $this->cart = Cart::with('child.product', 'child.productVariant')
//             ->where('user_id', Auth::id())
//             ->first();

//         if ($this->cart) {
//             foreach ($this->cart->child as $child) {
//                 // ✅ Calculate totals
//                 $child->total_price = $child->qty * ($child->product->product_price ?? 0);
//                 $this->subtotal += $child->total_price;

//                 // ✅ Load product images
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
//                     $processed[] = Str::startsWith($path, 'storage/')
//                         ? asset($path)
//                         : asset('storage/' . $path);
//                 }

//                 $this->images[$child->product->id] = array_values(array_unique($processed));
//             }

//             $this->total = $this->subtotal; // later add tax/shipping if needed
//         }
//     }

//     public function placeOrder()
//     {
//         $this->validate([
//             'first_name' => 'required|string|max:255',
//             'last_name'  => 'required|string|max:255',
//             'email'      => 'required|email',
//             'phone'      => 'required|string|max:20',
//             'country'    => 'required|string',
//             'city'       => 'required|string',
//             'address'    => 'required|string',
//             'pincode'    => 'nullable|string|max:20',
//             'state'      => 'nullable|string|max:255',
//             'landmark'   => 'nullable|string|max:255',
//         ]);

//         if (!$this->cart || $this->cart->child->isEmpty()) {
//             session()->flash('error', 'Your cart is empty!');
//             return;
//         }

//         // ✅ Create order
//         $order = Order::create([
//             'user_id'        => Auth::id(),
//             'order_status'   => OrderStatus::where('name', 'Pending')->first()?->id ?? 1,
//             'payment_type'   => 'COD',
//             'payment_status' => 'pending',
//             'sub_amount'     => $this->subtotal,
//             'discount_amount'=> 0,
//             'tax_amount'     => 0,
//             'total_amount'   => $this->total,
//         ]);

//         // ✅ Save billing address
//         $order->address()->create([
//             'address_type'   => 'billing',
//             'address_line_1' => $this->address,
//             'address_line_2' => null,
//             'landmark'       => $this->landmark,
//             'city'           => $this->city,
//             'state_name'     => $this->state,
//             'country_name'   => $this->country,
//             'pincode'        => $this->pincode,
//         ]);

//         // ✅ Save order items
//         foreach ($this->cart->child as $item) {
//             $order->child()->create([
//                 'product_id'        => $item->product_id,
//                 'product_variant_id'=> $item->product_variant_id,
//                 'qty'               => $item->qty,
//             ]);
//         }

//         // ✅ Clear cart
//         $this->cart->child()->delete();
//         $this->cart->delete();

//         session()->flash('success', 'Order placed successfully!');
//         return redirect()->route('thankyou');
//     }

//     public function render()
//     {
//         return view('livewire.checkout-page', [
//             'cart'     => $this->cart,
//             'images'   => $this->images,
//             'subtotal' => $this->subtotal,
//             'total'    => $this->total,
//         ])->extends('frontend.layouts.app')->section('content');
//     }
// }



























// namespace App\Livewire;

// use Livewire\Component;
// use App\Models\Cart;
// use App\Models\Order;
// use App\Models\OrderChild;
// use App\Models\OrderAddress;
// use App\Models\OrderStatus;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Str;


// class CheckoutPage extends Component
// {
//      // Billing fields
//     public $first_name, $last_name, $email, $phone, $country, $city, $address;
//      public $images = [];
//      public $pincode; 
//     public $cart;
//     public $subtotal = 0;
//     public $total = 0;

//     public function mount()
//     {
//         $this->loadCart();
//     }

//     public function loadCart()
//     {
//         $this->subtotal = 0;
//          $this->images = [];

//         $this->cart = Cart::with('child.product', 'child.productVariant')
//             ->where('user_id', Auth::id())
//             ->first();


//           if ($this->cart) {
//             foreach ($this->cart->child as $child) {
//                 // ✅ Calculate total per child
//                 $child->total_price = $child->qty * $child->product->product_price;

//                 // ✅ Add to subtotal
//                 $this->subtotal += $child->total_price;

//                 // ✅ Image loading logic
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

//                 // ✅ Save images by product ID
//                 $this->images[$child->product->id] = array_values(array_unique($processed));
//             }
//             $this->total = $this->subtotal; // Add taxes/shipping if needed
//         }
//     }

//     public function placeOrder()
//     {
//         $this->validate([
//             'first_name' => 'required|string|max:255',
//             'last_name'  => 'required|string|max:255',
//             'email'      => 'required|email',
//             'phone'      => 'required|string|max:20',
//             'country'    => 'required|string',
//             'city'       => 'required|string',
//             'address'    => 'required|string',
//         ]);

//         if (!$this->cart || $this->cart->child->isEmpty()) {
//             session()->flash('error', 'Your cart is empty!');
//             return;
//         }

//         // ✅ Create order
//        $order = Order::create([
//     'user_id'        => Auth::id(),
//     'order_status'   => OrderStatus::where('name', 'Pending')->first()?->id ?? 1,
//     'payment_type'   => 'cod', // or whatever default
//     'payment_status' => 'pending',
//     'sub_amount'     => $this->subtotal,
//     'discount_amount'=> 0,  // apply coupon if you have
//     'tax_amount'     => 0,  // calculate GST/VAT if needed
//     'total_amount'   => $this->total,
// ]);

//         // ✅ Billing Address
//        $order->address()->create([
//     'address_type'   => 'billing', // ✅ correct column
//     'address_line_1' => $this->address,
//     'address_line_2' => null,
//     'landmark'       => null,
//     'city'           => $this->city,
//     'state_name'     => null, // or from user form
//     'state_id'       => null, // or from user form
//     'country_name'   => $this->country,
//     'country_id'     => null, // optional
//     'pincode'        => $this->pincode ?? '', // ✅ add input for pincode in checkout form
// ]);


//         // ✅ Order Items
//        foreach ($this->cart->child as $item) {
//     $price = $item->productVariant?->product_variant_price ?? $item->product?->product_price ?? 0;

//     $order->child()->create([
//     'product_id'        => $item->product_id,
//     'product_variant_id'=> $item->product_variant_id,
//     'qty'               => $item->qty,
// ]);
// }

//         // ✅ Clear cart
//         $this->cart->child()->delete();
//         $this->cart->delete();

//         session()->flash('success', 'Order placed successfully!');
//         return redirect()->route('thankyou');
//     }

//     public function render()
//     {
//         return view('livewire.checkout-page', [
//             'cart' => $this->cart,
//             'images' => $this->images,
//             'subtotal' => $this->subtotal,
//             'total' => $this->total,
//         ])->extends('frontend.checkout')->section('content');
//     }
// }
