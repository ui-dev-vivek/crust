<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{

    public $metaData;
    public function __construct($metaData=null)
    {
        $this->metaData = $metaData;
    }

    public function render(): View|Closure|string
    {
        return view('components.layouts.app');
    }
}
