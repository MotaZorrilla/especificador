<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\models\User;

class PdfController extends Controller
{
    public function create()
    {
        $users = User::get();
        $pdf   = PDF::loadView('pages.pdf', compact('users')); 

        return $pdf->download('User.pdf');
    }

    public function show()
    {
        return view("pages.pdf");
    }
}
