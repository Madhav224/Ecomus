<div>
    <section class="flat-spacing-11">
    <div class="container">
        <div class="tf-page-cart-wrap layout-2">
            <div class="tf-page-cart-item">
                <h5 class="fw-5 mb_20">Billing details</h5>
                <form wire:submit.prevent="placeOrder" class="form-checkout">
                    <div class="box grid-2">
                        <fieldset class="fieldset">
                            <label>Name</label>
                            <input type="text" wire:model="name" placeholder="Enter your name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </fieldset>
                        <fieldset class="fieldset">
                            <label>Phone No</label>
                            <input type="text" wire:model="phone" placeholder="Phone number">
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </fieldset>
                    </div>

                    <div class="box grid-2">
                        <fieldset class="fieldset">
                            <label>Country</label>
                            <input type="text" wire:model="country" placeholder="India">
                            @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                        </fieldset>
                        <fieldset class="fieldset">
                            <label>State</label>
                            <input type="text" wire:model="state" placeholder="State">
                            @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                        </fieldset>
                    </div>

                    <fieldset class="box fieldset">
                        <label>City</label>
                        <input type="text" wire:model="city" placeholder="City">
                        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                    </fieldset>

                    <fieldset class="box fieldset">
                        <label>Flat, House no., Building, Company, Apartment</label>
                        <input type="text" wire:model="flat" placeholder="Flat, House no., etc.">
                        @error('flat') <span class="text-danger">{{ $message }}</span> @enderror
                    </fieldset>

                    <fieldset class="box fieldset">
                        <label>Area, Street, Sector, Village</label>
                        <input type="text" wire:model="area" placeholder="Street, Sector, Village">
                        @error('area') <span class="text-danger">{{ $message }}</span> @enderror
                    </fieldset>

                    <fieldset class="box fieldset">
                        <label>Landmark</label>
                        <input type="text" wire:model="landmark" placeholder="E.g. near Apollo Hospital">
                    </fieldset>

                    <fieldset class="box fieldset">
                        <label>Pincode</label>
                        <input type="text" wire:model="pincode" placeholder="6 digits [0-9] PIN code">
                        @error('pincode') <span class="text-danger">{{ $message }}</span> @enderror
                    </fieldset>

                    <button type="submit" class="tf-btn btn-fill radius-3 mt-4">Place Order</button>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="tf-page-cart-footer">
                <div class="tf-cart-footer-inner">
                    <h5 class="fw-5 mb_20">Your order</h5>
                    <div class="tf-page-cart-checkout widget-wrap-checkout">
                        <ul class="wrap-checkout-product">
                                @foreach($cart?->child ?? [] as $child)
                                @php
                                                $product = $child->product;

                                                // Decode product images
                                                $images = is_array($product->product_images)
                                                    ? $product->product_images
                                                    : (json_decode($product->product_images, true) ?? []);

                                                // Make full URL for each image
                                                $images = array_map(fn($img) => asset(ltrim($img, '/')), $images);

                                                // Fallback to thumbnail or default
                                                $main_image = $product->product_thumbnail_image_url 
                                                    ?? ($images[0] ?? asset('frontend/images/products/default.png'));
                                            @endphp
                                    <li class="checkout-product-item">
                                        <div class="content">
                                            <figure class="img-product">
                                            <img src="{{ $main_image }}" alt="{{ $product->product_name }}" >
                                            <span class="quantity">{{ $child->qty }}</span>
                                            </figure>
                                            <div class="info">
                                                <p class="name">{{ $child->product->product_name }}</p>
                                            </div>
                                            <span class="price">₹{{ number_format($child->total_price, 2) }}</span>
                                             
                                        </div>
                                    </li>
                                @endforeach
                        </ul>
                            <div class="d-flex justify-content-between line pb_20 mt-3">
                                <h6 class="fw-5">Subtotal</h6>
                                <h6 class="fw-5">₹{{ number_format($subtotal, 2) }}</h6>
                            </div>
                            <div class="d-flex justify-content-between line pb_20">
                                <h6 class="fw-5">Total</h6>
                                <h6 class="fw-5">₹{{ number_format($total, 2) }}</h6>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>    
</div>
