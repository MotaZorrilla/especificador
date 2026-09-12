<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Profile;
use App\Models\UserDevice;
use Illuminate\Support\Str;

class ProjectManagementTest extends TestCase
{
    use RefreshDatabase;

    private function authenticateUser(): array
    {
        $user = User::factory()->create();
        $token = (string) Str::uuid();

        // Asegurar que el usuario tenga permiso para gestionar proyectos
        $perm = \Spatie\Permission\Models\Permission::firstOrCreate(
            ['name' => 'project', 'guard_name' => 'web'],
            ['description' => 'Ver el listado de tus proyectos']
        );
        $user->givePermissionTo($perm);

        UserDevice::create([
            'user_id' => $user->id,
            'session_id' => 'sess_' . $token,
            'device_token' => $token,
            'device_name' => 'Windows PC / Chrome',
            'ip_address' => '127.0.0.1',
            'is_active' => true,
            'last_activity_at' => now(),
        ]);

        return [$user, $token];
    }

    public function test_authenticated_user_can_view_project_index(): void
    {
        [$user, $token] = $this->authenticateUser();

        Project::create([
            'user_id' => $user->id,
            'user_project_counter' => 1,
            'project' => 'Hospital Regional Talca',
            'description' => 'Estructura metálica pabellón quirúrgico',
        ]);

        $response = $this->actingAs($user)
            ->withSession(['device_token' => $token])
            ->get('/project');

        $response->assertOk();
    }

    public function test_authenticated_user_can_create_project_without_license_count_limit(): void
    {
        [$user, $token] = $this->authenticateUser();

        // En v2.0 el usuario tiene proyectos ilimitados
        $response = $this->actingAs($user)
            ->withSession(['device_token' => $token])
            ->post('/project', [
                'project' => 'Centro Logístico Pudahuel',
                'description' => 'Bodega de almacenamiento de alta combustión F90',
            ]);

        $this->assertDatabaseHas('projects', [
            'user_id' => $user->id,
            'project' => 'Centro Logístico Pudahuel',
        ]);
    }

    public function test_project_soft_delete_preserves_historical_records(): void
    {
        [$user, $token] = $this->authenticateUser();

        $project = Project::create([
            'user_id' => $user->id,
            'user_project_counter' => 1,
            'project' => 'Torre Residencial Providencia',
            'description' => 'Pilares principales',
        ]);

        $this->assertNull($project->deleted_at);

        $project->delete();

        // Verificar que sigue existiendo con soft delete
        $this->assertSoftDeleted('projects', [
            'id' => $project->id,
        ]);
    }

    public function test_project_has_many_profiles_relationship(): void
    {
        [$user, $token] = $this->authenticateUser();

        $project = Project::create([
            'user_id' => $user->id,
            'user_project_counter' => 1,
            'project' => 'Viaducto Marga Marga',
        ]);

        $p1 = Profile::create([
            'project_id' => $project->id,
            'nombre' => 'Pilar P-01',
            'exposicion' => 'Pilar 4 Caras',
            'perfil' => 'Perfil Abierto',
            'forma' => 'HSR',
            'masividad' => 120,
            'resistencia' => 90,
        ]);

        $p2 = Profile::create([
            'project_id' => $project->id,
            'nombre' => 'Viga V-01',
            'exposicion' => 'Viga 3 Caras',
            'perfil' => 'Perfil Abierto',
            'forma' => 'HSR',
            'masividad' => 180,
            'resistencia' => 60,
        ]);

        $this->assertCount(2, $project->fresh()->profiles);
        $this->assertEquals($project->id, $p1->project->id);
        $this->assertEquals($project->id, $p2->project->id);
    }
}
