<?php

namespace App\View\Components\Modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BasicModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title, public string $id, public string $footer, public string $header)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.basic-modal');
    }
}
