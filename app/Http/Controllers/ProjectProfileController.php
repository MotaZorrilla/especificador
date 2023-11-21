<?php

namespace App\Http\Controllers;

use App\Models\Filedata;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Result;
use Illuminate\Http\Request;

class ProjectProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.projectAdmin.projectAdmin-index');
    }

    public function create()
    {
        $user = auth()->user();

        $projects = project::all();

        return view('dashboard.projectProfile.profile-create', compact('user', 'projects'));
    }

    public function store(Request $request)
    {
        // Asociar el proyecto al usuario actual

        $profile = new Profile();

        $profile->project_id    = $request->project;

        // Project::where('user_id', auth()->user())->max('user_project_counter') + 1;

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
        $profile->save();

        $filedata = [];

        // Obtener datos comunes
        $masividad  = $profile->masividad;
        $dato_H     = $profile->altura;
        $dato_B1    = $profile->base1;
        $dato_B2    = $profile->base2;
        $dato_e1    = $profile->espesor1;
        $dato_e2    = $profile->espesor2;
        $dato_t     = $profile->espesort;
        $dato_r     = $profile->radio;
        $dato_C     = $profile->plieque;
        $dato_D     = $profile->diametro;

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
            $dato_A = 2 * $dato_B * $dato_e + 2 * $dato_H * $dato_e - 16 * $dato_e * $dato_e + 3 * pi() * ($dato_e * $dato_e);
            $dato_P = 2 * $dato_B + 2 * $dato_H - 16 * $dato_e + 4 * pi() * $dato_e;
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
            $dato_A = 4 * $dato_B * $dato_e + 2 * $dato_H * $dato_e + 3 * pi() * ($dato_e * $dato_e) - 16 * ($dato_e * $dato_e);
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
        function MasividadL($dato_H, $dato_B, $dato_e, $dato_r)
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

        if (!$masividad) {
            // Calcular masividad para cada perfil y exposición utilizando switch
            $dato_A = 0;
            $dato_P = 0;

            if ($profile->exposicion == 'Viga 3 Caras') {
                switch ($profile->forma) {
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
            } else {
                switch ($profile->forma) {
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
            $profile->masividad = $masividad;
        } else {
            $profile->masividad = ceil($masividad);
        }
        $profile->save();

        // Redirigir a la página de proyectos con un mensaje de éxito
        // Mostrar la vista de projectProfile.index con el parámetro 'project'
        return view('dashboard.projectProfile.profile-index', ['project' => $profile->project_id])
            ->with('success', '¡Perfil creado con éxito!');
    }

    public function show($profileId)
    {
        // return view('dashboard.projectProfile.profile-index', compact('profile'));

        $profile    = Profile::find($profileId);
        $masividad  = (int)$profile->masividad;
        $filedata    = Filedata::where('masividad', $masividad)->get();

        return view('dashboard.projectProfile.profile-show', compact('profile', 'filedata'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $profileId)
    {
        $profile = Profile::find($profileId);
        $profile->observaciones = $request->observaciones;
        $profile->save();

        // Obtener el resultado asociado al perfil
        $result = Result::where('profile_id', $profileId)->first();

        // Si no hay un resultado, crear uno nuevo
        if (!$result) {
            $result = new Result();
            $result->profile_id = $profileId;
        }

        // Actualizar los valores del resultado
        // Mover este bloque fuera de la condición if
        $result->save(); // Guardar el resultado antes de actualizar los registros

        // Obtener el array de registros del request
        $registros = $request->input('registros', []); // Ajusta el nombre según la estructura de tu formulario

        // Limpiar registros existentes
        $result->registros()->delete();

        foreach ($registros as $registro) {
            $result->registros()->create([
                'pintura'       => $registro['pintura'],
                'modelo'        => $registro['modelo'],
                'certificado'   => $registro['certificado'],
                'numero'        => $registro['numero'],
                'minimo'        => $registro['minimo'],
                'incluir'       => $registro['incluir'],
            ]);
        }

        // Resto de la lógica...

        return view('dashboard.projectProfile.profile-show', compact('profile', 'filedata'));
    }



    public function destroy($profileId)
    {
        $profile = Profile::find($profileId);

        $profile->delete();

        return view('dashboard.projectProfile.profile-index',  ['project' => $profile->project_id])
            ->with('success', 'El perfil se eliminó con éxito');
    }
}
