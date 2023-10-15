<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    public function run()
    {
        // Inserta el Plan Básico
        Plan::create([
            'name' => 'Plan Básico',
            'description' => 'Este es el plan básico de nuestra aplicación.',
            'profile_count' => 5,
            'price' => 9.99,
        ]);

        // Inserta el Plan Premium
        Plan::create([
            'name' => 'Plan Premium',
            'description' => 'Este es el plan premium de nuestra aplicación.',
            'profile_count' => 50,
            'price' => 19.99,
        ]);

        // Utiliza la factoría para crear cinco modelos adicionales
        Plan::factory(5)->create();
    }
}

