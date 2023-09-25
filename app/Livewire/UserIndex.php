<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
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
        $users= User::where(    'username'  , 'LIKE', '%'. $this->search . '%')
                    ->orWhere(  'firstname' , 'LIKE', '%'. $this->search . '%')
                    ->orWhere(  'lastname'  , 'LIKE', '%'. $this->search . '%')
                    ->orWhere(  'email'     , 'LIKE', '%'. $this->search . '%')
                    ->orderby(  $this->sort, $this->direction)
                    ->paginate(9);

        return view('livewire.user-index', compact('users'));
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
