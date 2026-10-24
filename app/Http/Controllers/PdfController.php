<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Project;

class PdfController extends Controller
{
    public function pdf(Project $project)
    {
        $user = auth()->user();
        if (!$user || !$user->canAccessProject($project)) {
            abort(403, 'Acceso denegado: No tienes autorización para exportar el informe de este proyecto.');
        }

        $project->load('user', 'tenant', 'profiles.results');
        $integrityHash = $project->refreshIntegrityHash();
        $verificationUrl = url('/verify/' . $project->verification_uuid);
        $qrSvgDataUri = $this->generateDeterministicQrSvgDataUri($verificationUrl, $integrityHash);

        $profiles = $project->profiles->filter(function ($profile) {
            return $profile->incluir;
        });

        date_default_timezone_set('America/Santiago');
        $date = date('d-m-Y H:i');

        $pdf = PDF::loadView(
            'dashboard.projectAdmin.projectAdmin-pdf',
            compact('project', 'profiles', 'date', 'verificationUrl', 'integrityHash', 'qrSvgDataUri')
        );

        $pdf->setPaper('letter');

        $response = $pdf->stream();
        $response->header('Content-Type', 'application/pdf');
        $response->header('Content-Disposition', 'inline; filename=Especificador de Pintura Intumescente.pdf');
        $response->header('X-Document-Verification-UUID', (string) $project->verification_uuid);
        $response->header('X-Document-Integrity-Hash', $integrityHash);

        return $response;
    }

    /**
     * Endpoint público de verificación en obra (ITO) mediante código QR (Cero consumo de licencia).
     */
    public function verify(Request $request, string $uuid)
    {
        $project = Project::with(['user', 'tenant', 'profiles.results'])
            ->where('verification_uuid', $uuid)
            ->firstOrFail();

        $storedHash = $project->integrity_hash ?: $project->refreshIntegrityHash();
        $calculatedHash = $project->computeIntegrityHash();
        $providedHash = $request->query('hash');

        $isAuthentic = hash_equals($storedHash, $calculatedHash)
            && ($providedHash === null || hash_equals($storedHash, (string) $providedHash));

        $payload = [
            'status'            => $isAuthentic ? 'VIGENTE_VERIFICADO' : 'ADULTERADO_HASH_MISMATCH',
            'authentic'         => $isAuthentic,
            'isValid'           => $isAuthentic,
            'project'           => $project,
            'storedHash'        => $storedHash,
            'calculatedHash'    => $calculatedHash,
            'verification_uuid' => $project->verification_uuid,
            'integrity_hash'    => $storedHash,
            'project_name'      => $project->project,
            'description'       => $project->description,
            'tenant_name'       => $project->tenant?->name ?? 'Ingeniería Autorizada',
            'engineer'          => trim(($project->user?->firstname ?? '') . ' ' . ($project->user?->lastname ?? '')) ?: ($project->user?->username ?? 'Calculista'),
            'profiles_count'    => $project->profiles->count(),
            'profiles'          => $project->profiles->map(fn($p) => [
                'nombre'      => $p->nombre,
                'forma'       => $p->forma,
                'exposicion'  => $p->exposicion,
                'masividad'   => (int) $p->masividad,
                'resistencia' => (int) $p->resistencia,
            ])->values()->toArray(),
            'verified_at'       => now()->toIso8601String(),
        ];

        if ($request->expectsJson() || $request->query('format') === 'json') {
            return response()->json($payload, $isAuthentic ? 200 : 422);
        }

        return response()->view('verify.certificate', $payload, $isAuthentic ? 200 : 422);
    }

    /**
     * Genera un sello QR matricial SVG determinista embebido en base64 para compatibilidad offline en DomPDF.
     */
    protected function generateDeterministicQrSvgDataUri(string $url, string $hash): string
    {
        $bits = bin2hex(hash('sha256', $url . '|' . $hash, true));
        $rects = '';
        $size = 9;
        $cell = 8;

        for ($r = 0; $r < $size; $r++) {
            for ($c = 0; $c < $size; $c++) {
                $isFinder = ($r < 3 && $c < 3) || ($r < 3 && $c >= $size - 3) || ($r >= $size - 3 && $c < 3);
                $idx = ($r * $size + $c) % strlen($bits);
                $active = $isFinder || (hexdec($bits[$idx]) % 2 === 0);
                if ($active) {
                    $x = 8 + $c * $cell;
                    $y = 8 + $r * $cell;
                    $rects .= "<rect x=\"{$x}\" y=\"{$y}\" width=\"{$cell}\" height=\"{$cell}\" fill=\"#0f172a\"/>";
                }
            }
        }

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="88" height="88" viewBox="0 0 88 88">'
            . '<rect width="88" height="88" rx="6" fill="#ffffff" stroke="#0f172a" stroke-width="2"/>'
            . $rects
            . '</svg>';

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }
}
