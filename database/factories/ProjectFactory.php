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
            'pintura'       => fake()->name(),
            'modelo'        => Str::random(10),
            'certificado'   => Str::random(10),
            'numero'        => fake()->randomNumber(2),
            'masividad'     => fake()->randomNumber(2),
            'm15'           => fake()->randomNumber(1),
            'm30'           => fake()->randomNumber(2),
            'm60'           => fake()->randomNumber(3),
            'm90'           => fake()->randomNumber(4),  
        ];
    }
}
