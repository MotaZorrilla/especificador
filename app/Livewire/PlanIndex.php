<?php

namespace App\Livewire;

use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;

class PlanIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'id';
    public $direction = 'asc';
    
    protected $paginationTheme = "bootstrap";
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $plans = Plan::where(  'name'  , 'LIKE', '%'. $this->search . '%')
                        ->orWhere(  'description' , 'LIKE', '%'. $this->search . '%')
                        ->orWhere(  'price' , 'LIKE', '%'. $this->search . '%')
                        ->orderby(  $this->sort, $this->direction)
                        ->paginate(9);   
                        
        return view('livewire.plan-index', compact('plans'));
    }

    public function order($sort)
    {
        if ($this->sort==$sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort=$sort;
        }
        
    }
}
