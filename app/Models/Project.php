<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'tenant_id',
        'user_project_counter',
        'project',
        'description',
        'observations',
        'is_private',
        'verification_uuid',
        'integrity_hash',
    ];

    protected $casts = [
        'is_private' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if ($project->user_project_counter === null) {
                $maxCounter = static::withTrashed()
                    ->where('user_id', $project->user_id)
                    ->max('user_project_counter');
                $project->user_project_counter = ($maxCounter ?? 0) + 1;
            }
            if (empty($project->verification_uuid)) {
                $project->verification_uuid = (string) Str::uuid();
            }
            if (empty($project->tenant_id) && !empty($project->user_id)) {
                $owner = User::find($project->user_id);
                if ($owner && $owner->tenant_id) {
                    $project->tenant_id = $owner->tenant_id;
                }
            }
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    /**
     * Calcula el hash SHA-256 actual a partir del estado vivo del proyecto y sus perfiles.
     */
    public function computeIntegrityHash(): string
    {
        $this->load('profiles.results');

        $payload = [
            'project_id'   => $this->id,
            'uuid'         => $this->verification_uuid,
            'project_name' => $this->project,
            'user_id'      => $this->user_id,
            'tenant_id'    => $this->tenant_id,
            'profiles'     => $this->profiles->map(function ($profile) {
                return [
                    'nombre'      => $profile->nombre,
                    'forma'       => $profile->forma,
                    'exposicion'  => $profile->exposicion,
                    'masividad'   => (float) $profile->masividad,
                    'resistencia' => (float) $profile->resistencia,
                ];
            })->toArray(),
        ];

        return hash('sha256', json_encode($payload));
    }

    /**
     * Calcula y persiste el hash criptográfico SHA-256 de integridad del proyecto y sus perfiles.
     */
    public function refreshIntegrityHash(): string
    {
        if (empty($this->verification_uuid)) {
            $this->verification_uuid = (string) Str::uuid();
        }

        $hash = $this->computeIntegrityHash();
        $this->integrity_hash = $hash;
        $this->saveQuietly();

        return $hash;
    }
}
