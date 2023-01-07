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

    public function data()
    {   
        $files = File::paginate();
        
        return view('dashboard.tables', compact('files')); 
    }
        
    public function balance()
    {
        return view("dashboard.billing");
    }
}
