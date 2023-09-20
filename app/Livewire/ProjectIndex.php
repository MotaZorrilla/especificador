<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectIndex extends Component
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
        $projects = Project::where(  'nombre'  , 'LIKE', '%'. $this->search . '%')
                        ->orWhere(  'descripcion' , 'LIKE', '%'. $this->search . '%')
                        ->orderby(  $this->sort, $this->direction)
                        ->paginate(9);

        return view('livewire.project-index', compact('projects'));
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
