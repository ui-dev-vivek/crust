<div>
    {{-- Cart Icon Trigger --}}
    <div class="cart-icon-wrap" wire:ignore.self>
        <a data-bs-toggle="offcanvas" href="#cartOffcanvas" role="button" aria-controls="cartOffcanvas">
            <i class="fa-solid fa-bag-shopping"></i>
            <span>{{ count($cart) }}</span>
        </a>
    </div>

    {{-- Offcanvas Cart --}}
    <div wire:ignore.self class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 id="cartOffcanvasLabel">Your Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">

            @if ($cart)
            <ul class="list-group">
                @foreach ($cart as $item)
                    <li class="list-group-item d-flex">
                        {{-- Product Image --}}
                        <div class="me-3">
                            @if (!empty($item['image']))
                                <img src="{{ $item['image'] }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;" alt="Product Image">
                            @else
                                <div class="bg-light d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                                    <i class="fa-solid fa-box-open text-muted fs-4"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Product Info --}}
                        <div class="flex-grow-1">
                            <strong>{{ $item['product_name'] }}</strong>
                            <div class="my-2 input-group input-group-sm" style="width: 120px;">
                                <button class="btn btn-outline-secondary" wire:click="decreaseQuantity({{ $item['variant_id'] }})">-</button>
                                <span class="input-group-text">{{ $item['quantity'] }}</span>
                                <button class="btn btn-outline-secondary" wire:click="increaseQuantity({{ $item['variant_id'] }})">+</button>
                            </div>
                            <div>₹{{ $item['price'] }} each</div>

                            @if (isset($item['custom_fields']))
                                <div class="mt-1 text-muted" style="font-size: 12px;">
                                    @foreach ($item['custom_fields'] as $key => $value)
                                        <div><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{-- Remove --}}
                        <button wire:click="removeFromCart({{ $item['variant_id'] }})" class="btn btn-sm btn-danger ms-2">×</button>
                    </li>
                @endforeach
            </ul>

            <div class="mt-3">
                <h5>Total: ₹{{ $total }}</h5>
            </div>
        @else
                <section class="offcanva-cart">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <i class="fa-solid fa-box-open text-muted" style="font-size: 5rem;"></i>
                        <p class="text-muted">No items in cart.</p>
<a href="{{ route('login') }}" class="mt-3 btn btn-theam w-100">
    <i class='bx bx-log-in'></i> Login
</a>

                    </div>
                </section>
            @endif
            </section>
        </div>
    </div>
</div>
