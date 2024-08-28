<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'projects.id';
    public $direction = 'asc';

    protected $paginationTheme = "bootstrap";

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = auth()->user();

        $projects = Project::join('users', 'projects.user_id', '=', 'users.id')
            ->select('projects.id', 'users.id as user_id', 'users.username', 'projects.project', 'projects.description', 'projects.updated_at')
            ->where('users.username', '=', $user->username)
            ->where(function ($query) {
                $query->where('projects.project', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('projects.description', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.project-index', compact('projects', 'user'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
        }
    }
}
