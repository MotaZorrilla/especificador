<?php

namespace Tests\Unit;

use App\Models\Filedata;
use App\Models\Profile;
use App\Services\MassivityCalculationEngine;
use Tests\TestCase;

class MassivityCalculationEngineTest extends TestCase
{
    protected MassivityCalculationEngine $engine;

    protected function setUp(): void
    {
        parent::setUp();
        $this->engine = new MassivityCalculationEngine();
    }

    public function test_calculates_hsr_4_caras_and_3_caras_accurately(): void
    {
        $m4 = $this->engine->masividadHSR(300, 150, 150, 10, 10, 8);
        $m3 = $this->engine->masividadHSR_V3C(300, 150, 150, 10, 10, 8);

        $this->assertGreaterThan(150, $m4);
        $this->assertGreaterThan(120, $m3);
        $this->assertGreaterThan($m3, $m4, 'La exposición a 4 caras debe tener mayor perímetro expuesto que a 3 caras.');
    }

    public function test_calculates_all_structural_geometries_without_error(): void
    {
        $this->assertGreaterThan(0, $this->engine->masividadHCR(300, 150, 150, 10, 10, 8, 12));
        $this->assertGreaterThan(0, $this->engine->masividadHCR_V3C(300, 150, 150, 10, 10, 8, 12));
        $this->assertGreaterThan(0, $this->engine->masividadRectangular(200, 100, 5));
        $this->assertGreaterThan(0, $this->engine->masividadRectangular_V3C(200, 100, 5));
        $this->assertGreaterThan(0, $this->engine->masividadCircular(200, 5));
        $this->assertGreaterThan(0, $this->engine->masividadCircular_V3C(200, 5));
        $this->assertGreaterThan(0, $this->engine->masividadC(200, 80, 6));
        $this->assertGreaterThan(0, $this->engine->masividadC_V3C(200, 80, 6));
        $this->assertGreaterThan(0, $this->engine->masividadIC(200, 80, 6));
        $this->assertGreaterThan(0, $this->engine->masividadIC_V3C(200, 80, 6));
        $this->assertGreaterThan(0, $this->engine->masividadCA(200, 80, 20, 5));
        $this->assertGreaterThan(0, $this->engine->masividadCA_V3C(200, 80, 20, 5));
        $this->assertGreaterThan(0, $this->engine->masividadICA(200, 80, 20, 5));
        $this->assertGreaterThan(0, $this->engine->masividadICA_V3C(200, 80, 20, 5));
        $this->assertGreaterThan(0, $this->engine->masividadOCA(200, 80, 20, 5));
        $this->assertGreaterThan(0, $this->engine->masividadOCA_V3C(200, 80, 20, 5));
        $this->assertGreaterThan(0, $this->engine->masividadL(100, 100, 8));
        $this->assertGreaterThan(0, $this->engine->masividadL_V3C(100, 100, 8));
        $this->assertGreaterThan(0, $this->engine->masividadZ(150, 60, 60, 20, 6));
        $this->assertGreaterThan(0, $this->engine->masividadZ_V3C(150, 60, 60, 20, 6));
    }

    public function test_returns_zero_when_denominator_is_zero_to_prevent_crash(): void
    {
        $this->assertSame(0, $this->engine->masividadRectangular(0, 0, 0));
        $this->assertSame(0, $this->engine->masividadCircular(100, 0));
        $this->assertSame(0, $this->engine->masividadL(0, 0, 0));
    }

    public function test_get_minimo_selects_fire_resistance_thickness_when_exposure_and_profile_match(): void
    {
        $profile = new Profile([
            'exposicion'  => 'Pilar 4 Caras',
            'perfil'      => 'Perfil Abierto',
            'resistencia' => 60,
        ]);

        $matchingData = new Filedata([
            'p4c'     => 'si',
            'abierta' => 'si',
            'm60'     => '410',
        ]);

        $nonMatchingData = new Filedata([
            'p4c'     => 'no',
            'abierta' => 'si',
            'm60'     => '410',
        ]);

        $this->assertSame('410', $this->engine->getMinimo($profile, $matchingData));
        $this->assertNull($this->engine->getMinimo($profile, $nonMatchingData));
    }

    public function test_preserves_manual_massivity_for_open_profile_without_dimensions(): void
    {
        $profile = new Profile([
            'perfil'     => 'Perfil Abierto',
            'exposicion' => 'Pilar 4 Caras',
            'forma'      => 'HSR',
            'masividad'  => 215,
        ]);

        $this->assertSame(215, $this->engine->calculateForProfile($profile));
    }
}
