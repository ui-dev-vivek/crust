<?php

namespace App\Livewire\Utility\Cart;

use Livewire\Component;
use App\Models\Product;

class GlobalCartButton extends Component
{
    public $productId;
    public $quantity = 0;
    public $loading = false;

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function increment()
    {
        $this->quantity++;
        $this->updateCart();
    }

    public function decrement()
    {
        if ($this->quantity > 0) {
            $this->quantity--;
            $this->updateCart();
        }
    }

    public function updateCart()
    {
        $product = Product::find($this->productId);

        if ($product) {
            // Aapka cart logic yahan daalein (e.g. session ya database)
            session()->put("cart.{$this->productId}.quantity", $this->quantity);
        }
    }

    public function addToCart()
    {
        $this->loading = true;
        sleep(1); // Simulate loader

        $this->quantity = 1;
        $this->updateCart();

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.utility.cart.global-cart-button');
    }
}
