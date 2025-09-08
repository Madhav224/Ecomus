<style>.product-images .quick-view-img {
    height: 550px;       /* fixed size */
    width: 100%;         /* fills width */
    object-fit: cover;   /* crops edges */
     /* Bootstrap rounded */
}</style>
 

<!-- Global Quick View Modal -->
<div class="modal fade modalDemo popup-quickview" id="quick_view" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content border-0 rounded-3 shadow-lg">

      {{-- <!-- Header -->
      <div class="modal-header border-0">
         <h5 class="modal-title product-name d-none"></h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> --}}

      <!-- Body -->
      <div class="modal-body">
        <div class="row g-4 align-items-start">

          <!-- Product Image -->
          <div class="col-lg-6">
                    <div dir="ltr" class="swiper tf-single-slide">
                        <div class="swiper-wrapper product-images">
                            <!-- Dynamic images will be inserted -->
                        </div>
                        <div class="swiper-button-next button-style-arrow single-slide-prev"></div>
                        <div class="swiper-button-prev button-style-arrow single-slide-next"></div>
                    </div>
                
          </div>

          <!-- Product Info -->
          <div class="col-lg-6">
            
            <!-- Title + Badge -->
            <div class="tf-product-info-title mb-2">
              <h4 class="product-name fw-bold"></h4>
            </div>
            <div class="d-flex align-items-center mb-3">
              <span class="badge bg-dark me-2">BEST SELLER</span>
              <span class="text-danger small fw-semibold">⚡ Selling fast! 48 people have this in their carts.</span>
            </div>

            <!-- Price -->
            <div class="product-price fw-bold fs-5 mb-3 text-dark"></div>

            <!-- Description -->
            <p class="product-description text-muted small mb-4"></p>

            <!-- Variants (Colors, Sizes, etc.) -->
            <div class="variants-container mb-4"></div>

            <!-- Quantity -->
            <div class="d-flex align-items-center mb-4">
              <span class="me-3 fw-semibold">Quantity:</span>
              <div class="input-group" style="width: 120px;">
                <button class="btn btn-outline-secondary">-</button>
                <input type="text" class="form-control text-center" value="1">
                <button class="btn btn-outline-secondary">+</button>
              </div>
            </div>

            <!-- Buttons -->
            <div class="tf-product-info-buy-button d-flex gap-2">
              <a href="#"
                                class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart"><span>Add
                                    to cart</span></a>
                            <a href="#"
                                class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                                <span class="icon icon-heart"></span>
                                <span class="tooltip">Add to Wishlist</span>
                                <span class="icon icon-delete"></span>
                            </a>
                            <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
                                class="tf-product-btn-wishlist hover-tooltip box-icon bg_white compare btn-icon-action">
                                <span class="icon icon-compare"></span>
                                <span class="tooltip">Add to Compare</span>
                                <span class="icon icon-check"></span>
                            </a>
            </div>

            <!-- View Details -->
            <div class="mt-3">
                 <a href="#" class="tf-btn fw-6 btn-line view-full-details">
                    View full details <i class="icon icon-arrow1-top-left"></i>
                </a>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>


 <!-- modal find_size -->
    <div class="modal fade modalDemo tf-product-modal popup-findsize" id="find_size">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content" >
                <div class="header">
                    <div class="demo-title">Size chart</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="tf-rte">
                    <div class="tf-table-res-df">
                        <h6>Size guide</h6>
                        <table class="tf-sizeguide-table">
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>US</th>
                                    <th>Bust</th>
                                    <th>Waist</th>
                                    <th>Low Hip</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>XS</td>
                                    <td>2</td>
                                    <td>32</td>
                                    <td>24 - 25</td>
                                    <td>33 - 34</td>
                                </tr>
                                <tr>
                                    <td>S</td>
                                    <td>4</td>
                                    <td>34 - 35</td>
                                    <td>26 - 27</td>
                                    <td>35 - 26</td>
                                </tr>
                                <tr>
                                    <td>M</td>
                                    <td>6</td>
                                    <td>36 - 37</td>
                                    <td>28 - 29</td>
                                    <td>38 - 40</td>
                                </tr>
                                <tr>
                                    <td>L</td>
                                    <td>8</td>
                                    <td>38 - 29</td>
                                    <td>30 - 31</td>
                                    <td>42 - 44</td>
                                </tr>
                                <tr>
                                    <td>XL</td>
                                    <td>10</td>
                                    <td>40 - 41</td>
                                    <td>32 - 33</td>
                                    <td>45 - 47</td>
                                </tr>
                                <tr>
                                    <td>XXL</td>
                                    <td>12</td>
                                    <td>42 - 43</td>
                                    <td>34 - 35</td>
                                    <td>48 - 50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tf-page-size-chart-content">
                        <div>
                            <h6>Measuring Tips</h6>
                            <div class="title">Bust</div>
                            <p>Measure around the fullest part of your bust.</p>
                            <div class="title">Waist</div>
                            <p>Measure around the narrowest part of your torso.</p>
                            <div class="title">Low Hip</div>
                            <p class="mb-0">With your feet together measure around the fullest part of your hips/rear.
                            </p>
                        </div>
                        <div>
                            <img class="sizechart lazyload" data-src="{{asset('frontend/images/size_chart2.jpg')}}"
                                src="{{asset('frontend/images/size_chart2.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal find_size -->
    <script>
    document.querySelectorAll('.quick-view-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        let productUrl = this.dataset.url;
        let modal = document.getElementById('quick_view');

        // Reset modal
        modal.querySelector('.product-name').innerText = '';
        modal.querySelector('.product-price').innerText = '';
        modal.querySelector('.product-description').innerText = '';
        modal.querySelector('.product-images').innerHTML = '';
        modal.querySelector('.variants-container').innerHTML = '';

        // Fetch data
        fetch(productUrl)
            .then(res => {
                if (!res.ok) {
                    throw new Error("HTTP error " + res.status);
                }
                return res.json();
            })
            .then(data => {
                // Fill modal content
                modal.querySelector('.product-name').innerText = data.name;
                modal.querySelector('.product-price').innerText = "₹" + data.price;
                modal.querySelector('.product-description').innerHTML = data.description;
                modal.querySelector('.view-full-details').setAttribute("href", data.url);

                // Images
                let imgWrapper = modal.querySelector(".product-images");
                data.images.forEach(img => {
                    imgWrapper.innerHTML += `
                        <div class="swiper-slide">
                            <img src="${img}" class="img-fluid quick-view-img" alt="${data.name}">
                        </div>`;
                });

                // Variants
                let variantWrapper = modal.querySelector(".variants-container");
                if (data.variants.length > 0) {
                    data.variants.forEach(v => {
                        variantWrapper.innerHTML += `
                            <div class="variant-item mb-2">
                                <label>
                                    <input type="radio" name="variant" value="${v.id}">
                                    ${v.combination.join(" / ")} - ₹${v.price}
                                </label>
                            </div>`;
                    });
                } else {
                    variantWrapper.innerHTML = `<p class="text-muted">No variants available</p>`;
                }
                
            })
            .catch(err => {
                console.error("Quick View error:", err);
                modal.querySelector('.product-description').innerText = "Error loading product.";
            });
    });
});

