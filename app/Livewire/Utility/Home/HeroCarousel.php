<?php

namespace App\Livewire\Utility\Home;

use App\Models\HomeCrousal;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class HeroCarousel extends Component
{
    public $CarouselItems;

    public function mount()
    {
        try {
            $this->CarouselItems = HomeCrousal::where('status', 1)->orderBy('id', 'asc')->get();
        } catch (\Exception $e) {
            Log::error('Failed to fetch Carousel Items: ' . $e->getMessage());
            $this->CarouselItems = collect();
        }
    }

    public function render()
    {
        return view('livewire.utility.home.hero-carousel');
    }
}

