<?php

namespace Tests\Feature;

use App\Models\LicenseAuditLog;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeviceLockAndBrowserKickingSimulatorTest extends TestCase
{
    use RefreshDatabase;

    public function test_binds_first_device_fingerprint_and_blocks_second_unauthorized_device(): void
    {
        $user = User::factory()->create([
            'max_device_transfers'  => 2,
            'device_transfers_used' => 0,
        ]);

        // 1. Primer acceso desde PC Principal (Huella A) -> vincula automáticamente
        $fingerprintA = hash('sha256', 'WORKSTATION-PRINCIPAL-OFICINA');

        $this->actingAs($user)
            ->withHeader('X-Device-Fingerprint', $fingerprintA)
            ->get(route('home'));

        $user->refresh();
        $this->assertSame($fingerprintA, $user->registered_device_fingerprint);

        // 2. Acceso desde un segundo PC no autorizado (Huella B) -> 403 DEVICE_MISMATCH
        $fingerprintB = hash('sha256', 'LAPTOP-EXTERNA-PRESTADA');

        $response = $this->actingAs($user)
            ->withHeader('X-Device-Fingerprint', $fingerprintB)
            ->getJson(route('home'));

        $response->assertStatus(403)
            ->assertJsonPath('status', 'DEVICE_MISMATCH')
            ->assertJsonPath('remaining_transfers', 2);
    }

    public function test_allows_up_to_two_self_service_device_reassignments_per_year_and_blocks_third_attempt(): void
    {
        $user = User::factory()->create([
            'registered_device_fingerprint' => hash('sha256', 'PC-ORIGINAL-001'),
            'max_device_transfers'          => 2,
            'device_transfers_used'         => 0,
        ]);

        // Cambio #1 del año -> Permitido (quedan 1 de 2)
        $fp1 = hash('sha256', 'PC-NUEVO-CASA-002');
        $res1 = $this->actingAs($user)->postJson(route('security.reassign'), [
            'new_fingerprint' => $fp1,
            'device_name'     => 'PC Casa Ingeniero',
        ]);

        $res1->assertStatus(200)
            ->assertJsonPath('status', 'REASSIGNED')
            ->assertJsonPath('remaining_transfers', 1);

        // Cambio #2 del año -> Permitido (quedan 0 de 2)
        $fp2 = hash('sha256', 'LAPTOP-OBRA-003');
        $res2 = $this->actingAs($user)->postJson(route('security.reassign'), [
            'new_fingerprint' => $fp2,
            'device_name'     => 'Laptop Terreno',
        ]);

        $res2->assertStatus(200)
            ->assertJsonPath('status', 'REASSIGNED')
            ->assertJsonPath('remaining_transfers', 0);

        // Cambio #3 del año -> Bloqueado con 422 (Cuota anual de 2 cambios agotada)
        $fp3 = hash('sha256', 'TERCER-PC-COMPARTIDO-004');
        $res3 = $this->actingAs($user)->postJson(route('security.reassign'), [
            'new_fingerprint' => $fp3,
            'device_name'     => 'PC Compartido No Autorizado',
        ]);

        $res3->assertStatus(422)
            ->assertJsonPath('status', 'QUOTA_EXCEEDED')
            ->assertJsonPath('remaining_transfers', 0);

        // Verificar que la bitácora de auditoría para el 20% de regalía registró todos los eventos
        $this->assertGreaterThanOrEqual(
            3,
            LicenseAuditLog::where('user_id', $user->id)->count()
        );
    }

    public function test_kicks_previous_browser_session_when_new_device_token_is_active(): void
    {
        $fingerprint = hash('sha256', 'ESTACION-UNICA-AUTORIZADA');

        $user = User::factory()->create([
            'registered_device_fingerprint' => $fingerprint,
        ]);

        UserDevice::create([
            'user_id'            => $user->id,
            'session_id'         => 'SESION-OTRO-NAVEGADOR-999',
            'device_token'       => 'TOKEN-ACTIVO-EN-OTRO-NAVEGADOR',
            'device_fingerprint' => $fingerprint,
            'device_name'        => 'Windows PC / Chrome',
            'ip_address'         => '192.168.1.50',
            'is_active'          => true,
            'last_activity_at'   => now(),
        ]);

        // Cuando la sesión actual tiene un device_token distinto al activo en UserDevice, el middleware expulsa la sesión (Redirect a /login)
        $response = $this->actingAs($user)
            ->withSession(['device_token' => 'TOKEN-VIEJO-DESFASADO'])
            ->withHeader('X-Device-Fingerprint', $fingerprint)
            ->get(route('home'));

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('device');
    }
}
