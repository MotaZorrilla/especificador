<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
/*use App\Models\User;
/*use App\Models\File;
use App\Models\Project;*/


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FiledatasTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
    }
}