<?php

namespace App\View\Components\Others;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IncidentAssignedActivities extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public object $incident)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.others.incident-assigned-activities');
    }
}