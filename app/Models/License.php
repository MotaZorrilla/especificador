<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'user_id',
        'license_key',
        'starts_at',
        'expires_at',
        'max_transfers_per_year',
        'transfers_used_count',
        'annual_price_clp',
        'royalty_percent',
        'status',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'max_transfers_per_year' => 'integer',
        'transfers_used_count' => 'integer',
        'annual_price_clp' => 'decimal:2',
        'royalty_percent' => 'decimal:2',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function auditLogs()
    {
        return $this->hasMany(LicenseAuditLog::class);
    }

    public function remainingTransfers(): int
    {
        return max(0, $this->max_transfers_per_year - $this->transfers_used_count);
    }

    public function calculateDeveloperRoyalty(): float
    {
        return round(((float) $this->annual_price_clp) * (((float) $this->royalty_percent) / 100), 2);
    }
}
