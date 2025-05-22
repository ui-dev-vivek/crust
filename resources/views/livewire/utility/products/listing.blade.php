<div class="py-3 top-products-area">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between dir-rtl">
            <h6>Top Products</h6>
            <a class="p-0 btn" href="javascript:void(0);" wire:click="viewAll">View All<i class="ms-1 fa-solid fa-arrow-right-long"></i></a>
        </div>

        <div class="row g-2">
            @foreach ($newProducts as $product)
                <div class="col-6 col-md-4">
                    <div class="card product-card">
                        <div class="card-body">
                            <!-- Badge -->
                            <span class="badge rounded-pill badge-warning">Sale</span>

                            <!-- Wishlist Button -->
                            <a class="wishlist-btn" href="#"><i class="fa-solid fa-heart"></i></a>

                            <!-- Thumbnail -->
                            <a class="product-thumbnail d-block" href="">
                                <img class="mb-2" src="{{ Storage::url(optional($product->primaryImage)->image_url ?? 'default-product.jpg') }}" alt="{{ $product->name }}">


                                {{-- <ul class="shadow-sm offer-countdown-timer d-flex align-items-center" data-countdown="2025/12/31 23:59:59">
                                    <li><span class="days">00</span>d</li>
                                    <li><span class="hours">00</span>h</li>
                                    <li><span class="minutes">00</span>m</li>
                                    <li><span class="seconds">00</span>s</li>
                                </ul> --}}
                            </a>

                            <!-- Product Title -->
                            <a class="product-title" href="">{{ $product->name }}</a>

                            <!-- Product Price with Livewire Discount View -->
                            @livewire('utility.products.dis-view', ['price' => $product->baseVarient->price, 'discount' => $product->discounts, 'style'=>[]])

                            <!-- Rating -->
                            <div class="product-rating">
                                {{-- Optional Ratings --}}
                            </div>

                            <!-- Add to Cart Button -->
                            @livewire('utility.cart.global-cart-button', ['productId' => $product->id])
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
