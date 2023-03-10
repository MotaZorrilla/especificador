<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
/*use App\Models\User;
use App\Models\File;
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
        DB::table('users')->insert([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@pinturaintumescente.cl',
            'password' => bcrypt('secret')
        ]);

        $this->call(UsersTableSeeder::class);
        $this->call(FiledatasTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);

    }
}