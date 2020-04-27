<?php

namespace App\View\Components;

use Illuminate\View\Component;

class membersTable extends Component
{
    public $members;
    public $serverAccount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($members, $serverAccount)
    {
        $this->members = $members;
        $this->serverAccount = $serverAccount;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.members-table');
    }
}
