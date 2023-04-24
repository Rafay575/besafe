<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tblhead extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $heads)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.tblhead');
    }
}
