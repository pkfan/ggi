<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RemarkComponent extends Component
{
    public $claimId;
    public function __construct($claimId)
    {
        
        $this->claimId = $claimId;
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
       
        return view('components.remark-component');
    }
}
