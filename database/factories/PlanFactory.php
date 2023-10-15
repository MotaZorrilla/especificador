<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Plan;

class PlanFactory extends Factory
{
    protected $model = Plan::class;

    public function definition()
    {
        return [
            'name'          => fake()->name(),
            'description'   => Str::random(10),
            'profile_count' => fake()->randomNumber(2),
            'price'         => fake()->randomNumber(4)
        ];
    } 
}

