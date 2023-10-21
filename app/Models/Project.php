<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Campos que pueden ser llenados con asignación masiva
    protected $fillable = [
        'user_id',
        'user_project_counter',       
        'project', 
        'description',
        'observations',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
