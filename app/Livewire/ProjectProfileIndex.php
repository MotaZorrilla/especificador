<?php

namespace App\Livewire;

use App\Models\Profile;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectProfileIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'profiles.id';
    public $direction = 'asc';
    public $project;


    protected $paginationTheme = "bootstrap";

    public function mount($project)
    {
        $this->project = $project;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $profiles = Profile::join('projects', 'profiles.project_id', '=', 'projects.id')
            ->join('users', 'projects.user_id', '=', 'users.id')
            ->select(
                'users.id as user_id',
                'users.username',
                'projects.project',
                'profiles.id',
                'profiles.nombre',
                'profiles.descripcion',
                'profiles.incluir',
                'profiles.updated_at'
            )
            ->where('project_id', $this->project)
            ->where(function ($query) {
                $query->where('nombre', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('descripcion', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('profiles.id', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        $user = auth()->user();

        return view('livewire.project-profile-index', compact('profiles', 'user'));
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

    public function included($profileId)
    {
        $profile = Profile::find($profileId);

        if ($profile) {
            $profile->update([
                'incluir' => $profile->incluir ? false : true,
            ]);
        }
    }
}
