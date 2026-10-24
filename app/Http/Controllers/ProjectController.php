<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Filedata;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:project')->except(['show', 'edit', 'update', 'destroy']);
    }

    protected function authorizeProject(Project $project): void
    {
        $user = auth()->user();
        if (!$user || !$user->canAccessProject($project)) {
            abort(403, 'Acceso denegado: No tienes autorización sobre este proyecto.');
        }
    }

    public function index()
    {
        return view('dashboard.project.project-index');
    }

    public function create()
    {
        $user = auth()->user();

        return view('dashboard.project.project-create', compact('user'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $project = new Project();
        $project->user()->associate($user);
        $project->tenant_id = $user->tenant_id;
        $project->user_project_counter = (Project::where('user_id', $user->id)->max('user_project_counter') ?? 0) + 1;
        $project->project = $request->project;
        $project->description = $request->description;
        $project->is_private = (bool) $request->input('is_private', false);
        $project->save();

        $project->refreshIntegrityHash();

        return redirect()->route('project.index')->with('success', '¡Proyecto creado con éxito!');
    }

    public function show($projectId)
    {
        $projectModel = $projectId instanceof Project ? $projectId : Project::findOrFail($projectId);
        $this->authorizeProject($projectModel);

        $project = $projectModel->id;
        return view('dashboard.projectProfile.profile-index', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorizeProject($project);

        return view('dashboard.project.project-edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeProject($project);

        $project->observations = $request->observaciones ?? $request->observations ?? $project->observations;
        if ($request->has('project')) {
            $project->project = $request->project;
        }
        if ($request->has('description')) {
            $project->description = $request->description;
        }
        $project->save();
        $project->refreshIntegrityHash();

        $filedata = Filedata::where('masividad', ceil((float) $project->masividad))->get();

        return view('dashboard.projectAdmin.projectAdmin-show', compact('project', 'filedata'));
    }

    public function destroy(Project $project)
    {
        $this->authorizeProject($project);

        $project->delete();

        return redirect()->route('project.index')->with('success', 'El proyecto se eliminó con éxito');
    }
}
