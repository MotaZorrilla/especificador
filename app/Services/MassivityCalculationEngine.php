<?php

namespace App\Services;

use App\Models\Filedata;
use App\Models\Profile;
use App\Models\Result;

class MassivityCalculationEngine
{
    /**
     * Calcula el factor de masividad S/V (m^-1) redondeado al entero superior (ceil)
     * según la exposición (Viga 3 Caras, Viga 4 Caras, Pilar 4 Caras) y la forma geométrica.
     */
    public function calculateForProfile(Profile $profile): int
    {
        if (!empty($profile->masividad) && $profile->masividad > 0) {
            return (int) ceil((float) $profile->masividad);
        }

        return $this->calculate(
            (string) $profile->exposicion,
            (string) $profile->forma,
            [
                'H'  => (float) ($profile->altura ?? 0),
                'B1' => (float) ($profile->base1 ?? 0),
                'B2' => (float) ($profile->base2 ?? 0),
                'e1' => (float) ($profile->espesor1 ?? 0),
                'e2' => (float) ($profile->espesor2 ?? 0),
                't'  => (float) ($profile->espesort ?? 0),
                'r'  => (float) ($profile->radio ?? 0),
                'C'  => (float) ($profile->plieque ?? 0),
                'D'  => (float) ($profile->diametro ?? 0),
            ]
        );
    }

    public function calculate(string $exposicion, string $forma, array $dim): int
    {
        $H  = (float) ($dim['H'] ?? 0);
        $B1 = (float) ($dim['B1'] ?? 0);
        $B2 = (float) ($dim['B2'] ?? 0);
        $e1 = (float) ($dim['e1'] ?? 0);
        $e2 = (float) ($dim['e2'] ?? 0);
        $t  = (float) ($dim['t'] ?? 0);
        $r  = (float) ($dim['r'] ?? 0);
        $C  = (float) ($dim['C'] ?? 0);
        $D  = (float) ($dim['D'] ?? 0);

        $masividad = 0;

        if ($exposicion === 'Viga 3 Caras') {
            switch ($forma) {
                case 'HSR':
                    $masividad = $this->masividadHSR_V3C($H, $B1, $B2, $e1, $e2, $t);
                    break;
                case 'HCR':
                    $masividad = $this->masividadHCR_V3C($H, $B1, $B2, $e1, $e2, $t, $r);
                    break;
                case 'R':
                    $masividad = $this->masividadRectangular_V3C($H, $B1, $e1);
                    break;
                case 'Circular':
                    $masividad = $this->masividadCircular_V3C($D, $e1);
                    break;
                case 'C':
                    $masividad = $this->masividadC_V3C($H, $B1, $e1);
                    break;
                case 'IC':
                    $masividad = $this->masividadIC_V3C($H, $B1, $e1);
                    break;
                case 'CA':
                    $masividad = $this->masividadCA_V3C($H, $B1, $C, $e1);
                    break;
                case 'ICA':
                    $masividad = $this->masividadICA_V3C($H, $B1, $C, $e1);
                    break;
                case 'OCA':
                    $masividad = $this->masividadOCA_V3C($H, $B1, $C, $e1);
                    break;
                case 'L':
                    $masividad = $this->masividadL_V3C($H, $B1, $e1);
                    break;
                case 'Z':
                    $masividad = $this->masividadZ_V3C($H, $B1, $B2, $C, $e1);
                    break;
            }
        } else {
            switch ($forma) {
                case 'HSR':
                    $masividad = $this->masividadHSR($H, $B1, $B2, $e1, $e2, $t);
                    break;
                case 'HCR':
                    $masividad = $this->masividadHCR($H, $B1, $B2, $e1, $e2, $t, $r);
                    break;
                case 'R':
                    $masividad = $this->masividadRectangular($H, $B1, $e1);
                    break;
                case 'Circular':
                    $masividad = $this->masividadCircular($D, $e1);
                    break;
                case 'C':
                    $masividad = $this->masividadC($H, $B1, $e1);
                    break;
                case 'IC':
                    $masividad = $this->masividadIC($H, $B1, $e1);
                    break;
                case 'CA':
                    $masividad = $this->masividadCA($H, $B1, $C, $e1);
                    break;
                case 'ICA':
                    $masividad = $this->masividadICA($H, $B1, $C, $e1);
                    break;
                case 'OCA':
                    $masividad = $this->masividadOCA($H, $B1, $C, $e1);
                    break;
                case 'L':
                    $masividad = $this->masividadL($H, $B1, $e1);
                    break;
                case 'Z':
                    $masividad = $this->masividadZ($H, $B1, $B2, $C, $e1);
                    break;
            }
        }

        return (int) max($masividad, 0);
    }

