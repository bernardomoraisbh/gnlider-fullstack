<?php

namespace Database\Factories;

use Date;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date as FacadesDate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Bernardo',
            'sur_name' => 'Morais',
            'birth_date' => FacadesDate::createFromDate(1998, 01, 23),
            'email' => 'bernardomalfredo@hotmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password#123$'),
            'cpf' => '01971206601',
            'cnpj' => null,
            'cellphone' => '31995195805',
            'regional_council_number' => null,
            'state_inscription_number' => null,
            'enable_user_login' => true,
            'administrator' => true,
            'remember_token' => Str::random(10),
            'regional_council_state_id' => null
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
