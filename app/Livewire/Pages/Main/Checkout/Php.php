<?php

namespace App\Livewire\Pages\Main\Checkout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Php extends Component
{
    public function render()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('livewire.pages.main.checkout.php');
    }
}

