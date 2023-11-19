<?php

namespace App\Livewire;

use App\Models\Profile;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectProfileIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'profiles.id';
    public $direction = 'asc';
    public $projectId;
    public $observations;


    protected $paginationTheme = "bootstrap";

    public function mount($projectId)
    {
        $this->projectId = $projectId;
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
                'projects.id as projects_id',
                'projects.project',
                'projects.observations',
                'profiles.id',
                'profiles.nombre',
                'profiles.descripcion',
                'profiles.incluir',
                'profiles.updated_at'
            )
            ->where('project_id', $this->projectId)
            ->where(function ($query) {
                $query->where('nombre', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('descripcion', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('profiles.id', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        $user = auth()->user();

        $project['project'] = Project::where('id', $this->projectId)->value('project');
        $project['id'] =  $this->projectId;

        $this->observations =  $profiles->isNotEmpty() ? $profiles->first()->observations : null;

        return view('livewire.project-profile-index', compact('profiles', 'user', 'project'));
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


    public function addObservations()
    {
        $project = Project::find($this->projectId);

        if ($project) {
            $project->update([
                'observations' => $this->observations,
            ]);
        }

        // Limpiar el campo de observación después de guardar
        $this->observations = '';
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
