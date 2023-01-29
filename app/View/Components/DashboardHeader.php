<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardHeader extends Component
{
    public $mainpage;
    public $subpage;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($mainpage , $subpage)
    {
        $this->mainpage = $mainpage;
        $this->subpage = $subpage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard-header');
    }
}
