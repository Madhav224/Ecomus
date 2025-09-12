<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;

class WishlistButton extends Component
{
 public $productId;
    public $inWishlist = false;

    protected $listeners = ['wishlistUpdated' => 'refreshState'];

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->refreshState();
    }

    public function refreshState()
    {
        if (Auth::check()) {
            $this->inWishlist = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $this->productId)
                ->exists();
        } else {
            $this->inWishlist = false;
        }
    }

    public function toggleWishlist()
{
    if (!Auth::check()) {
        return redirect()->route('frontend.login');
    }

    $wishlist = WishList::where('user_id', Auth::id())
        ->where('product_id', $this->productId)
        ->first();

    if ($wishlist) {
        $wishlist->delete();
        $this->inWishlist = false;
    } else {
        WishList::create([
            'user_id' => Auth::id(),
            'product_id' => $this->productId,
        ]);
        $this->inWishlist = true;
    }

    // Dispatch Livewire event for Alpine
    $count = WishList::where('user_id', Auth::id())->count();
    $this->dispatch('wishlist-updated', ['count' => $count]);
}


    public function render()
    {
        return view('livewire.wishlist-button');
    }
}
