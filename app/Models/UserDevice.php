<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'device_token',
        'device_fingerprint',
        'device_name',
        'ip_address',
        'user_agent',
        'is_active',
        'is_trusted_hardware',
        'last_activity_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_trusted_hardware' => 'boolean',
        'last_activity_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
