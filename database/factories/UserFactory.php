<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $password;

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => $password ?: $password  = bcrypt('secret'), // password
            'remember_token' => Str::random(10),
            'verified' => $verificado = fake()->randomElement([User::USUARIO_VERIFICADO, User::USUARIO_NO_VERIFICADO]),
            'verification_token' =>  $verificado == User::USUARIO_VERIFICADO ? null : User::generarVerificationToken(),
            'admin' =>  fake()->randomElement([User::USUARIO_ADMINISTRADOR, User::USUARIO_REGULAR])
        ];
    }


}
