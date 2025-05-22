<?php

namespace App\Livewire\Utility\Products;

use App\Models\Product;
use Livewire\Component;

class Listing extends Component
{
    public $featuredProducts;

    public $newProducts;

    public $style = [];

    public function mount()
    {
        $this->featuredProducts = Product::with(['primaryImage', 'baseVarient', 'discounts', 'badges'])
            ->where('status', 1)
            ->whereHas('badges', function ($query) {
                $query->where('is_featured', 1);
            })
            ->orderBy('id', 'asc')
            ->get();
        $this->newProducts = Product::with(['primaryImage', 'baseVarient', 'discounts', 'badges'])
            ->where('status', 1)
            ->whereHas('badges', function ($query) {
                $query->where('is_new', 1);
            })
            ->orderBy('id', 'asc')
            ->get();

    }

    public function viewAll()
    {
        dd(75);
    }

    public function addToCart($product)
    {
        dd(76);
        sleep(3);

        // Logic to add the product to the cart
        session()->flash('message', "{$product['name']} has been added to your cart.");
    }

    public function render()
    {
        return view('livewire.utility.products.listing');
    }
}
