<?php

namespace App\Livewire\Utility\Products;

use Livewire\Component;

class DisView extends Component
{
    public $discount; // This will be an object (ProductDiscount)
    public $price;
    public $style = [];

    public function mount($price, $discount, $style = [])
    {
        $this->style = $style;
        $this->price = $price;
        $this->discount = $discount;
    }


    public function calculateDiscount()
    {
        if (!$this->discount || !$this->discount->is_active) {
            return $this->price;
        }

        $amount = $this->discount->amount;
        $type = $this->discount->discount_type;

        if ($amount > 0) {
            if ($type === 'percent') {
                $discountAmount = ($this->price * $amount) / 100;
                return $this->price - $discountAmount;
            } elseif ($type === 'flat') {
                return $this->price - $amount;
            }
        }

        return $this->price;
    }

    public function render()
    {
        $finalPrice = $this->calculateDiscount();
        // dd($finalPrice);
        return view('livewire.utility.products.dis-view', [
            'finalPrice' => $finalPrice,
        ]);
    }
}
