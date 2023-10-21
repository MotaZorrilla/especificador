<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username'  => 'admin',
            'firstname' => 'Rodrigo',
            'lastname'  => 'Izaguirre',
            'email'     => 'admin@pinturaintumescente.cl',
            'password'  => 'Rodrigo',
            'profile_count' => 99
        ])->assignRole('Administrador');

        User::factory(10)->create();
    }
}
