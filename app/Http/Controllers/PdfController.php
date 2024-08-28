<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Filedata;
use App\Models\Project;

class PdfController extends Controller
{
    public function pdf(Project $project)
    {
        // Load additional relationships
        $project->load('user', 'profiles.results');

        // Filter profiles based on the 'incluir' attribute
        $profiles = $project->profiles->filter(function ($profile) {
            return $profile->incluir;
        });

        // Set the timezone to America/Santiago
        date_default_timezone_set('America/Santiago');
        $date = date('d-m-Y H:i');

        // Load the view with necessary variables
        $pdf = PDF::loadView('dashboard.projectAdmin.projectAdmin-pdf', compact('project', 'profiles', 'date'));

        $pdf->setPaper('letter');

        // Stream the PDF to the browser
        $response = $pdf->stream();

        // Set headers for the PDF response
        $response->header('Content-Type', 'application/pdf');
        $response->header('Content-Disposition', 'inline; filename=Especificador de Pintura Intumescente.pdf');

        return $response;
    }
}
