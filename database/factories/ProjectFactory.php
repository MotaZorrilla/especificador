<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Project;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition()
    {
    
        return [
            'user_id'             => fake()->randomDigitNotNull(),         
            'user_project_counter' =>fake()->randomDigitNotNull(),
            'project'             => fake()->name(),
            'description'         => fake()->text(),
            'observations'        => fake()->text(),
        ];
    }
}
