<div>
    @if ($quantity > 0)
        <div class="d-flex align-items-center">
            <button wire:click="decrement" class="btn btn-danger btn-sm">
                <i class="fa fa-minus"></i>
            </button>

            <div class="mx-2">
                <span wire:loading wire:target="decrement,increment" class="spinner-border spinner-border-sm"></span>
                <span wire:loading.remove wire:target="decrement,increment">{{ $quantity }}</span>
            </div>

            <button wire:click="increment" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    @else
        <button wire:click="addToCart" wire:loading.attr="disabled" class="btn btn-primary btn-sm w-100">
            <span wire:loading wire:target="addToCart">
                <i class="fa fa-spinner fa-spin"></i> Adding...
            </span>
            <span wire:loading.remove wire:target="addToCart">
                <i class="fa fa-cart-plus"></i> Add to Cart
            </span>
        </button>
    @endif
</div>
