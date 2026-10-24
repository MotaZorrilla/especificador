<?php

namespace App\Http\Controllers;

use App\Services\DeviceLicenseGuardService;
use Illuminate\Http\Request;

class SecuritySimulatorController extends Controller
{
    public function __construct(
        protected DeviceLicenseGuardService $deviceGuard
    ) {}

    /**
     * Simula una huella de hardware distinta en la sesión actual para probar
     * en vivo el bloqueo de equipo (Device Lock) y la reasignación anual.
     */
    public function simulateFingerprint(Request $request)
    {
        $request->validate([
            'fingerprint' => ['required', 'string', 'min:6', 'max:128'],
        ]);

        $fingerprint = hash('sha256', $request->input('fingerprint'));
        $request->session()->put('simulated_device_fingerprint', $fingerprint);

        if ($request->wantsJson() || $request->expectsJson()) {
            return response()->json([
                'status'                => 'SIMULATED_FINGERPRINT_SET',
                'simulated_fingerprint' => $fingerprint,
            ]);
        }

        return redirect()->route('home')->with('info', 'Huella de dispositivo simulada activada.');
    }

    /**
     * Reasigna por autoservicio el dispositivo autorizado (máximo 2 cambios por año).
     */
    public function reassignDevice(Request $request)
    {
        $user = $request->user();
        $newFingerprint = $request->input('new_fingerprint')
            ? (strlen($request->input('new_fingerprint')) === 64
                ? $request->input('new_fingerprint')
                : hash('sha256', $request->input('new_fingerprint')))
            : ($this->deviceGuard->resolveDeviceFingerprint($request) ?? hash('sha256', 'DEFAULT-DEVICE'));

        $result = $this->deviceGuard->reassignDevice(
            $user,
            $newFingerprint,
            $request->ip()
        );

        if ($result['success']) {
            $request->session()->put('simulated_device_fingerprint', $newFingerprint);
        }

        $httpCode = $result['success'] ? 200 : 422;

        if ($request->wantsJson() || $request->expectsJson()) {
            return response()->json($result, $httpCode);
        }

        if (!$result['success']) {
            return response()->view('errors.device-locked', [
                'guardResult' => $result,
                'user'        => $user,
            ], 422);
        }

        return redirect()->route('home')->with('success', $result['message']);
    }

    /**
     * Restablece la huella simulada al dispositivo original registrado.
     */
    public function clearSimulation(Request $request)
    {
        $request->session()->forget('simulated_device_fingerprint');

        if ($request->wantsJson() || $request->expectsJson()) {
            return response()->json(['status' => 'SIMULATION_CLEARED']);
        }

        return redirect()->route('home')->with('success', 'Simulación de dispositivo restablecida.');
    }
}
