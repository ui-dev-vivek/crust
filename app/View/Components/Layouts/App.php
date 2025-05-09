<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{

    public $metaData,$navbarType;
    public function __construct($navbarType='home',$metaData=null)
    {
        $this->metaData = $metaData;
        $this->navbarType = $navbarType;
    }

    public function render(): View|Closure|string
    {
        return view('components.layouts.app');
    }
}
