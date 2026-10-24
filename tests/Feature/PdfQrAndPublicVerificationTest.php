<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PdfQrAndPublicVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_generates_pdf_with_qr_headers_and_verifies_authenticity_on_public_ito_endpoint(): void
    {
        $tenant = Tenant::create(['name' => 'Consultora Fuego Chile', 'rut' => '76.888.999-0']);
        $user = User::factory()->create(['tenant_id' => $tenant->id]);

        $project = Project::create([
            'user_id'     => $user->id,
            'tenant_id'   => $tenant->id,
            'project'     => 'Centro Logístico Pudahuel',
            'description' => 'Especificación NCh3040 con sello QR',
        ]);

        Profile::create([
            'project_id'  => $project->id,
            'nombre'      => 'Pilar P-01',
            'exposicion'  => 'Pilar 4 Caras',
            'perfil'      => 'Perfil Abierto',
            'forma'       => 'HSR',
            'masividad'   => 175,
            'resistencia' => 60,
        ]);

        $project->refreshIntegrityHash();

        // 1. Exportar PDF oficial autenticado -> verifica cabeceras criptográficas UUID + SHA-256
        $pdfResponse = $this->actingAs($user)
            ->get(route('project.pdf', $project->id));

        $pdfResponse->assertStatus(200)
            ->assertHeader('X-Document-Verification-UUID', $project->verification_uuid)
            ->assertHeader('X-Document-Integrity-Hash', $project->fresh()->integrity_hash);

        // 2. Inspector ITO / DOM escanea el QR en terreno (endpoint público sin login)
        $verifyResponse = $this->getJson(route('project.verify', $project->verification_uuid));

        $verifyResponse->assertStatus(200)
            ->assertJsonPath('status', 'VIGENTE_VERIFICADO')
            ->assertJsonPath('project_name', 'Centro Logístico Pudahuel')
            ->assertJsonPath('profiles_count', 1);

        // 3. Si un tercero adultera un perfil directamente en base de datos sin recalcular firma -> detecta adulteración (422)
        \Illuminate\Support\Facades\DB::table('profiles')
            ->where('project_id', $project->id)
            ->update(['masividad' => 999]);

        $tamperedResponse = $this->getJson(route('project.verify', $project->verification_uuid));

        $tamperedResponse->assertStatus(422)
            ->assertJsonPath('status', 'ADULTERADO_HASH_MISMATCH');
    }
}