</script>


{{-- 
     <script>
document.querySelectorAll('.quick-view-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        let modal = document.getElementById('quick_view');

        // Get data attributes
        let name = this.dataset.name;
        let price = this.dataset.price;
        let desc = this.dataset.description;
        let url = this.dataset.url;
        let images = JSON.parse(this.dataset.images);
        // let variants = JSON.parse(this.dataset.variants); // Not used directly

        // Fill modal content
        modal.querySelector('.product-name').innerText = name;
        modal.querySelector('.product-price').innerText = "₹" + price;
        modal.querySelector('.product-description').innerHTML = desc;
        modal.querySelector('.view-full-details').setAttribute("href", url);

        // Images
        let imgWrapper = modal.querySelector(".swiper-wrapper");
        imgWrapper.innerHTML = "";
        images.forEach(img => {
            imgWrapper.innerHTML += `
                <div class="swiper-slide ">
                    <div class="item">
                    <img src="${img}" class=" quick-view-img" alt="${name}">
                    </div>
                </div>`;
        });
      
    });
});
</script>  --}}

    
{{-- <div class="modal fade modalDemo popup-quickview" id="quick_view">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    <div class="tf-product-media-wrap">
                        <div dir="ltr" class="swiper tf-single-slide">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="item">
                                        <img src="images/products/orange-1.jpg" alt="">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="item">
                                        <img src="images/products/pink-1.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-button-next button-style-arrow single-slide-prev"></div>
                            <div class="swiper-button-prev button-style-arrow single-slide-next"></div>
                        </div>
                    </div>
                    <div class="tf-product-info-wrap position-relative">
                        <div class="tf-product-info-list">
                            <div class="tf-product-info-title">
                                <h5><a class="link" href="product-detail.html">Ribbed Tank Top</a></h5>
                            </div>
                            <div class="tf-product-info-badges">
                                <div class="badges text-uppercase">Best seller</div>
                                <div class="product-status-content">
                                    <i class="icon-lightning"></i>
                                    <p class="fw-6">Selling fast! 48 people have this in their carts.</p>
                                </div>
                            </div>
                            <div class="tf-product-info-price">
                                <div class="price">$18.00</div>
                            </div>
                            <div class="tf-product-description">
                                <p>Nunc arcu faucibus a et lorem eu a mauris adipiscing conubia ac aptent ligula
                                    facilisis a auctor habitant parturient a a.Interdum fermentum.</p>
                            </div>
                            <div class="tf-product-info-variant-picker">
                                <div class="variant-picker-item">
                                    <div class="variant-picker-label">
                                        Color: <span class="fw-6 variant-picker-label-value">Orange</span>
                                    </div>
                                    <div class="variant-picker-values">
                                        <input id="values-orange-1" type="radio" name="color-1" checked>
                                        <label class="hover-tooltip radius-60" for="values-orange-1"
                                            data-value="Orange">
                                            <span class="btn-checkbox bg-color-orange"></span>
                                            <span class="tooltip">Orange</span>
                                        </label>
                                        <input id="values-black-1" type="radio" name="color-1">
                                        <label class=" hover-tooltip radius-60" for="values-black-1" data-value="Black">
                                            <span class="btn-checkbox bg-color-black"></span>
                                            <span class="tooltip">Black</span>
                                        </label>
                                        <input id="values-white-1" type="radio" name="color-1">
                                        <label class="hover-tooltip radius-60" for="values-white-1" data-value="White">
                                            <span class="btn-checkbox bg-color-white"></span>
                                            <span class="tooltip">White</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="variant-picker-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="variant-picker-label">
                                            Size: <span class="fw-6 variant-picker-label-value">S</span>
                                        </div>
                                        <div class="find-size btn-choose-size fw-6">Find your size</div>
                                    </div>
                                    <div class="variant-picker-values">
                                        <input type="radio" name="size-1" id="values-s-1" checked>
                                        <label class="style-text" for="values-s-1" data-value="S">
                                            <p>S</p>
                                        </label>
                                        <input type="radio" name="size-1" id="values-m-1">
                                        <label class="style-text" for="values-m-1" data-value="M">
                                            <p>M</p>
                                        </label>
                                        <input type="radio" name="size-1" id="values-l-1">
                                        <label class="style-text" for="values-l-1" data-value="L">
                                            <p>L</p>
                                        </label>
                                        <input type="radio" name="size-1" id="values-xl-1">
                                        <label class="style-text" for="values-xl-1" data-value="XL">
                                            <p>XL</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tf-product-info-quantity">
                                <div class="quantity-title fw-6">Quantity</div>
                                <div class="wg-quantity">
                                    <span class="btn-quantity minus-btn">-</span>
                                    <input type="text" name="number" value="1">
                                    <span class="btn-quantity plus-btn">+</span>
                                </div>
                            </div>
                            <div class="tf-product-info-buy-button">
                                <form class="">
                                    <a href="#"
                                        class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart"><span>Add
                                            to cart -&nbsp;</span><span class="tf-qty-price">$8.00</span></a>
                                    <a href="#"
                                        class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Add to Wishlist</span>
                                        <span class="icon icon-delete"></span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
                                        class="tf-product-btn-wishlist hover-tooltip box-icon bg_white compare btn-icon-action">
                                        <span class="icon icon-compare"></span>
                                        <span class="tooltip">Add to Compare</span>
                                        <span class="icon icon-check"></span>
                                    </a>
                                    <div class="w-100">
                                        <a href="#" class="btns-full">Buy with <img src="images/payments/paypal.png"
                                                alt=""></a>
                                        <a href="#" class="payment-more-option">More payment options</a>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <a href="product-detail.html" class="tf-btn fw-6 btn-line">View full details<i
                                        class="icon icon-arrow1-top-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal quick_view --> --}}



