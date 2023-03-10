<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\Models\File;


class DashboardController extends Controller
{
    public function profile()
    {   
        return view('dashboard.user-profile');
    }
    
    public function users()
    {   
        $users = User::paginate();
        
        return view('dashboard.user-management', compact('users')); 
    }

    public function database()
    {   
        $files = File::paginate();
        
        return view('dashboard.database-management', compact('files')); 
    }
        
}
