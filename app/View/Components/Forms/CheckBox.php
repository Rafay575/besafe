<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckBox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $name, public string $value, public string $width, public string $label, public string $checkBoxClass, public string $checked)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.check-box');
    }
}
