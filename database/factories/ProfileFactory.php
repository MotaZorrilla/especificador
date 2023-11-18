<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profile;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition()
    {
        return [
            'project_id'    => fake()->randomDigitNotNull(),         
            // 'project_profile_counter'=> fake()->randomDigitNotNull(),         
            'nombre'        => fake()->name(),
            'descripcion'   => fake()->text(),
            'perfil'        => fake()->text(10), 
            'forma'         => fake()->text(10), 
            'masividad'     => fake()->randomNumber(2), 
            'resistencia'   => fake()->randomNumber(3), 
            'altura'        => fake()->randomNumber(3), 
            'base1'         => fake()->randomNumber(2), 
            'base2'         => fake()->randomNumber(2), 
            'espesor1'      => fake()->randomNumber(2), 
            'espesor2'      => fake()->randomNumber(2), 
            'espesort'      => fake()->randomNumber(2), 
            'radio'         => fake()->randomNumber(2), 
            'plieque'       => fake()->randomNumber(2), 
            'diametro'      => fake()->randomNumber(2), 
            'observaciones' => fake()->text(),
            'incluir'       => fake()->boolean(),
        ];
    }
}
