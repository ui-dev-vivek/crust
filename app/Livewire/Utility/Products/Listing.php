<?php

namespace App\Livewire\Utility\Products;

use App\Models\Product;
use Livewire\Component;

class Listing extends Component
{

    public $products;
    public function mount()
    {
        $this->products = Product::with(['primaryImage'])
        ->where('status', 1)
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
        return view('livewire.utility.products.listing');
    }
}
