<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'profiles';

    // Campos que pueden ser llenados con asignación masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'exposicion',
        'perfil',
        'forma',
        'masividad',
        'resistencia',
        'altura',
        'base1',
        'base2',
        'espesor1',
        'espesor2',
        'espesort',
        'radio',
        'plieque',
        'diametro',
        'observaciones',
        'incluir'
    ];

    // Relación con el modelo Project (muchos perfiles pertenecen a un proyecto)
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
