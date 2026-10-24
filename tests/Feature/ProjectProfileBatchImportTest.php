<?php

namespace Tests\Feature;

use App\Models\Filedata;
use App\Models\Project;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectProfileBatchImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_batch_imports_structural_profiles_calculates_massivity_and_isolates_invalid_rows(): void
    {
        $tenant = Tenant::create(['name' => 'Ingeniería Estructural Andina', 'rut' => '76.555.666-7']);
        $user = User::factory()->create(['tenant_id' => $tenant->id]);

        $project = Project::create([
            'user_id'     => $user->id,
            'tenant_id'   => $tenant->id,
            'project'     => 'Planta Industrial Celulosa',
            'description' => 'Carga por lotes de perfiles de acero',
        ]);

        $payload = [
            'profiles' => [
                [
                    'nombre'      => 'Viga Principal VP-01',
                    'exposicion'  => 'Viga 3 Caras',
                    'perfil'      => 'Perfil Abierto',
                    'forma'       => 'HSR',
                    'resistencia' => 60,
                    'altura'      => 300,
                    'base1'       => 150,
                    'base2'       => 150,
                    'espesor1'    => 10,
                    'espesor2'    => 10,
                    'espesort'    => 8,
                ],
                [
                    'nombre'      => 'Columna Tubular CT-02',
                    'exposicion'  => 'Pilar 4 Caras',
                    'perfil'      => 'Perfil Cerrado Circular',
                    'forma'       => 'Circular',
                    'resistencia' => 60,
                    'diametro'    => 200,
                    'espesor1'    => 6,
                ],
                [
                    // Fila malformada sin nombre -> debe aislarse sin abortar el lote válido
                    'nombre'      => '',
                    'exposicion'  => 'Pilar 4 Caras',
                ],
            ],
        ];

        $response = $this->actingAs($user)
            ->postJson(route('projectProfile.batchImport', $project->id), $payload);

        $response->assertStatus(201)
            ->assertJsonPath('summary.imported_count', 2)
            ->assertJsonPath('summary.skipped_count', 1);

        $this->assertDatabaseHas('profiles', [
            'project_id' => $project->id,
            'nombre'     => 'Viga Principal VP-01',
        ]);

        $this->assertDatabaseHas('profiles', [
            'project_id' => $project->id,
            'nombre'     => 'Columna Tubular CT-02',
        ]);
    }
}
