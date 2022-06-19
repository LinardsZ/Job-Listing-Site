<?php

namespace App\View\Components;

use Illuminate\View\Component;

class landing_offers extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $offers;
    public function __construct($offers)
    {
        $this->offers = $offers;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.landing_offers');
    }
}
