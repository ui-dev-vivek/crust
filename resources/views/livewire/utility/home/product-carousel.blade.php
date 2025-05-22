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

                                @livewire('utility.products.dis-view', ['price' => $product->baseVarient->price, 'discount' => $product->discounts,'style'=>[]])
                                <div class="product-rating">

                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
