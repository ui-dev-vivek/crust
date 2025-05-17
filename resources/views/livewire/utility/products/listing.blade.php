<div>
    <div class="flash-sale-wrapper">
        <div class="container">
            <div class="section-heading d-flex align-items-center justify-content-between rtl-flex-d-row-r">
                <h6 class="d-flex align-items-center rtl-flex-d-row-r">
                    <i class="fa-solid fa-bolt-lightning me-1 text-danger lni-flashing-effect"></i>Offer Sale
                </h6>
            </div>

            <!-- Flash Sale Slide -->
            <div class="flash-sale-slide owl-carousel">
                @foreach ($products as $product)
                    <div class="card flash-sale-card">
                        <div class="card-body">
                            <a href="">
                                <img src="{{ Storage::url(optional($product->primaryImage)->image_url ?? 'default-product.jpg') }}" alt="{{ $product->name }}">

                                <span class="product-title">{{ $product->name }}</span>
                                <p class="sale-price">${{ $product->price ?? '0.00' }}<span class="real-price">${{ $product->price ?? '0.00' }}</span></p>
                                <div class="product-rating">
                                    {{-- Optional Rating Display --}}
                                </div>
                            </a>
                            <button wire:click="addToCart({{ $product->id }})" class="mt-2 btn btn-sm btn-primary w-100">Add to Cart</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
