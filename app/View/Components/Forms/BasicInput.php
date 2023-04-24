<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BasicInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $label,public string $type, public string $name, public string $value,public string $width, public string $inputClass)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.basic-input');
    }
}
