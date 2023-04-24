<?php

namespace App\View\Components\Templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BasicPageTemp extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $pageTitle, public string $pageDesc)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.basic-page-temp');
    }
}
