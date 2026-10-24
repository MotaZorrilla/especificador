<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantIsolationAndIdorSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_blocks_cross_tenant_idor_on_project_show_update_delete_and_pdf(): void
    {
        $tenantA = Tenant::create(['name' => 'Ingeniería A SpA', 'rut' => '76.111.111-1']);
        $tenantB = Tenant::create(['name' => 'Constructora B Ltda', 'rut' => '76.222.222-2']);

        $userA = User::factory()->create(['tenant_id' => $tenantA->id]);
        $userB = User::factory()->create(['tenant_id' => $tenantB->id]);

        $projectA = Project::create([
            'user_id'     => $userA->id,
            'tenant_id'   => $tenantA->id,
            'project'     => 'Torre Costanera Blindada',
            'description' => 'Proyecto Confidencial Tenant A',
            'is_private'  => false,
        ]);

        $profileA = Profile::create([
            'project_id'  => $projectA->id,
            'nombre'      => 'Viga V-101',
            'exposicion'  => 'Pilar 4 Caras',
            'perfil'      => 'Perfil Abierto',
            'forma'       => 'HSR',
            'masividad'   => 180,
            'resistencia' => 60,
        ]);

        // Usuario del Tenant B intenta acceder a recursos del Tenant A -> 403 Forbidden
        $this->actingAs($userB)
            ->get(route('project.show', $projectA->id))
            ->assertStatus(403);

        $this->actingAs($userB)
            ->put(route('project.update', $projectA->id), [
                'project'     => 'Intento Sabotaje',
                'description' => 'Modificación no autorizada',
            ])
            ->assertStatus(403);

        $this->actingAs($userB)
            ->delete(route('project.destroy', $projectA->id))
            ->assertStatus(403);

        $this->actingAs($userB)
            ->get(route('project.pdf', $projectA->id))
            ->assertStatus(403);

        $this->actingAs($userB)
            ->get(route('projectProfile.show', $profileA->id))
            ->assertStatus(403);
    }

    public function test_allows_same_tenant_colleagues_to_collaborate_on_shared_project_but_blocks_private_project(): void
    {
        $tenant = Tenant::create(['name' => 'Oficina Cálculo Fuego Sur', 'rut' => '77.333.444-5']);

        $engineer1 = User::factory()->create(['tenant_id' => $tenant->id]);
        $engineer2 = User::factory()->create(['tenant_id' => $tenant->id]);

        $sharedProject = Project::create([
            'user_id'     => $engineer1->id,
            'tenant_id'   => $tenant->id,
            'project'     => 'Hospital Regional Colaborativo',
            'description' => 'Proyecto compartido de la empresa',
            'is_private'  => false,
        ]);

        $privateProject = Project::create([
            'user_id'     => $engineer1->id,
            'tenant_id'   => $tenant->id,
            'project'     => 'Peritaje Privado Ingeniero 1',
            'description' => 'Solo visible para el autor',
            'is_private'  => true,
        ]);

        // Colega del mismo Tenant puede abrir proyecto compartido
        $this->assertTrue($engineer2->canAccessProject($sharedProject));

        // Colega del mismo Tenant NO puede abrir proyecto marcado como privado
        $this->assertFalse($engineer2->canAccessProject($privateProject));

        $this->actingAs($engineer2)
            ->get(route('project.show', $privateProject->id))
            ->assertStatus(403);
    }
}
