<?php

namespace App\Livewire\Utility;

use App\Models\Category as ModelsCategory;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Category extends Component
{
    public $categories;

    public function mount()
    {
        try {
            $this->categories = ModelsCategory::where('status', 1)
                ->whereNull('parent_id')
                ->orderBy('id', 'asc')
                ->get();
        } catch (\Exception $e) {
            Log::error('An error occurred while fetching categories: ' . $e->getMessage());
            $this->categories = collect(); // Assign an empty collection in case of error
        }
    }

    public function render()
    {
        return view('livewire.utility.category');
    }
}

