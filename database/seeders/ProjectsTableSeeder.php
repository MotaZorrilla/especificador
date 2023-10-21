<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Profile;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        Project::factory(1000)->create();
        Profile::factory(2000)->create();
    }
}
