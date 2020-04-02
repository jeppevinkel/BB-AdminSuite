<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
    public $serverAccount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($serverAccount)
    {
        $this->serverAccount = $serverAccount;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
