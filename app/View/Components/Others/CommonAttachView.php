<?php

namespace App\View\Components\Others;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommonAttachView extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $label, public object $attachements)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.others.common-attach-view');
    }
}