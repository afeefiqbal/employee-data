<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\Employee;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmployeeForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $employee;
    public $companies;

    public function __construct($employee = null)
    {
        $this->employee = $employee;
        $this->companies = Company::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
       
        return view('components.employee-form');
    }
}
