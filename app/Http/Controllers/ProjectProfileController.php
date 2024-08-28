<?php

namespace App\Http\Controllers;

use App\Models\Filedata;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Result;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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

        // Verificar el rol del usuario
        $projects = $user->hasRole('Cliente')
            ? $user->projects
            : Project::all();

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
        function MasividadHSR_V3C($dato_H, $dato_B1, $dato_B2,  $dato_e1, $dato_e2, $dato_t)
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
        function MasividadRectangular_V3C($dato_H, $dato_B, $dato_e)
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
        function MasividadC_V3C($dato_H, $dato_B, $dato_e)
        {
            $dato_A = 2 * $dato_B * $dato_e + $dato_H * $dato_e - 8 * ($dato_e * $dato_e) + 3 / 2 * pi() * ($dato_e * $dato_e);
            $dato_P = 3 * $dato_B + 2 * $dato_H - 12 * $dato_e + 3 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil IC Viga 3 Caras
        function MasividadIC_V3C($dato_H, $dato_B, $dato_e)
        {
            $dato_A = 4 * $dato_B * $dato_e + 2 * $dato_H * $dato_e - 16 * ($dato_e * $dato_e) + 3 * pi() * ($dato_e * $dato_e);
            $dato_P = 6 * $dato_B + 2 * $dato_H - 16 * $dato_e + 4 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil CA Viga 3 Caras
        function MasividadCA_V3C($dato_H, $dato_B, $dato_C, $dato_e)
        {
            $dato_A = 2 * $dato_C * $dato_e + 2 * $dato_B * $dato_e + $dato_H * $dato_e - 16 * ($dato_e * $dato_e) + 3 * pi() * ($dato_e * $dato_e);
            $dato_P = 4 * $dato_C + 3 * $dato_B + 2 * $dato_H + 6 * pi() * $dato_e - 26 * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil ICA Viga 3 Caras
        function MasividadICA_V3C($dato_H, $dato_B, $dato_C, $dato_e)
        {
            $dato_A = 4 * $dato_C * $dato_e + 4 * $dato_B * $dato_e + 2 * $dato_H * $dato_e - 32 * ($dato_e * $dato_e) + 6 * pi() * ($dato_e * $dato_e);
            $dato_P = 8 * $dato_C + 6 * $dato_B + 2 * $dato_H - 44 * $dato_e + 10 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil OCA Viga 3 Caras
        function MasividadOCA_V3C($dato_H, $dato_B, $dato_C, $dato_e)
        {
            $dato_A = 4 * $dato_C * $dato_e + 4 * $dato_B * $dato_e + 2 * $dato_H * $dato_e - 32 * ($dato_e * $dato_e) + 6 * pi() * ($dato_e * $dato_e);
            $dato_P = 2 * $dato_B + 2 * $dato_H - 16 * $dato_e + 6 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil L Viga 3 Caras
        function MasividadL_V3C($dato_H, $dato_B, $dato_e)
        {
            $dato_A = $dato_H * $dato_e + $dato_B * $dato_e - 4 * ($dato_e * $dato_e) + 3 / 4 * pi() * ($dato_e * $dato_e);
            $dato_P = 2 * $dato_H + $dato_B - 4 * $dato_e + 6 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil Z Viga 3 Caras
        function MasividadZ_V3C($dato_H, $dato_B1, $dato_B2, $dato_C, $dato_e)
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
        function MasividadRectangular($dato_H, $dato_B, $dato_e)
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
        function MasividadC($dato_H, $dato_B, $dato_e)
        {
            $dato_A = 2 * $dato_B * $dato_e + $dato_H * $dato_e - 8 * ($dato_e * $dato_e) + 3 / 2 * pi() * ($dato_e * $dato_e);
            $dato_P = 4 * $dato_B + 2 * $dato_H - 14 * $dato_e + 3 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil IC Pilar y Viga 4 Caras
        function MasividadIC($dato_H, $dato_B, $dato_e)
        {
            $dato_A = 4 * $dato_B * $dato_e + 2 * $dato_H * $dato_e + 3 * pi() * ($dato_e * $dato_e) - 16 * ($dato_e * $dato_e);
            $dato_P = 8 * $dato_B + 2 * $dato_H - 20 * $dato_e + 6 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil CA Pilar y Viga 4 Caras
        function MasividadCA($dato_H, $dato_B, $dato_C, $dato_e)
        {
            $dato_A = 2 * $dato_C * $dato_e + 2 * $dato_B * $dato_e + $dato_H * $dato_e - 16 * ($dato_e * $dato_e) + 3 * pi() * ($dato_e * $dato_e);
            $dato_P = 4 * $dato_C + 4 * $dato_B + 2 * $dato_H + 6 * pi() * $dato_e - 30 * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil ICA Pilar y Viga 4 Caras
        function MasividadICA($dato_H, $dato_B, $dato_C, $dato_e)
        {
            $dato_A = 4 * $dato_C * $dato_e + 4 * $dato_B * $dato_e + 2 * $dato_H * $dato_e - 32 * ($dato_e * $dato_e) + 6 * pi() * ($dato_e * $dato_e);
            $dato_P = 8 * $dato_C + 8 * $dato_B + 2 * $dato_H - 52 * $dato_e + 12 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil OCA Pilar y Viga 4 Caras
        function MasividadOCA($dato_H, $dato_B, $dato_C, $dato_e)
        {
            $dato_A = 4 * $dato_C * $dato_e + 4 * $dato_B * $dato_e + 2 * $dato_H * $dato_e - 32 * ($dato_e * $dato_e) + 6 * pi() * ($dato_e * $dato_e);
            $dato_P = 4 * $dato_B + 2 * $dato_H - 24 * $dato_e + 8 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil L Pilar y Viga 4 Caras
        function MasividadL($dato_H, $dato_B, $dato_e)
        {
            $dato_A = $dato_H * $dato_e + $dato_B * $dato_e - 4 * ($dato_e * $dato_e) + 3 / 4 * pi() * ($dato_e * $dato_e);
            $dato_P = 2 * $dato_H + 2 * $dato_B - 6 * $dato_e + 3 / 2 * pi() * $dato_e;
            return ceil(1000 * $dato_P / $dato_A);
        }

        // Función para calcular la masividad para el Perfil Z Pilar y Viga 4 Caras
        function MasividadZ($dato_H, $dato_B1, $dato_B2, $dato_C, $dato_e)
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
                        $masividad = MasividadHSR_V3C($dato_H, $dato_B1, $dato_B2, $dato_e1, $dato_e2, $dato_t);
                        break;
                    case 'HCR':
                        $masividad = MasividadHCR_V3C($dato_H, $dato_B1, $dato_B2, $dato_e1, $dato_e2, $dato_t, $dato_r);
                        break;
                    case 'R':
                        $masividad = MasividadRectangular_V3C($dato_H, $dato_B1, $dato_e1);
                        break;
                    case 'Circular':
                        $masividad = MasividadCircular_V3C($dato_D, $dato_e1);
                        break;
                    case 'C':
                        $masividad = MasividadC_V3C($dato_H, $dato_B1, $dato_e1);
                        break;
                    case 'IC':
                        $masividad = MasividadIC_V3C($dato_H, $dato_B1, $dato_e1);
                        break;
                    case 'CA':
                        $masividad = MasividadCA_V3C($dato_H, $dato_B1, $dato_C, $dato_e1);
                        break;
                    case 'ICA':
                        $masividad = MasividadICA_V3C($dato_H, $dato_B1, $dato_C, $dato_e1);
                        break;
                    case 'OCA':
                        $masividad = MasividadOCA_V3C($dato_H, $dato_B1, $dato_C, $dato_e1);
                        break;
                    case 'L':
                        $masividad = MasividadL_V3C($dato_H, $dato_B1, $dato_e1);
                        break;
                    case 'Z':
                        $masividad = MasividadZ_V3C($dato_H, $dato_B1, $dato_B2, $dato_C, $dato_e1);
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
                        $masividad = MasividadRectangular($dato_H, $dato_B1, $dato_e1);
                        break;
                    case 'Circular':
                        $masividad = MasividadCircular($dato_D, $dato_e1);
                        break;
                    case 'C':
                        $masividad = MasividadC($dato_H, $dato_B1, $dato_e1);
                        break;
                    case 'IC':
                        $masividad = MasividadIC($dato_H, $dato_B1, $dato_e1);
                        break;
                    case 'CA':
                        $masividad = MasividadCA($dato_H, $dato_B1, $dato_C, $dato_e1);
                        break;
                    case 'ICA':
                        $masividad = MasividadICA($dato_H, $dato_B1, $dato_C, $dato_e1);
                        break;
                    case 'OCA':
                        $masividad = MasividadOCA($dato_H, $dato_B1, $dato_C, $dato_e1);
                        break;
                    case 'L':
                        $masividad = MasividadL($dato_H, $dato_B1, $dato_e1);
                        break;
                    case 'Z':
                        $masividad = MasividadZ($dato_H, $dato_B1, $dato_B2, $dato_C, $dato_e1);
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

        if ($user = auth()->user()) {
            $user->profile_count--;
            $user->save();
        }

        // Redirigir a la página de proyectos con un mensaje de éxito
        // Mostrar la vista de projectProfile.index con el parámetro 'project'
        return view('dashboard.projectProfile.profile-index', ['project' => $profile->project_id])
            ->with('success', '¡Perfil creado con éxito!');
    }

    public function show($profileId)
    {
        // Cargar el perfil con su proyecto y resultados relacionados
        $profile = Profile::with(['project', 'results'])->findOrFail($profileId);

        // Verificar si existen resultados asociados
        if ($profile->results->isEmpty()) {
            // Generar resultados si no existen
            $this->Resultados($profile);

            // Recargar los resultados después de la generación
            $profile->load('results');
        }

        $successMessage = '';

        return view('dashboard.projectProfile.profile-show', compact('profile', 'successMessage'));
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

        // // Verificar si se seleccionaron pinturas para incluir en la tabla de resultados
        // if ($request->has('selectedPaints')) {
        //     // Obtener las pinturas seleccionadas
        //     $selectedPaints = $request->input('selectedPaints');

        //     // Obtener el resultado asociado al perfil y actualizar la propiedad "incluir"
        //     foreach ($selectedPaints as $resultId) {
        //         Result::where('id', $resultId)->update(['incluir' => true]);
        //     }
        // }
        // Verificar si se seleccionaron pinturas para incluir en la tabla de resultados
        if ($request->has('selectedPaints')) {
            // Obtener las pinturas seleccionadas
            $selectedPaints = $request->input('selectedPaints');

            // Actualizar la propiedad "incluir" de las pinturas seleccionadas
            Result::whereIn('id', $selectedPaints)->update(['incluir' => true]);

            // Desmarcar la propiedad "incluir" de las pinturas no seleccionadas
            Result::where('profile_id', $profileId)
                ->whereNotIn('id', $selectedPaints)
                ->update(['incluir' => false]);
        } else {
            // Si no se seleccionaron pinturas, desmarcar todas las pinturas asociadas al perfil
            Result::where('profile_id', $profileId)->update(['incluir' => false]);
        }

        // Recuperar todos los resultados después de la actualización
        $results = Result::where('profile_id', $profileId)->get();

        $successMessage = 'El perfil se actualizó con éxito';

        // Devolver la vista con el mensaje
        return view('dashboard.projectProfile.profile-show', compact('profile', 'results', 'successMessage'));
    }

    public function destroy($profileId)
    {
        $profile = Profile::find($profileId);

        $profile->delete();

        return view('dashboard.projectProfile.profile-index',  ['project' => $profile->project_id])
            ->with('success', 'El perfil se eliminó con éxito');
    }

    private function Resultados($profile)
    {
        $masividad  = (int)$profile->masividad;
        $filedata   = Filedata::where('masividad', $masividad)->get();

        foreach ($filedata as $filedatum) {
            $result                 = new Result();
            $result->profile_id     = $profile->id;
            $result->pintura        = $filedatum->pintura;
            $result->modelo         = $filedatum->modelo;
            $result->certificado    = $filedatum->certificado;
            $result->numero         = $filedatum->numero;
            $result->minimo         = $this->getMinimo($profile, $filedatum);
            $result->save();
        }
    }

    private function getMinimo($profile, $filedatum)
    {
        // Verificar la exposición, perfil y forma
        $exposicion = $profile->exposicion;
        $perfil = $profile->perfil;

        // Verificar si la exposición es válida
        if (
            $exposicion == 'Pilar 4 Caras' && ($filedatum->p4c == 'si' || $filedatum->p4c == 'Si') ||
            $exposicion == 'Viga 4 Caras'  && ($filedatum->v4c == 'si' || $filedatum->v4c == 'Si') ||
            $exposicion == 'Viga 3 Caras'  && ($filedatum->v3c == 'si' || $filedatum->v3c == 'Si')
        ) {
            // Verificar si el perfil es válido
            if (
                $perfil == 'Perfil Abierto'             && ($filedatum->abierta     == 'si' || $filedatum->abierta     == 'Si') ||
                $perfil == 'Perfil Cerrado Rectangular' && ($filedatum->rectangular == 'si' || $filedatum->rectangular == 'Si') ||
                $perfil == 'Perfil Cerrado Circular'    && ($filedatum->circular    == 'si' || $filedatum->circular    == 'Si')
            ) {
                // Devolver el valor mínimo correspondiente a la resistencia
                switch ($profile->resistencia) {
                    case 15:
                        return $filedatum->m15;
                    case 30:
                        return $filedatum->m30;
                    case 60:
                        return $filedatum->m60;
                    case 90:
                        return $filedatum->m90;
                    case 120:
                        return $filedatum->m120;
                    default:
                        return null;
                }
            }
        }
        // Si no se cumplen las condiciones, devolver null
        return null;
    }
}
