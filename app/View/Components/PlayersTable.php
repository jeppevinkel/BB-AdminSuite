<?php

namespace App\View\Components;

use Illuminate\View\Component;

class playersTable extends Component
{
    public $players;
    public $serverAccount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($players, $serverAccount)
    {
        $this->players = $players;
        $this->serverAccount = $serverAccount;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.players-table');
    }
}
