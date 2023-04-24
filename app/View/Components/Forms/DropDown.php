<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropDown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $btnClass, public string $id,public string $label)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.drop-down');
    }
}
