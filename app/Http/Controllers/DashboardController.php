<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\Models\File;
use App\Models\Filedata;
use App\Models\Plan;
use App\Models\Project;
use App\Models\Profile;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Obtener todos los proyectos del usuario
        $userProjects = $user->projects;

        // Contar todos los perfiles asociados a los proyectos del usuario
        $userProfilesCount = 0;

        foreach ($userProjects as $project) {
            $userProfilesCount += $project->profiles()->count();
        }
        $totals = [
            'user' => $user->username,
            'users' => User::count(),
            'data' => Filedata::count(),
            'plans' => Plan::count(),
            'projects' => Project::count(),
            'profiles' => Profile::count(),
            'roles' => Role::count(),
            'user_projects' => $userProjects->count(),
            'user_profiles' => $userProfilesCount,
        ];

        return view('dashboard.dashboard', compact('totals'));
    }

    public function database()
    {
        $files = File::paginate();

        return view('dashboard.database-management', compact('files'));
    }
    /*public function darkmode(Request $request)
    {   
       

        $mode = $request->input('mode');
        if (!$mode) {
            $mode = Cookie::get('mode', 'light');
        }

        $request->session()->put('mode', $mode);

        Cookie::queue(Cookie::make('mode', $mode, 60));

        return view('example', ['mode' => $mode]);
    }
        */
}
