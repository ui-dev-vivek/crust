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

    // public function addToCart($productId,$quantity)
    // {
    //     quantity
    // }

    public function render()
    {
        return view('livewire.utility.products.listing');
    }
}
