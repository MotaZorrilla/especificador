<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'username',
        'firstname',
        'lastname',
        'email',
        'password',
        'google_id',
        'address',
        'city',
        'country',
        'postal',
        'about',
        'phone',
        'profile_count',
        'registered_device_fingerprint',
        'max_device_transfers',
        'device_transfers_used',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'max_device_transfers' => 'integer',
        'device_transfers_used' => 'integer',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function license()
    {
        return $this->hasOne(License::class)->latestOfMany();
    }

    // Relación muchos a muchos con Plan (Legacy)
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function devices()
    {
        return $this->hasMany(UserDevice::class);
    }

    public function activeDevice()
    {
        return $this->hasOne(UserDevice::class)->where('is_active', true)->latestOfMany();
    }

    public function remainingDeviceTransfers(): int
    {
        $max = $this->max_device_transfers ?? 2;
        $used = $this->device_transfers_used ?? 0;
        return max(0, $max - $used);
    }

    /**
     * Evalúa si el usuario tiene autorización Multitenant / Anti-IDOR sobre un proyecto.
     */
    public function canAccessProject(Project $project): bool
    {
        if (method_exists($this, 'hasRole') && $this->hasRole('Admin')) {
            return true;
        }

        if ((int) $project->user_id === (int) $this->id) {
            return true;
        }

        if ($this->tenant_id !== null && (int) $project->tenant_id === (int) $this->tenant_id && !$project->is_private) {
            return true;
        }

        return false;
    }
}
