<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Project::class;

    public function definition()
    {
        return [
            'nombre'       => fake()->name(),
            'perfil'     => fake()->randomNumber(1), 
            'masividad'     => fake()->randomNumber(2), 
            'resistencia'     => fake()->randomNumber(4), 
        ];
    }
}
