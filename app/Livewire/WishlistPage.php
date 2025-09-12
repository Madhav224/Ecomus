<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistPage extends Component
{

       public $wishlistItems = [];

    protected $listeners = ['wishlistUpdated' => 'loadWishlist'];

    public function mount()
    {
        $this->loadWishlist();
    }

    public function loadWishlist()
    {
        if (Auth::check()) {
            $this->wishlistItems = Wishlist::where('user_id', Auth::id())
                ->with('product') // eager load product
                ->get();
        }
    }


    public function render()
    {
        return view('livewire.wishlist-page')->extends('frontend.wishlist')->section('content');
    }

}
