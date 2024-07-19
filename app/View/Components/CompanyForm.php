<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CompanyForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $company;

    public function __construct($company = null)
    {
        $this->company = $company;
    }

    public function render()
    {
        return view('components.company-form');
    }
}
