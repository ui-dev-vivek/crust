<?php

namespace App\Livewire\Utility;

use Livewire\Component;

class Navbar extends Component
{
    public $type;
    public function mount($type = 'home')
    {
        $this->type = $type;
    }
    public function render()
    {
        return view('livewire.utility.navbar');
    }
}
