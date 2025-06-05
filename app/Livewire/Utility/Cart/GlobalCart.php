<?php

namespace App\Livewire\Utility\Cart;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Session;

class GlobalCart extends Component
{
    public $cart = [];
    protected $listeners = ['addToCart'];


    public function mount()
    {
        $this->cart = Session::get('carts', []);

    }

    public function addToCart($variantId, $quantity=1)
    {
        $variant = ProductVariant::with('product')->findOrFail($variantId);
        $cart = Session::get('carts', []);

        if (isset($cart[$variantId])) {
            $cart[$variantId]['quantity'] += $quantity;
        } else {
            $cart[$variantId] = [
                'variant_id' => $variant->id,
                'product_name' => $variant->product->name,
                'sku' => $variant->sku,
                'price' => $variant->price,
                'quantity' => $quantity
            ];
        }

        Session::put('carts', $cart);
        $this->cart = $cart;
    }

    public function removeFromCart($variantId)
    {
        $cart = Session::get('carts', []);
        unset($cart[$variantId]);
        Session::put('carts', $cart);
        $this->cart = $cart;
    }

    public function render()
    {
        $total = collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('livewire.utility.cart.global-cart',compact('total'));
    }
}
