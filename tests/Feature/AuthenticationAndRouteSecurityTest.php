<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Support\Str;

class AuthenticationAndRouteSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_blade_dashboard_and_are_redirected_to_login()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_guests_cannot_access_react_dashboard_and_are_redirected_to_login()
    {
        $response = $this->get('/react-dashboard');
        $response->assertRedirect('/login');
    }

    public function test_guests_cannot_access_projects_and_are_redirected_to_login()
    {
        $response = $this->get('/project');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_with_active_device_can_access_react_dashboard()
    {
        $user = User::factory()->create();
        $token = (string) Str::uuid();

        UserDevice::create([
            'user_id' => $user->id,
            'session_id' => 'session_react_test',
            'device_token' => $token,
            'device_name' => 'Chrome / Windows',
            'ip_address' => '127.0.0.1',
            'is_active' => true,
            'last_activity_at' => now(),
        ]);

        $response = $this->actingAs($user)
            ->withSession(['device_token' => $token])
            ->get('/react-dashboard');

        $response->assertOk();
    }

    public function test_authenticated_user_with_active_device_can_access_blade_dashboard()
    {
        $user = User::factory()->create();
        $token = (string) Str::uuid();

        UserDevice::create([
            'user_id' => $user->id,
            'session_id' => 'session_blade_test',
            'device_token' => $token,
            'device_name' => 'Chrome / Windows',
            'ip_address' => '127.0.0.1',
            'is_active' => true,
            'last_activity_at' => now(),
        ]);

        $response = $this->actingAs($user)
            ->withSession(['device_token' => $token])
            ->get('/dashboard');

        $response->assertOk();
    }

    public function test_session_with_mismatched_device_token_is_logged_out_by_middleware()
    {
        $user = User::factory()->create();
        $activeToken = (string) Str::uuid();
        $oldToken = (string) Str::uuid();

        // There is an active device registered with $activeToken
        UserDevice::create([
            'user_id' => $user->id,
            'session_id' => 'new_device_session',
            'device_token' => $activeToken,
            'device_name' => 'Windows PC / Chrome',
            'ip_address' => '192.168.1.50',
            'is_active' => true,
            'last_activity_at' => now(),
        ]);

        // User tries to request with an obsolete token
        $response = $this->actingAs($user)
            ->withSession(['device_token' => $oldToken])
            ->get('/react-dashboard');

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('device');
    }
}
