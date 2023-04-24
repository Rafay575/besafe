<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioAndCheckBoxDiv extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $name, public string $label,public string $divClass)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.radio-and-check-box-div');
    }
}
