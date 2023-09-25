<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Filedata;
use Barryvdh\DomPDF\Facade\Pdf;
use Psy\Readline\Hoa\Console;

class ProjectAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:projectAdmin');
    }

    // Display a listing of the resource.
    public function index()
    {   
        return view('dashboard.projectAdmin.projectAdmin-index');
    }

    //Show the form for creating a new resource.
    public function create()
    {
        return view('dashboard.projectAdmin.projectAdmin-create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $project = new Project();

        $project->nombre        = $request->nombre;
        $project->descripcion   = $request->descripcion;
        $project->exposicion    = $request->exposicion;
        $project->perfil        = $request->perfil;
        $project->forma         = $request->forma;
        
        $project->masividad     = $request->masividad;
        $project->resistencia   = $request->resistencia;
        
        $project->altura        = ($request->dato_H); 
        $project->base1         = ($request->dato_B1);
        $project->base2         = ($request->dato_B2);
        $project->espesor1      = ($request->dato_e1);
        $project->espesor2      = ($request->dato_e2);
        $project->espesort      = ($request->dato_t);
        $project->radio         = ($request->dato_r);
        $project->plieque       = ($request->dato_C);
        $project->diametro      = ($request->dato_D);
        
        $project->observaciones = $request->observaciones;       
        $project->save();

        return redirect()->route('projectAdmin.show', $project );
    }

    //Display the specified resource.
    public function show(Project $projectAdmin)
    {   
        $filedata = [];
        
        // Obtener datos comunes
        $masividad  = $projectAdmin->masividad;
        $dato_H     = $projectAdmin->altura;
        $dato_B1    = $projectAdmin->base1;
        $dato_B2    = $projectAdmin->base2;
        $dato_e1    = $projectAdmin->espesor1;
        $dato_e2    = $projectAdmin->espesor2;
        $dato_t     = $projectAdmin->espesort;
        $dato_r     = $projectAdmin->radio;
        $dato_C     = $projectAdmin->plieque;
        $dato_D     = $projectAdmin->diametro;
        
        // Función para calcular la masividad para el Perfil H sin Radio Viga 3 caras
        function MasividadHSR_V3C($dato_H, $dato_B1, $dato_B2,  $dato_e1, $dato_e2, $dato_t, $dato_r)
        {
            $dato_A = $dato_B1 * $dato_e1 + $dato_B2 * $dato_e2 + $dato_H * $dato_t - $dato_t * $dato_e1 - $dato_t * $dato_e2;
            $dato_P = 2 * $dato_H + $dato_B1 + 2 * $dato_B2 - 2 * $dato_t;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil H con Radio Viga 3 caras
        function MasividadHCR_V3C($dato_H, $dato_B1, $dato_B2, $dato_e1, $dato_e2, $dato_t, $dato_r)
        {
            $dato_A = $dato_B1 * $dato_e1 + $dato_B2 * $dato_e2 + $dato_H * $dato_t - $dato_t * $dato_e1 - $dato_t * $dato_e2 + 4 * ($dato_r * $dato_r - pi() * $dato_r * $dato_r / 4);
            $dato_P = 2 * $dato_H + $dato_B1 + 2 * $dato_B2 - 2 * $dato_t + 2 * pi() * $dato_r - 8 * $dato_r;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil Rectangular Viga 3 caras
        function MasividadRectangular_V3C($dato_H, $dato_B, $dato_e, $dato_r)
        {
            $dato_A = 2 * $dato_e * ($dato_B + $dato_H - 8 * $dato_e) + 3 * pi() * ($dato_e * $dato_e);
            $dato_P = $dato_B + 2 * $dato_H - 12 * $dato_e + 4 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil Circular Viga 3 Caras
        function MasividadCircular_V3C($dato_D, $dato_e)
        {
            $dato_A = pi() * $dato_D * $dato_e - pi() * ($dato_e * $dato_e);
            $dato_P = pi() * $dato_D;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil C Viga 3 Caras
        function MasividadC_V3C($dato_H, $dato_B, $dato_e, $dato_r)
        {
            $dato_A = 2 * $dato_B * $dato_e + $dato_H * $dato_e - 8 * ($dato_e * $dato_e) + 3 / 2 * pi() * ($dato_e * $dato_e);
            $dato_P = 3 * $dato_B + 2 * $dato_H - 12 * $dato_e + 3 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil IC Viga 3 Caras
        function MasividadIC_V3C($dato_H, $dato_B, $dato_e, $dato_r)
        {
            $dato_A = 4 * $dato_B * $dato_e + 2 * $dato_H * $dato_e - 16 * ($dato_e * $dato_e) + 3 * pi() * ($dato_e * $dato_e);
            $dato_P = 6 * $dato_B + 2 * $dato_H - 16 * $dato_e + 4 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil CA Viga 3 Caras
        function MasividadCA_V3C($dato_H, $dato_B, $dato_C, $dato_e, $dato_r)
        {
            $dato_A = 2 * $dato_C * $dato_e + 2 * $dato_B * $dato_e + $dato_H * $dato_e - 16 * ($dato_e * $dato_e) + 3 * pi() * ($dato_e * $dato_e);
            $dato_P = 4 * $dato_C + 3 * $dato_B + 2 * $dato_H + 6 * pi() * $dato_e - 26 * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil ICA Viga 3 Caras
        function MasividadICA_V3C($dato_H, $dato_B, $dato_C, $dato_e, $dato_r)
        {
            $dato_A = 4 * $dato_C * $dato_e + 4 * $dato_B * $dato_e + 2 * $dato_H * $dato_e - 32 * ($dato_e * $dato_e) + 6 * pi() * ($dato_e * $dato_e);
            $dato_P = 8 * $dato_C + 6 * $dato_B + 2 * $dato_H - 44 * $dato_e + 10 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil OCA Viga 3 Caras
        function MasividadOCA_V3C($dato_H, $dato_B, $dato_C, $dato_e, $dato_r)
        {
            $dato_A = 4 * $dato_C * $dato_e + 4 * $dato_B * $dato_e + 2 * $dato_H * $dato_e - 32 * ($dato_e * $dato_e) + 6 * pi() * ($dato_e * $dato_e);
            $dato_P = 2 * $dato_B + 2 * $dato_H - 16 * $dato_e + 6 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil L Viga 3 Caras
        function MasividadL_V3C($dato_H, $dato_B, $dato_e, $dato_r)
        {
            $dato_A = $dato_H * $dato_e + $dato_B * $dato_e - 4 * ($dato_e * $dato_e) + 3 / 4 * pi() * ($dato_e * $dato_e);
            $dato_P = 2 * $dato_H + $dato_B - 4 * $dato_e + 6 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil Z Viga 3 Caras
        function MasividadZ_V3C($dato_H, $dato_B1, $dato_B2, $dato_C, $dato_e, $dato_r)
        {
            $tanValue = tan(22.5 * pi() / 180);
            $dato_A = ($dato_H + 2) * $dato_e + 2 * $dato_C * $dato_e + $dato_B1 * $dato_e + $dato_B2 * $dato_e + 9 / 4 * pi() * ($dato_e * $dato_e) - 8 * ($dato_e * $dato_e) * $tanValue - 8 * ($dato_e * $dato_e);
            $dato_P = 4 * $dato_C + 2 * $dato_B2 + $dato_B1 + 2 * $dato_H - 14 * $dato_e * $tanValue - 12 * $dato_e + 9 / 2 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }


        // Función para calcular la masividad para el Perfil H sin Radio Pilar y Viga 4 Caras
        function MasividadHSR($dato_H, $dato_B1, $dato_B2, $dato_e1, $dato_e2, $dato_t)
        {
            $dato_A = $dato_B1 * $dato_e1 + $dato_B2 * $dato_e2 + $dato_H * $dato_t - $dato_t * $dato_e1 - $dato_t * $dato_e2;
            $dato_P = 2 * $dato_H + 2 * $dato_B1 + 2 * $dato_B2 - 2 * $dato_t;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil H con Radio Pilar y Viga 4 Caras
        function MasividadHCR($dato_H, $dato_B1, $dato_B2, $dato_e1, $dato_e2, $dato_t, $dato_r)
        {
            $dato_A = $dato_B1 * $dato_e1 + $dato_B2 * $dato_e2 + $dato_H * $dato_t - $dato_t * $dato_e1 - $dato_t * $dato_e2 + 4 * ($dato_r * $dato_r - pi() * $dato_r * $dato_r / 4);
            $dato_P = 2 * $dato_H + 2 * $dato_B1 + 2 * $dato_B2 - 2 * $dato_t + 2 * pi() * $dato_r - 8 * $dato_r;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil Rectangular Pilar y Viga 4 Caras
        function MasividadRectangular($dato_H, $dato_B, $dato_e, $dato_r)
        {
            $dato_A = 2 * $dato_B * $dato_e + 2 * $dato_H * $dato_e - 16 * $dato_e* $dato_e + 3 * pi() * ($dato_e * $dato_e);
            $dato_P = 2* $dato_B + 2 * $dato_H - 16 * $dato_e + 4 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil Circular Pilar y Viga 4 Caras
        function MasividadCircular($dato_D, $dato_e)
        {
            $dato_A = pi() * $dato_D * $dato_e - pi() * ($dato_e * $dato_e);
            $dato_P = pi() * $dato_D;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil C Pilar y Viga 4 Caras
        function MasividadC($dato_H, $dato_B, $dato_e, $dato_r)
        {
            $dato_A = 2 * $dato_B * $dato_e + $dato_H * $dato_e - 8 * ($dato_e * $dato_e) + 3 / 2 * pi() * ($dato_e * $dato_e);
            $dato_P = 4 * $dato_B + 2 * $dato_H - 14 * $dato_e + 3 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil IC Pilar y Viga 4 Caras
        function MasividadIC($dato_H, $dato_B, $dato_e, $dato_r)
        {
            $dato_A = 4 * $dato_B * $dato_e + 2 * $dato_H * $dato_e + 3 * pi() * ($dato_e * $dato_e) - 16 * ($dato_e * $dato_e) ;
            $dato_P = 8 * $dato_B + 2 * $dato_H - 20 * $dato_e + 6 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil CA Pilar y Viga 4 Caras
        function MasividadCA($dato_H, $dato_B, $dato_C, $dato_e, $dato_r)
        {
            $dato_A = 2 * $dato_C * $dato_e + 2 * $dato_B * $dato_e + $dato_H * $dato_e - 16 * ($dato_e * $dato_e) + 3 * pi() * ($dato_e * $dato_e);
            $dato_P = 4 * $dato_C + 4 * $dato_B + 2 * $dato_H + 6 * pi() * $dato_e - 30 * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil ICA Pilar y Viga 4 Caras
        function MasividadICA($dato_H, $dato_B, $dato_C, $dato_e, $dato_r)
        {
            $dato_A = 4 * $dato_C * $dato_e + 4 * $dato_B * $dato_e + 2 * $dato_H * $dato_e - 32 * ($dato_e * $dato_e) + 6 * pi() * ($dato_e * $dato_e);
            $dato_P = 8 * $dato_C + 8 * $dato_B + 2 * $dato_H - 52 * $dato_e + 12 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil OCA Pilar y Viga 4 Caras
        function MasividadOCA($dato_H, $dato_B, $dato_C, $dato_e, $dato_r)
        {
            $dato_A = 4 * $dato_C * $dato_e + 4 * $dato_B * $dato_e + 2 * $dato_H * $dato_e - 32 * ($dato_e * $dato_e) + 6 * pi() * ($dato_e * $dato_e);
            $dato_P = 4 * $dato_B + 2 * $dato_H - 24 * $dato_e + 8 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil L Pilar y Viga 4 Caras
        function MasividadL( $dato_H, $dato_B, $dato_e, $dato_r)
        {
            $dato_A = $dato_H * $dato_e + $dato_B * $dato_e - 4 * ($dato_e * $dato_e) + 3 / 4 * pi() * ($dato_e * $dato_e);
            $dato_P = 2 * $dato_H + 2 * $dato_B - 6 * $dato_e + 3 / 2 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil Z Pilar y Viga 4 Caras
        function MasividadZ($dato_H, $dato_B1, $dato_B2, $dato_C, $dato_e, $dato_r)
        {
            $tanValue = tan(22.5 * pi() / 180);
            $dato_A = ($dato_H + 2) * $dato_e + 2 * $dato_C * $dato_e + $dato_B1 * $dato_e + $dato_B2 * $dato_e + 9 / 4 * pi() * ($dato_e * $dato_e) - 8 * ($dato_e * $dato_e) * $tanValue - 8 * ($dato_e * $dato_e);
            $dato_P = 4 * $dato_C + 2 * $dato_B1 + 2 * $dato_B2 + 2 * $dato_H - 16 * $dato_e * $tanValue - 14 * $dato_e + 9 / 2 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        if ( !$masividad){
            // Calcular masividad para cada perfil y exposición utilizando switch
            $dato_A = 0;
            $dato_P = 0;

            if ( $projectAdmin->exposicion == 'Viga 3 Caras') {
                switch ($projectAdmin->forma) {
                    case 'HSR':
                        $masividad = MasividadHSR_V3C($dato_H, $dato_B1, $dato_B2, $dato_e1, $dato_e2, $dato_t, $dato_r);
                        break;
                    case 'HCR':
                        $masividad = MasividadHCR_V3C($dato_H, $dato_B1, $dato_B2, $dato_e1, $dato_e2, $dato_t, $dato_r);
                        break;
                    case 'R':
                        $masividad = MasividadRectangular_V3C($dato_H, $dato_B1, $dato_e1, $dato_r);
                        break;
                    case 'Circular':
                        $masividad = MasividadCircular_V3C($dato_D, $dato_e1);
                        break;
                    case 'C':
                        $masividad = MasividadC_V3C($dato_H, $dato_B1, $dato_e1, $dato_r);
                        break;
                    case 'IC':
                        $masividad = MasividadIC_V3C($dato_H, $dato_B1, $dato_e1, $dato_r);
                        break;
                    case 'CA': 
                        $masividad = MasividadCA_V3C($dato_H, $dato_B1, $dato_C, $dato_e1, $dato_r);
                        break;
                    case 'ICA': 
                        $masividad = MasividadICA_V3C($dato_H, $dato_B1, $dato_C, $dato_e1, $dato_r);
                        break;
                    case 'OCA': 
                        $masividad = MasividadOCA_V3C($dato_H, $dato_B1, $dato_C, $dato_e1, $dato_r);
                        break;
                    case 'L': 
                        $masividad = MasividadL_V3C($dato_H, $dato_B1, $dato_e1, $dato_r);
                        break;
                    case 'Z': 
                        $masividad = MasividadZ_V3C($dato_H, $dato_B1, $dato_B2, $dato_C, $dato_e1, $dato_r);
                        break;
                }
            }   else {  
                switch ($projectAdmin->forma) {
                    case 'HSR':
                        $masividad = MasividadHSR($dato_H, $dato_B1, $dato_B2, $dato_e1, $dato_e2, $dato_t);
                        break;
                    case 'HCR':
                        $masividad = MasividadHCR($dato_H, $dato_B1, $dato_B2, $dato_e1, $dato_e2, $dato_t, $dato_r);
                        break;
                    case 'R':
                        $masividad = MasividadRectangular($dato_H, $dato_B1, $dato_e1, $dato_r);
                        break;
                    case 'Circular':
                        $masividad = MasividadCircular($dato_D, $dato_e1);
                        break;
                    case 'C':
                        $masividad = MasividadC($dato_H, $dato_B1, $dato_e1, $dato_r);
                        break;
                    case 'IC':
                        $masividad = MasividadIC($dato_H, $dato_B1, $dato_e1, $dato_r);
                        break;
                    case 'CA':
                        $masividad = MasividadCA($dato_H, $dato_B1, $dato_C, $dato_e1, $dato_r);
                        break;
                    case 'ICA':
                        $masividad = MasividadICA($dato_H, $dato_B1, $dato_C, $dato_e1, $dato_r);
                        break;
                    case 'OCA':
                        $masividad = MasividadOCA($dato_H, $dato_B1, $dato_C, $dato_e1, $dato_r);
                        break;
                    case 'L':
                        $masividad = MasividadL($dato_H, $dato_B1, $dato_e1, $dato_r);
                        break;
                    case 'Z':
                        $masividad = MasividadZ($dato_H, $dato_B1, $dato_B2, $dato_C, $dato_e1, $dato_r);
                        break;
                    }
            }  
            // Asegurarse de que la masividad sea positiva
            $masividad = max($masividad, 0);
            $projectAdmin->masividad = $masividad;
            
        } else { 
            $projectAdmin->masividad = ceil($masividad);
        }
        $projectAdmin->save();

        // cargar los datos de la tabla $filedata
        $filedata = Filedata::where('masividad', $projectAdmin->masividad)->get();

        return view('dashboard.projectAdmin.projectAdmin-show', compact('projectAdmin', 'filedata'));

    }
   

    //Show the form for editing the specified resource.
    public function edit(Project $projectAdmin)
    {
        return view('dashboard.projectAdmin.projectAdmin-edit', compact('projectAdmin'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, Project $projectAdmin)
    {
        $projectAdmin->nombre        = $request->nombre;
        $projectAdmin->descripcion   = $request->descripcion;
        $projectAdmin->perfil        = $request->perfil;
        $projectAdmin->masividad     = $request->masividad;
        $projectAdmin->resistencia   = $request->resistencia;

        $projectAdmin->save();

        $filedata = Filedata::where('masividad', $projectAdmin->masividad)
                            ->get();

        return view('dashboard.projectAdmin.projectAdmin-show', compact('projectAdmin','filedata'));
    }

    //Remove the specified resource from storage.
    public function destroy(Project $projectAdmin)
    {
        $projectAdmin->delete();

        return redirect()->route('projectAdmin.index')->with('success', 'El proyecto se eliminó con éxito');
    }

    public function pdf(Project $projectAdmin)
    {   
        
        $filedata = Filedata::where('masividad', $projectAdmin->masividad )
        //  ->where('m90', '!=', 'Fuera de rango')
        // ->latest('id')
        // ->take(4)
        ->get();

        // return view('dashboard.project.project-pdf', compact('project', 'filedata'));
        $pdf   = PDF::loadView('dashboard.projectAdmin.projectAdmin-pdf', compact('projectAdmin', 'filedata'));

        return $pdf->download('Especificador de pintura Administrador.pdf');
    }

    public function updateProjectAdmin(Request $request, Project $projectAdmin)
    {
        // Actualiza los datos del proyecto
        $projectAdmin->observaciones = $request->observaciones;

        $projectAdmin->save();

        $filedata = Filedata::where('masividad', ceil($projectAdmin->masividad))
                            ->get();
        
        // Redirige al usuario a la página de edición del proyecto
        return view('dashboard.projectAdmin.projectAdmin-show', compact('projectAdmin','filedata'));
    }


}
