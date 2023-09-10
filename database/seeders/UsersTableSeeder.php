<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'  => 'admin',
            'firstname' => 'Rodrigo',
            'lastname'  => 'Izaguirre',
            'email'     => 'admin@pinturaintumescente.cl',
            'password'  => 'Rodrigo'
        ])->assignRole('Admin');

        User::factory(20)->create();
    }
}
