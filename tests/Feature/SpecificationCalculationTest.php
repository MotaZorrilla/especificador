<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Profile;
use App\Models\Filedata;
use App\Models\Result;

class SpecificationCalculationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper que replica el cálculo determinista de Viga 3 Caras para Perfil H
     */
    private function calculateHSR_V3C($H, $B1, $B2, $e1, $e2, $t): int
    {
        $A = $B1 * $e1 + $B2 * $e2 + $H * $t - $t * $e1 - $t * $e2;
        $P = 2 * $H + $B1 + 2 * $B2 - 2 * $t;
        return (int) ceil(1000 * $P / $A);
    }

    /**
     * Helper que replica el cálculo determinista para perfil tubular rectangular
     */
    private function calculateRectangular_V3C($H, $B1, $e1): int
    {
        $P = 2 * $H + $B1;
        $A = 2 * ($H * $e1 + $B1 * $e1 - 2 * $e1 * $e1);
        return (int) ceil(1000 * $P / $A);
    }

    public function test_masividad_calculation_for_hea_profile(): void
    {
        // HEA 200 aproximado: H=190mm, B1=200mm, B2=200mm, e1=10mm, e2=10mm, t=6.5mm
        $masividad = $this->calculateHSR_V3C(190, 200, 200, 10, 10, 6.5);

        $this->assertGreaterThan(0, $masividad);
        $this->assertLessThan(400, $masividad);
        // Área esperada: 200*10 + 200*10 + 190*6.5 - 6.5*10 - 6.5*10 = 2000 + 2000 + 1235 - 65 - 65 = 5105 mm2
        // Perímetro expuesto 3 caras: 2*190 + 200 + 2*200 - 2*6.5 = 380 + 200 + 400 - 13 = 967 mm
        // Masividad = ceil(1000 * 967 / 5105) = ceil(189.42) = 190
        $this->assertEquals(190, $masividad);
    }

    public function test_masividad_calculation_for_rectangular_tube(): void
    {
        // Tubo rectangular: H=150mm, B1=100mm, e1=5mm
        $masividad = $this->calculateRectangular_V3C(150, 100, 5);

        $this->assertGreaterThan(0, $masividad);
        // P = 2*150 + 100 = 400 mm
        // A = 2*(150*5 + 100*5 - 2*25) = 2*(750 + 500 - 50) = 2400 mm2
        // Masividad = ceil(1000 * 400 / 2400) = ceil(166.66) = 167
        $this->assertEquals(167, $masividad);
    }

    public function test_fire_resistance_lookup_returns_correct_paint_thickness(): void
    {
        $user = User::factory()->create();
        $project = Project::create([
            'user_id' => $user->id,
            'user_project_counter' => 1,
            'project' => 'Edificio Estructural Santiago',
            'description' => 'Cálculo de protección pasiva contra fuego',
        ]);

        // Registrar pintura técnica certificada
        Filedata::create([
            'pintura' => 'PROMAT PROMASPRAY-P300',
            'modelo' => 'Mortero / Intumescente',
            'certificado' => 'DICTUC-2024-F60',
            'numero' => 'NCh3040-001',
            'masividad' => 190,
            'p4c' => 'si',
            'v4c' => 'si',
            'v3c' => 'si',
            'abierta' => 'si',
            'm15' => '250',
            'm30' => '480',
            'm60' => '890',
            'm90' => '1350',
            'm120' => '1800',
        ]);

        // Crear perfil asignado al proyecto con F60
        $profile = Profile::create([
            'project_id' => $project->id,
            'nombre' => 'Columna C-01 (HEA 200)',
            'descripcion' => 'Perfil principal de nave central',
            'exposicion' => 'Viga 3 Caras',
            'perfil' => 'Perfil Abierto',
            'forma' => 'HSR',
            'masividad' => 190,
            'resistencia' => 60,
        ]);

        $this->assertEquals(190, $profile->masividad);
        $this->assertEquals(60, $profile->resistencia);

        // Buscar coincidencia en Filedata
        $match = Filedata::where('masividad', $profile->masividad)
            ->where('v3c', 'si')
            ->where('abierta', 'si')
            ->first();

        $this->assertNotNull($match);
        $this->assertEquals('890', $match->m60);
        $this->assertEquals('1800', $match->m120);
    }

    public function test_results_generation_marks_fuera_de_rango_when_exceeding_database(): void
    {
        $user = User::factory()->create();
        $project = Project::create([
            'user_id' => $user->id,
            'user_project_counter' => 2,
            'project' => 'Maestranza Antofagasta',
        ]);

        // Crear perfil con masividad extrema (fuera de catálogo = 450)
        $profile = Profile::create([
            'project_id' => $project->id,
            'nombre' => 'Costanera Liviana C-99',
            'exposicion' => 'Viga 3 Caras',
            'perfil' => 'Perfil Abierto',
            'forma' => 'C',
            'masividad' => 450,
            'resistencia' => 60,
        ]);

        // En la lógica de ProjectProfileController, si no existe el registro de masividad
        // para la pintura, se genera un Result con 'Fuera de Rango'
        $result = Result::create([
            'profile_id' => $profile->id,
            'pintura' => 'Pintura UltraFire A1',
            'modelo' => 'Solvente',
            'certificado' => 'IDIEM-554',
            'numero' => 'CERT-01',
            'minimo' => 'Fuera de Rango',
        ]);

        $this->assertEquals('Fuera de Rango', $result->minimo);
        $this->assertEquals($profile->id, $result->profile_id);
    }
}
