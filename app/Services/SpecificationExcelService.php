<?php

namespace App\Services;

use App\Models\Filedata;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class SpecificationExcelService
{
    /**
     * Procesa la importación de una planilla de pintura intumescente de forma tolerante a fallos.
     *
     * @param UploadedFile|string $file
     * @return array Resumen de la importación (éxitos, omitidos, detalle de errores)
     */
    public function import($file): array
    {
        $importedCount = 0;
        $skippedRows = [];

        try {
            $sheets = Excel::toCollection(null, $file);
            $rows = $sheets->first();

            if (!$rows || $rows->isEmpty()) {
                return [
                    'success' => false,
                    'message' => 'El archivo Excel no contiene datos o la hoja activa está vacía.',
                    'imported_count' => 0,
                    'skipped_count' => 0,
                    'errors' => [],
                ];
            }

            foreach ($rows as $index => $row) {
                $rowNumber = $index + 1; // Fila visual 1-indexed

                // Convertir la fila a arreglo plano
                $rowArray = is_array($row) ? $row : (method_exists($row, 'toArray') ? $row->toArray() : (array) $row);

                // 1. Filtrar filas totalmente vacías
                if ($this->isEmptyRow($rowArray)) {
                    continue;
                }

                // 2. Detectar y saltar fila de cabeceras técnicas
                if ($this->isHeaderRow($rowArray)) {
                    continue;
                }

                // 3. Validar campo crítico 'pintura'
                $pintura = isset($rowArray[0]) ? trim((string) $rowArray[0]) : '';
                if ($pintura === '') {
                    $skippedRows[] = [
                        'row' => $rowNumber,
                        'reason' => 'Nombre o marca de pintura no especificado (celda vacía)',
                        'data' => $this->truncateRowForLog($rowArray),
                    ];
                    continue;
                }

                // 4. Inserción protegida contra errores por celda
                try {
                    Filedata::create([
                        'pintura'     => $pintura,
                        'modelo'      => $this->cleanValue($rowArray[1] ?? null),
                        'certificado' => $this->cleanValue($rowArray[2] ?? null),
                        'numero'      => $this->cleanValue($rowArray[3] ?? null),
                        'masividad'   => $this->cleanNumeric($rowArray[4] ?? null),
                        'm15'         => $this->cleanValue($rowArray[5] ?? null),
                        'm30'         => $this->cleanValue($rowArray[6] ?? null),
                        'm60'         => $this->cleanValue($rowArray[7] ?? null),
                        'm90'         => $this->cleanValue($rowArray[8] ?? null),
                        'm120'        => $this->cleanValue($rowArray[9] ?? null),
                        'p4c'         => $this->cleanValue($rowArray[10] ?? null),
                        'v4c'         => $this->cleanValue($rowArray[11] ?? null),
                        'v3c'         => $this->cleanValue($rowArray[12] ?? null),
                        'abierta'     => $this->cleanValue($rowArray[13] ?? null),
                        'rectangular' => $this->cleanValue($rowArray[14] ?? null),
                        'circular'    => $this->cleanValue($rowArray[15] ?? null),
                    ]);

                    $importedCount++;
                } catch (\Throwable $e) {
                    Log::warning("Excepción en fila {$rowNumber} de importación: " . $e->getMessage());
                    $skippedRows[] = [
                        'row' => $rowNumber,
                        'reason' => 'Error de formato en base de datos: ' . $e->getMessage(),
                        'data' => $this->truncateRowForLog($rowArray),
                    ];
                }
            }

            return [
                'success' => true,
                'message' => "Se importaron exitosamente {$importedCount} registros técnicos.",
                'imported_count' => $importedCount,
                'skipped_count' => count($skippedRows),
                'errors' => $skippedRows,
            ];

        } catch (\Throwable $e) {
            Log::error('Fallo crítico al procesar archivo Excel: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'No fue posible procesar el archivo Excel. Verifica que no esté dañado o con formato incompatible.',
                'imported_count' => 0,
                'skipped_count' => 0,
                'errors' => [
                    ['row' => 0, 'reason' => $e->getMessage()]
                ],
            ];
        }
    }

    protected function isEmptyRow(array $row): bool
    {
        foreach ($row as $cell) {
            if ($cell !== null && trim((string) $cell) !== '') {
                return false;
            }
        }
        return true;
    }

    protected function isHeaderRow(array $row): bool
    {
        $firstCell = mb_strtolower(trim((string) ($row[0] ?? '')));
        $secondCell = mb_strtolower(trim((string) ($row[1] ?? '')));
        $fifthCell = mb_strtolower(trim((string) ($row[4] ?? '')));

        return in_array($firstCell, ['pintura', 'marca', 'producto', 'item', 'nombre', 'recubrimiento'])
            || in_array($secondCell, ['modelo', 'tipo', 'codigo', 'código'])
            || in_array($fifthCell, ['masividad', 'm/t', 'm2/ton']);
    }

    protected function cleanValue($value): ?string
    {
        if ($value === null) {
            return null;
        }
        $str = trim((string) $value);
        return $str === '' ? null : $str;
    }

    protected function cleanNumeric($value): ?string
    {
        if ($value === null) {
            return null;
        }
        $str = trim((string) $value);
        if ($str === '') {
            return null;
        }
        // Reemplazar comas por puntos en caso de formato decimal europeo/latino
        return str_replace(',', '.', $str);
    }

    protected function truncateRowForLog(array $row): string
    {
        $sample = array_slice($row, 0, 5);
        return implode(' | ', array_map(fn($v) => (string) $v, $sample));
    }
}
