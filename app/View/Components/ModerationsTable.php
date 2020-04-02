<?php

namespace App\View\Components;

use Illuminate\View\Component;

class moderationsTable extends Component
{
    public $moderations;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($moderations)
    {
        $this->moderations = $moderations;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.moderations-table');
    }
}
