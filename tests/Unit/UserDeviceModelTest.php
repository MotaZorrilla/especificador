<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserDevice;
use App\Http\Middleware\SingleDeviceSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

class UserDeviceModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_device_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $device = UserDevice::create([
            'user_id' => $user->id,
            'session_id' => 'sess_unit_1',
            'device_token' => 'token_unit_1',
            'device_name' => 'Windows PC / Google Chrome',
            'ip_address' => '10.0.0.1',
            'is_active' => true,
            'last_activity_at' => now(),
        ]);

        $this->assertInstanceOf(User::class, $device->user);
        $this->assertEquals($user->id, $device->user->id);
    }

    public function test_user_device_attributes_casting(): void
    {
        $user = User::factory()->create();
        $device = UserDevice::create([
            'user_id' => $user->id,
            'session_id' => 'sess_unit_2',
            'device_token' => 'token_unit_2',
            'device_name' => 'Mac OS / Safari',
            'ip_address' => '10.0.0.2',
            'is_active' => 1,
            'last_activity_at' => '2026-09-12 12:00:00',
        ]);

        $device->refresh();

        $this->assertIsBool($device->is_active);
        $this->assertTrue($device->is_active);
        $this->assertInstanceOf(Carbon::class, $device->last_activity_at);
    }

    public function test_device_name_detection_heuristics(): void
    {
        // Windows Chrome
        $uaWindowsChrome = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36';
        $this->assertEquals('Windows PC / Google Chrome', SingleDeviceSession::detectDeviceName($uaWindowsChrome));

        // Windows Edge
        $uaWindowsEdge = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36 Edg/122.0.0.0';
        $this->assertEquals('Windows PC / Microsoft Edge', SingleDeviceSession::detectDeviceName($uaWindowsEdge));

        // Mac Safari
        $uaMacSafari = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Safari/605.1.15';
        $this->assertEquals('Mac OS / Safari', SingleDeviceSession::detectDeviceName($uaMacSafari));

        // Linux Firefox
        $uaLinuxFirefox = 'Mozilla/5.0 (X11; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/119.0';
        $this->assertEquals('Linux PC / Firefox', SingleDeviceSession::detectDeviceName($uaLinuxFirefox));

        // Unknown / Null
        $this->assertEquals('Estación de Trabajo Desconocida', SingleDeviceSession::detectDeviceName(null));
        $this->assertEquals('Estación de Trabajo Desconocida', SingleDeviceSession::detectDeviceName(''));
    }

    public function test_can_query_active_device_for_user(): void
    {
        $user = User::factory()->create();

        // Inactive device
        UserDevice::create([
            'user_id' => $user->id,
            'session_id' => 'old_session',
            'device_token' => 'old_token',
            'device_name' => 'Old PC',
            'is_active' => false,
            'last_activity_at' => now()->subDay(),
        ]);

        // Active device
        $active = UserDevice::create([
            'user_id' => $user->id,
            'session_id' => 'current_session',
            'device_token' => 'active_token',
            'device_name' => 'Active Workstation',
            'is_active' => true,
            'last_activity_at' => now(),
        ]);

        $queried = UserDevice::where('user_id', $user->id)
            ->where('is_active', true)
            ->latest()
            ->first();

        $this->assertNotNull($queried);
        $this->assertEquals('active_token', $queried->device_token);
        $this->assertEquals('Active Workstation', $queried->device_name);
    }
}
