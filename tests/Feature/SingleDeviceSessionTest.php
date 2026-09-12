<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Support\Str;

class SingleDeviceSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_and_registers_active_device()
    {
        $user = User::factory()->create([
            'email' => 'calculista@ingenieria.cl',
            'password' => 'password123',
        ]);

        $response = $this->post('/login', [
            'email' => 'calculista@ingenieria.cl',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);

        // Verificar que existe un registro activo en user_devices
        $this->assertDatabaseHas('user_devices', [
            'user_id' => $user->id,
            'is_active' => true,
        ]);
    }

    public function test_logging_in_from_new_device_kicks_previous_session()
    {
        $user = User::factory()->create([
            'email' => 'calculista@ingenieria.cl',
            'password' => 'password123',
        ]);

        // Simular Dispositivo A
        $deviceAToken = (string) Str::uuid();
        UserDevice::create([
            'user_id' => $user->id,
            'session_id' => 'sess_device_a',
            'device_token' => $deviceAToken,
            'device_name' => 'Windows PC / Chrome',
            'ip_address' => '190.10.20.30',
            'is_active' => true,
            'last_activity_at' => now(),
        ]);

        // Dispositivo A accede con su token de sesión
        $responseA = $this->actingAs($user)
            ->withSession(['device_token' => $deviceAToken])
            ->get('/dashboard');

        $responseA->assertOk();

        // Ahora el usuario inicia sesión desde Dispositivo B (nuevo navegador)
        $this->app['auth']->forgetGuards();

        $responseB = $this->post('/login', [
            'email' => 'calculista@ingenieria.cl',
            'password' => 'password123',
        ]);

        $responseB->assertRedirect('/dashboard');

        // El registro de Dispositivo A ahora debe estar inactivo
        $this->assertDatabaseHas('user_devices', [
            'device_token' => $deviceAToken,
            'is_active' => false,
        ]);

        // Dispositivo A intenta hacer otra petición: debe ser expulsado (kicked)
        $responseKicked = $this->actingAs($user)
            ->withSession(['device_token' => $deviceAToken])
            ->get('/dashboard');

        $responseKicked->assertRedirect('/login');
        $responseKicked->assertSessionHasErrors('device');
    }
}