    /**
     * Genera los resultados estequiométricos de pinturas certificadas para un perfil dado.
     */
    public function generateResultsForProfile(Profile $profile): void
    {
        $masividad = (int) $profile->masividad;
        $filedata = Filedata::orderBy('id', 'asc')->get();

        $pinturasSinMasividad = [];
        $pinturasConMasividad = [];
        $resultadosConMasividad = [];

        foreach ($filedata as $filedatum) {
            if ((int) $filedatum->masividad === $masividad) {
                $resultadosConMasividad[] = [
                    'pintura'     => $filedatum->pintura,
                    'modelo'      => $filedatum->modelo,
                    'certificado' => $filedatum->certificado,
                    'numero'      => $filedatum->numero,
                    'minimo'      => $this->getMinimo($profile, $filedatum),
                ];

                $pinturasConMasividad[] = $filedatum->pintura;
            } else {
                if (!in_array($filedatum->pintura, array_column($pinturasSinMasividad, 'pintura'))) {
                    $pinturasSinMasividad[] = [
                        'pintura'     => $filedatum->pintura,
                        'modelo'      => $filedatum->modelo,
                        'certificado' => $filedatum->certificado,
                        'numero'      => $filedatum->numero,
                    ];
                }
            }
        }

        $agrupadosPorPintura = [];
        foreach ($resultadosConMasividad as $resultado) {
            $clave = $resultado['pintura'] . '|' . $resultado['modelo'] . '|' . $resultado['certificado'] . '|' . $resultado['numero'];
            $agrupadosPorPintura[$clave][] = $resultado;
        }

        foreach ($agrupadosPorPintura as $registros) {
            $registrosConMinimo = array_filter($registros, fn($r) => $r['minimo'] !== null && $r['minimo'] !== '');

            if (!empty($registrosConMinimo)) {
                foreach ($registrosConMinimo as $registro) {
                    Result::create([
                        'profile_id'  => $profile->id,
                        'pintura'     => $registro['pintura'],
                        'modelo'      => $registro['modelo'],
                        'certificado' => $registro['certificado'],
                        'numero'      => $registro['numero'],
                        'minimo'      => $registro['minimo'],
                    ]);
                }
            } else {
                $primerRegistro = $registros[0];
                Result::create([
                    'profile_id'  => $profile->id,
                    'pintura'     => $primerRegistro['pintura'],
                    'modelo'      => $primerRegistro['modelo'],
                    'certificado' => $primerRegistro['certificado'],
                    'numero'      => $primerRegistro['numero'],
                    'minimo'      => 'Fuera de Rango',
                ]);
            }
        }

        $pinturasSinMasividad = array_filter($pinturasSinMasividad, function ($item) use ($pinturasConMasividad) {
            return !in_array($item['pintura'], $pinturasConMasividad);
        });

        foreach ($pinturasSinMasividad as $item) {
            Result::create([
                'profile_id'  => $profile->id,
                'pintura'     => $item['pintura'],
                'modelo'      => $item['modelo'],
                'certificado' => $item['certificado'],
                'numero'      => $item['numero'],
                'minimo'      => 'Fuera de Rango',
            ]);
        }
    }

