<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Filedata;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Filedata>
 */
class FiledataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Filedata::class;

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
            'm120'          => fake()->randomNumber(2),
            'p4c'           => fake()->boolean(),
            'v4c'           => fake()->boolean(),
            'v3c'           => fake()->boolean(),
            'abierta'       => fake()->boolean(),
            'rectangular'   => fake()->boolean(),  
            'circular'      => fake()->boolean()
        ];
            
    }
}
