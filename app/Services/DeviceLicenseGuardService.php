<?php

namespace App\Services;

use App\Models\LicenseAuditLog;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Http\Request;

class DeviceLicenseGuardService
{
    /**
     * Extrae la huella de hardware/navegador real o simulada desde la petición actual.
     */
    public function resolveDeviceFingerprint(Request $request): ?string
    {
        $fp = $request->header('X-Device-Fingerprint')
            ?? $request->input('device_fingerprint')
            ?? $request->session()->get('simulated_device_fingerprint');

        return $fp ? trim((string) $fp) : null;
    }

    /**
     * Verifica si la huella del dispositivo coincide con la registrada en la licencia del usuario,
     * o vincula el primer dispositivo automáticamente en su primer uso.
     */
    public function verifyOrBindFingerprint(User $user, ?string $fingerprint, ?string $ip = null): array
    {
        if (empty($fingerprint)) {
            return [
                'allowed' => true,
                'status' => 'SESSION_ONLY',
                'remaining_transfers' => $user->remainingDeviceTransfers(),
            ];
        }

        if (empty($user->registered_device_fingerprint)) {
            $user->registered_device_fingerprint = $fingerprint;
            $user->save();

            LicenseAuditLog::create([
                'license_id' => $user->license?->id,
                'user_id' => $user->id,
                'event_type' => 'INITIAL_ACTIVATION',
                'old_device_fingerprint' => null,
                'new_device_fingerprint' => $fingerprint,
                'ip_address' => $ip,
                'notes' => 'Vinculación inicial automática 1:1 de dispositivo autorizado.',
            ]);

            return [
                'allowed' => true,
                'status' => 'INITIAL_ACTIVATION',
                'remaining_transfers' => $user->remainingDeviceTransfers(),
            ];
        }

        if (hash_equals((string) $user->registered_device_fingerprint, $fingerprint)) {
            return [
                'allowed' => true,
                'status' => 'DEVICE_MATCHED',
                'remaining_transfers' => $user->remainingDeviceTransfers(),
            ];
        }

        LicenseAuditLog::create([
            'license_id' => $user->license?->id,
            'user_id' => $user->id,
            'event_type' => 'BLOCKED_ATTEMPT',
            'old_device_fingerprint' => $user->registered_device_fingerprint,
            'new_device_fingerprint' => $fingerprint,
            'ip_address' => $ip,
            'notes' => 'Intento de acceso desde un computador/navegador con huella distinta a la autorizada.',
        ]);

        return [
            'allowed' => false,
            'status' => 'DEVICE_MISMATCH',
            'registered_fingerprint' => $user->registered_device_fingerprint,
            'attempted_fingerprint' => $fingerprint,
            'remaining_transfers' => $user->remainingDeviceTransfers(),
            'message' => 'Equipo no autorizado. Tu licencia anual está vinculada a otro computador.',
        ];
    }

    /**
     * Ejecuta la autogestión de transferencia de equipo (máximo 2 veces al año).
     */
    public function reassignDevice(User $user, string $newFingerprint, ?string $ip = null): array
    {
        $newFingerprint = trim($newFingerprint);
        $license = $user->license;

        $remaining = $license ? $license->remainingTransfers() : $user->remainingDeviceTransfers();

        if ($remaining <= 0) {
            LicenseAuditLog::create([
                'license_id' => $license?->id,
                'user_id' => $user->id,
                'event_type' => 'REASSIGNMENT_QUOTA_EXCEEDED',
                'old_device_fingerprint' => $user->registered_device_fingerprint,
                'new_device_fingerprint' => $newFingerprint,
                'ip_address' => $ip,
                'notes' => 'Rechazo de transferencia por superar el límite anual de 2 cambios.',
            ]);

            return [
                'success' => false,
                'status' => 'QUOTA_EXCEEDED',
                'remaining_transfers' => 0,
                'message' => 'Has alcanzado el límite de 2 transferencias anuales de equipo.',
            ];
        }

        $oldFingerprint = $user->registered_device_fingerprint;
        $user->registered_device_fingerprint = $newFingerprint;
        $user->device_transfers_used = ($user->device_transfers_used ?? 0) + 1;
        $user->save();

        if ($license) {
            $license->transfers_used_count = ($license->transfers_used_count ?? 0) + 1;
            $license->save();
        }

        // Revocar todas las sesiones anteriores (Kicking)
        UserDevice::where('user_id', $user->id)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        LicenseAuditLog::create([
            'license_id' => $license?->id,
            'user_id' => $user->id,
            'event_type' => 'DEVICE_REASSIGNMENT',
            'old_device_fingerprint' => $oldFingerprint,
            'new_device_fingerprint' => $newFingerprint,
            'ip_address' => $ip,
            'notes' => 'Transferencia de puesto ejecutada por autogestión del usuario.',
        ]);

        return [
            'success' => true,
            'status' => 'REASSIGNED',
            'remaining_transfers' => $license ? $license->remainingTransfers() : $user->remainingDeviceTransfers(),
            'message' => 'Licencia transferida exitosamente al nuevo equipo.',
        ];
    }
}
