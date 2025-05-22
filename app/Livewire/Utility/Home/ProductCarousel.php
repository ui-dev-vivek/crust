<?php

namespace App\Livewire\Utility\Home;

use App\Models\Product;
use Livewire\Component;

class ProductCarousel extends Component
{
      public $products;
    public function mount()
    {
        $this->products = Product::with(['primaryImage','baseVarient','discounts','badges'])
        ->where('status', 1)
        ->whereHas('badges', function ($query) {
            $query->where('in_sale', 1);
        })
        ->orderBy('id', 'asc')
        ->get();


    }
    public function addToCart($product)
    {
        // Logic to add the product to the cart
        session()->flash('message', "{$product['name']} has been added to your cart.");
    }

    public function render()
    {
        return view('livewire.utility.home.product-carousel');
    }
}
