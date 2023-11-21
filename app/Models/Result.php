<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'results';

    // Campos que pueden ser llenados con asignación masiva
    protected $fillable = [
        'profile_id', 
        'pintura',
        'modelo',
        'certificado',
        'numero',
        'minimo',
        'incluir',
    ];

    // Relación con el modelo Profile (muchos resusultados pertenecen a un perfil)
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
