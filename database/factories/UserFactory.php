<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'username'              => fake()->name(),
            'email'                 => fake()->unique()->safeEmail(),
            'email_verified_at'     => now(),
            'password'              => 'Rodrigo', // password
            'remember_token'        => Str::random(10),
            'firstname'             => fake()->name(),
            'lastname'              => fake()->name(),
            'address'               => fake()->address(),
            'city'                  => fake()->city(),
            'country'               => fake()->country(),
            'phone'                 => fake()->text(5),
            'about'                 => fake()->text(100),       
            'profile_count'         => fake()->randomNumber(2),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
