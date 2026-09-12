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
        'profile_count'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Relación muchos a muchos con Plan
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
}

