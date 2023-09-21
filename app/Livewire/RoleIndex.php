<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleIndex extends Component
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
        $roles = Role::where(  'name'  , 'LIKE', '%'. $this->search . '%')
                        ->orderby(  $this->sort, $this->direction)
                        ->paginate(9);   
                        
        return view('livewire.role-index', compact('roles'));
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
