<div>

<a href="javascript:void(0);" 
   wire:click.prevent="toggleWishlist"
   class="box-icon bg_white wishlist btn-icon-action"
   x-data="{ show: false }"
   @mouseenter="show = true" 
   @mouseleave="show = false">

    <span class="{{ $inWishlist ? 'icon icon-delete text-red-500' : 'icon icon-heart' }}"></span>
    
    <span x-show="show" 
          class="tooltip absolute z-50 bg-gray-800 text-white text-xs px-2 py-1 rounded">
        {{ $inWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}
    </span>
</a>
</div>
