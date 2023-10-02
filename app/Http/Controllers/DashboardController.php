<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\Models\File;
use Illuminate\Support\Facades\Cookie;


class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.dashboard');
    }

    public function profile()
    {   
        return view('dashboard.user-profile');
    }
    
    // public function users()
    // {   
    //     $users = User::paginate();
        
    //     return view('dashboard.user-management', compact('users')); 
    // }

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