    public function getMinimo(Profile $profile, Filedata $filedatum): ?string
    {
        $exposicion = $profile->exposicion;
        $perfil = $profile->perfil;

        $expOk = ($exposicion === 'Pilar 4 Caras' && strtolower((string) $filedatum->p4c) === 'si')
            || ($exposicion === 'Viga 4 Caras' && strtolower((string) $filedatum->v4c) === 'si')
            || ($exposicion === 'Viga 3 Caras' && strtolower((string) $filedatum->v3c) === 'si');

        if (!$expOk) {
            return null;
        }

        $perfilOk = ($perfil === 'Perfil Abierto' && strtolower((string) $filedatum->abierta) === 'si')
            || ($perfil === 'Perfil Cerrado Rectangular' && strtolower((string) $filedatum->rectangular) === 'si')
            || ($perfil === 'Perfil Cerrado Circular' && strtolower((string) $filedatum->circular) === 'si');

        if (!$perfilOk) {
            return null;
        }

        switch ((int) $profile->resistencia) {
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

    private function safeRatio(float $P, float $A): int
    {
        if ($A <= 0) {
            return 0;
        }
        return (int) ceil(1000 * $P / $A);
    }

    // --- VIGA 3 CARAS ---
    public function masividadHSR_V3C($H, $B1, $B2, $e1, $e2, $t): int
    {
        $A = $B1 * $e1 + $B2 * $e2 + $H * $t - $t * $e1 - $t * $e2;
        $P = 2 * $H + $B1 + 2 * $B2 - 2 * $t;
        return $this->safeRatio($P, $A);
    }

    public function masividadHCR_V3C($H, $B1, $B2, $e1, $e2, $t, $r): int
    {
        $A = $B1 * $e1 + $B2 * $e2 + $H * $t - $t * $e1 - $t * $e2 + 4 * ($r * $r - pi() * $r * $r / 4);
        $P = 2 * $H + $B1 + 2 * $B2 - 2 * $t + 2 * pi() * $r - 8 * $r;
        return $this->safeRatio($P, $A);
    }

    public function masividadRectangular_V3C($H, $B, $e): int
    {
        $A = 2 * $e * ($B + $H - 8 * $e) + 3 * pi() * ($e * $e);
        $P = $B + 2 * $H - 12 * $e + 4 * pi() * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadCircular_V3C($D, $e): int
    {
        $A = pi() * $D * $e - pi() * ($e * $e);
        $P = pi() * $D;
        return $this->safeRatio($P, $A);
    }

    public function masividadC_V3C($H, $B, $e): int
    {
        $A = 2 * $B * $e + $H * $e - 8 * ($e * $e) + 1.5 * pi() * ($e * $e);
        $P = 3 * $B + 2 * $H - 12 * $e + 3 * pi() * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadIC_V3C($H, $B, $e): int
    {
        $A = 4 * $B * $e + 2 * $H * $e - 16 * ($e * $e) + 3 * pi() * ($e * $e);
        $P = 6 * $B + 2 * $H - 16 * $e + 4 * pi() * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadCA_V3C($H, $B, $C, $e): int
    {
        $A = 2 * $C * $e + 2 * $B * $e + $H * $e - 16 * ($e * $e) + 3 * pi() * ($e * $e);
        $P = 4 * $C + 3 * $B + 2 * $H + 6 * pi() * $e - 26 * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadICA_V3C($H, $B, $C, $e): int
    {
        $A = 4 * $C * $e + 4 * $B * $e + 2 * $H * $e - 32 * ($e * $e) + 6 * pi() * ($e * $e);
        $P = 8 * $C + 6 * $B + 2 * $H - 44 * $e + 10 * pi() * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadOCA_V3C($H, $B, $C, $e): int
    {
        $A = 4 * $C * $e + 4 * $B * $e + 2 * $H * $e - 32 * ($e * $e) + 6 * pi() * ($e * $e);
        $P = 2 * $B + 2 * $H - 16 * $e + 6 * pi() * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadL_V3C($H, $B, $e): int
    {
        $A = $H * $e + $B * $e - 4 * ($e * $e) + 0.75 * pi() * ($e * $e);
        $P = 2 * $H + $B - 4 * $e + 6 * pi() * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadZ_V3C($H, $B1, $B2, $C, $e): int
    {
        $tanValue = tan(22.5 * pi() / 180);
        $A = ($H + 2) * $e + 2 * $C * $e + $B1 * $e + $B2 * $e + 2.25 * pi() * ($e * $e) - 8 * ($e * $e) * $tanValue - 8 * ($e * $e);
        $P = 4 * $C + 2 * $B2 + $B1 + 2 * $H - 14 * $e * $tanValue - 12 * $e + 4.5 * pi() * $e;
        return $this->safeRatio($P, $A);
    }

    // --- PILAR Y VIGA 4 CARAS ---
    public function masividadHSR($H, $B1, $B2, $e1, $e2, $t): int
    {
        $A = $B1 * $e1 + $B2 * $e2 + $H * $t - $t * $e1 - $t * $e2;
        $P = 2 * $H + 2 * $B1 + 2 * $B2 - 2 * $t;
        return $this->safeRatio($P, $A);
    }

    public function masividadHCR($H, $B1, $B2, $e1, $e2, $t, $r): int
    {
        $A = $B1 * $e1 + $B2 * $e2 + $H * $t - $t * $e1 - $t * $e2 + 4 * ($r * $r - pi() * $r * $r / 4);
        $P = 2 * $H + 2 * $B1 + 2 * $B2 - 2 * $t + 2 * pi() * $r - 8 * $r;
        return $this->safeRatio($P, $A);
    }

    public function masividadRectangular($H, $B, $e): int
    {
        $A = 2 * $B * $e + 2 * $H * $e - 16 * $e * $e + 3 * pi() * ($e * $e);
        $P = 2 * $B + 2 * $H - 16 * $e + 4 * pi() * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadCircular($D, $e): int
    {
        $A = pi() * $D * $e - pi() * ($e * $e);
        $P = pi() * $D;
        return $this->safeRatio($P, $A);
    }

    public function masividadC($H, $B, $e): int
    {
        $A = 2 * $B * $e + $H * $e - 8 * ($e * $e) + 1.5 * pi() * ($e * $e);
        $P = 4 * $B + 2 * $H - 14 * $e + 3 * pi() * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadIC($H, $B, $e): int
    {
        $A = 4 * $B * $e + 2 * $H * $e + 3 * pi() * ($e * $e) - 16 * ($e * $e);
        $P = 8 * $B + 2 * $H - 20 * $e + 6 * pi() * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadCA($H, $B, $C, $e): int
    {
        $A = 2 * $C * $e + 2 * $B * $e + $H * $e - 16 * ($e * $e) + 3 * pi() * ($e * $e);
        $P = 4 * $C + 4 * $B + 2 * $H + 6 * pi() * $e - 30 * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadICA($H, $B, $C, $e): int
    {
        $A = 4 * $C * $e + 4 * $B * $e + 2 * $H * $e - 32 * ($e * $e) + 6 * pi() * ($e * $e);
        $P = 8 * $C + 8 * $B + 2 * $H - 52 * $e + 12 * pi() * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadOCA($H, $B, $C, $e): int
    {
        $A = 4 * $C * $e + 4 * $B * $e + 2 * $H * $e - 32 * ($e * $e) + 6 * pi() * ($e * $e);
        $P = 4 * $B + 2 * $H - 24 * $e + 8 * pi() * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadL($H, $B, $e): int
    {
        $A = $H * $e + $B * $e - 4 * ($e * $e) + 0.75 * pi() * ($e * $e);
        $P = 2 * $H + 2 * $B - 6 * $e + 1.5 * pi() * $e;
        return $this->safeRatio($P, $A);
    }

    public function masividadZ($H, $B1, $B2, $C, $e): int
    {
        $tanValue = tan(22.5 * pi() / 180);
        $A = ($H + 2) * $e + 2 * $C * $e + $B1 * $e + $B2 * $e + 2.25 * pi() * ($e * $e) - 8 * ($e * $e) * $tanValue - 8 * ($e * $e);
        $P = 4 * $C + 2 * $B1 + 2 * $B2 + 2 * $H - 16 * $e * $tanValue - 14 * $e + 4.5 * pi() * $e;
        return $this->safeRatio($P, $A);
    }
}
