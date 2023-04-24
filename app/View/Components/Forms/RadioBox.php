<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioBox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $name, public string $value, public string $width, public string $label, public string $radioBoxClass, public string $checked)
     {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.radio-box');
    }
}
