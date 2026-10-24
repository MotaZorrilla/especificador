<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectProfileBatchService
{
    public function __construct(
        protected MassivityCalculationEngine $engine
    ) {}

    /**
     * Importa y calcula por lotes (chunk 500) un listado masivo de perfiles estructurales para un proyecto.
     *
     * @param Project $project
     * @param iterable $rows Arreglo o colección de filas de perfiles
     * @return array
     */
    public function importProfilesForProject(Project $project, iterable $rows): array
    {
        $validPayloads = [];
        $skippedRows = [];
        $now = now();
        $rowIndex = 0;

        foreach ($rows as $row) {
            $rowIndex++;
            $data = is_array($row) ? $row : (array) $row;

            $nombre = trim((string) ($data['nombre'] ?? $data[0] ?? ''));
            if ($nombre === '' || strtolower($nombre) === 'nombre') {
                if ($nombre === '') {
                    $skippedRows[] = [
                        'row' => $rowIndex,
                        'reason' => 'Nombre del perfil vacío',
                    ];
                }
                continue;
            }

            $exposicion = trim((string) ($data['exposicion'] ?? $data[1] ?? 'Viga 3 Caras'));
            $perfil     = trim((string) ($data['perfil'] ?? $data[2] ?? 'Perfil Abierto'));
            $forma      = trim((string) ($data['forma'] ?? $data[3] ?? 'HSR'));
            $resistencia = $this->parsePositiveNumber($data['resistencia'] ?? $data[4] ?? 60);

            $H  = $this->parsePositiveNumber($data['altura'] ?? $data['H'] ?? $data[5] ?? 0);
            $B1 = $this->parsePositiveNumber($data['base1'] ?? $data['B1'] ?? $data[6] ?? 0);
            $B2 = $this->parsePositiveNumber($data['base2'] ?? $data['B2'] ?? $data[7] ?? 0);
            $e1 = $this->parsePositiveNumber($data['espesor1'] ?? $data['e1'] ?? $data[8] ?? 0);
            $e2 = $this->parsePositiveNumber($data['espesor2'] ?? $data['e2'] ?? $data[9] ?? 0);
            $t  = $this->parsePositiveNumber($data['espesort'] ?? $data['t'] ?? $data[10] ?? 0);
            $r  = $this->parsePositiveNumber($data['radio'] ?? $data['r'] ?? $data[11] ?? 0) ?? 0;
            $C  = $this->parsePositiveNumber($data['plieque'] ?? $data['C'] ?? $data[12] ?? 0) ?? 0;
            $D  = $this->parsePositiveNumber($data['diametro'] ?? $data['D'] ?? $data[13] ?? 0) ?? 0;

            if ($resistencia === null || $e1 === null || ($H === null && $D === null)) {
                $skippedRows[] = [
                    'row' => $rowIndex,
                    'reason' => 'Dimensiones geométricas o espesores inválidos / no numéricos',
                ];
                continue;
            }

            $explicitMasividad = $this->parsePositiveNumber($data['masividad'] ?? null);

            $masividad = ($explicitMasividad !== null && $explicitMasividad > 0)
                ? (int) ceil($explicitMasividad)
                : $this->engine->calculate($exposicion, $forma, [
                    'H'  => $H ?? 0,
                    'B1' => $B1 ?? 0,
                    'B2' => $B2 ?? 0,
                    'e1' => $e1 ?? 0,
                    'e2' => $e2 ?? 0,
                    't'  => $t ?? 0,
                    'r'  => $r,
                    'C'  => $C,
                    'D'  => $D,
                ]);

            if ($masividad <= 0) {
                $skippedRows[] = [
                    'row' => $rowIndex,
                    'reason' => 'Cálculo de masividad arrojó valor nulo o negativo por dimensiones cero',
                ];
                continue;
            }

            $validPayloads[] = [
                'project_id'    => $project->id,
                'nombre'        => $nombre,
                'descripcion'   => $data['descripcion'] ?? null,
                'exposicion'    => $exposicion,
                'perfil'        => $perfil,
                'forma'         => $forma,
                'masividad'     => $masividad,
                'resistencia'   => $resistencia,
                'altura'        => $H ?? 0,
                'base1'         => $B1 ?? 0,
                'base2'         => $B2 ?? 0,
                'espesor1'      => $e1 ?? 0,
                'espesor2'      => $e2 ?? 0,
                'espesort'      => $t ?? 0,
                'radio'         => $r,
                'plieque'       => $C,
                'diametro'      => $D,
                'observaciones' => $data['observaciones'] ?? null,
                'incluir'       => (bool) ($data['incluir'] ?? true),
                'created_at'    => $now,
                'updated_at'    => $now,
            ];
        }

        if (!empty($validPayloads)) {
            DB::transaction(function () use ($validPayloads) {
                foreach (array_chunk($validPayloads, 500) as $chunk) {
                    Profile::insert($chunk);
                }
            });

            $project->refreshIntegrityHash();
        }

        return [
            'success'        => true,
            'imported_count' => count($validPayloads),
            'skipped_count'  => count($skippedRows),
            'errors'         => $skippedRows,
        ];
    }

    private function parsePositiveNumber($value): ?float
    {
        if ($value === null || $value === '') {
            return 0.0;
        }
        if (is_string($value)) {
            $value = str_replace(',', '.', trim($value));
        }
        if (!is_numeric($value)) {
            return null;
        }
        $num = (float) $value;
        return $num >= 0 ? $num : null;
    }
}
