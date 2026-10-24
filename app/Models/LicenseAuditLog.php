<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseAuditLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'license_id',
        'user_id',
        'event_type',
        'old_device_fingerprint',
        'new_device_fingerprint',
        'ip_address',
        'notes',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
