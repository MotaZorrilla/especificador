<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Result;
use App\Services\MassivityCalculationEngine;
use App\Services\ProjectProfileBatchService;
use Illuminate\Http\Request;

class ProjectProfileController extends Controller
{
    public function __construct(
        protected MassivityCalculationEngine $calculationEngine,
        protected ProjectProfileBatchService $batchService
    ) {}

    protected function authorizeProjectAccess(Project $project): void
    {
        $user = auth()->user();
        if (!$user || !$user->canAccessProject($project)) {
            abort(403, 'Acceso denegado: No tienes permisos sobre este proyecto o perfil.');
        }
    }

    public function index()
    {
        return view('dashboard.projectAdmin.projectAdmin-index');
    }

    public function create()
    {
        $user = auth()->user();

        $projects = $user->hasRole('Cliente')
            ? $user->projects
            : ($user->tenant_id
                ? Project::where('tenant_id', $user->tenant_id)->get()
                : Project::all());

        return view('dashboard.projectProfile.profile-create', compact('user', 'projects'));
    }

    public function store(Request $request)
    {
        $project = Project::findOrFail($request->project);
        $this->authorizeProjectAccess($project);

        $profile = new Profile();
        $profile->project_id    = $project->id;
        $profile->nombre        = $request->nombre;
        $profile->descripcion   = $request->descripcion;
        $profile->exposicion    = $request->exposicion;
        $profile->perfil        = $request->perfil;
        $profile->forma         = $request->forma;
        $profile->masividad     = $request->masividad;
        $profile->resistencia   = $request->resistencia;
        $profile->altura        = $request->dato_H;
        $profile->base1         = $request->dato_B1;
        $profile->base2         = $request->dato_B2;
        $profile->espesor1      = $request->dato_e1;
        $profile->espesor2      = $request->dato_e2;
        $profile->espesort      = $request->dato_t;
        $profile->radio         = $request->dato_r;
        $profile->plieque       = $request->dato_C;
        $profile->diametro      = $request->dato_D;
        $profile->observaciones = $request->observaciones;

        $profile->masividad = $this->calculationEngine->calculateForProfile($profile);
        $profile->save();

        $project->refreshIntegrityHash();

        return view('dashboard.projectProfile.profile-index', ['project' => $profile->project_id])
            ->with('success', '¡Perfil creado con éxito!');
    }

    /**
     * Importación masiva de perfiles para un proyecto (JSON o matriz Excel procesada).
     */
    public function batchImport(Request $request, Project $project)
    {
        $this->authorizeProjectAccess($project);

        $request->validate([
            'profiles' => ['required', 'array', 'min:1'],
        ]);

        $summary = $this->batchService->importProfilesForProject($project, $request->input('profiles'));

        if ($request->wantsJson() || $request->expectsJson()) {
            return response()->json([
                'status'     => 'ok',
                'project_id' => $project->id,
                'summary'    => $summary,
            ], 201);
        }

        return redirect()
            ->route('project.show', $project->id)
            ->with('success', "Se importaron {$summary['imported_count']} perfiles con éxito.");
    }

    public function show($profileId)
    {
        $profile = Profile::with(['project', 'results'])->findOrFail($profileId);
        $this->authorizeProjectAccess($profile->project);

        if ($profile->results->isEmpty()) {
            $this->calculationEngine->generateResultsForProfile($profile);
            $profile->load('results');
        }

        $successMessage = 'Perfil cargado';

        return view('dashboard.projectProfile.profile-show', compact('profile', 'successMessage'));
    }

    public function edit($id)
    {
        $profile = Profile::with('project')->findOrFail($id);
        $this->authorizeProjectAccess($profile->project);

        return view('dashboard.projectProfile.profile-show', compact('profile'));
    }

    public function update(Request $request, $profileId)
    {
        $profile = Profile::with('project')->findOrFail($profileId);
        $this->authorizeProjectAccess($profile->project);

        $profile->observaciones = $request->observaciones;
        $profile->save();

        if ($request->has('selectedPaints')) {
            $selectedPaints = (array) $request->input('selectedPaints');

            Result::where('profile_id', $profileId)
                ->whereIn('id', $selectedPaints)
                ->update(['incluir' => true]);

            Result::where('profile_id', $profileId)
                ->whereNotIn('id', $selectedPaints)
                ->update(['incluir' => false]);
        } else {
            Result::where('profile_id', $profileId)->update(['incluir' => false]);
        }

        $profile->project->refreshIntegrityHash();
        $results = Result::where('profile_id', $profileId)->get();
        $successMessage = 'El perfil se actualizó con éxito';

        return view('dashboard.projectProfile.profile-show', compact('profile', 'results', 'successMessage'));
    }

    public function destroy($profileId)
    {
        $profile = Profile::with('project')->findOrFail($profileId);
        $this->authorizeProjectAccess($profile->project);

        $projectId = $profile->project_id;
        $project = $profile->project;
        $profile->delete();

        if ($project) {
            $project->refreshIntegrityHash();
        }

        return view('dashboard.projectProfile.profile-index', ['project' => $projectId])
            ->with('success', 'El perfil se eliminó con éxito');
    }
}
