<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

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

     protected $model = User::class; 

    public function definition(): array
    {
        return [
            'firstName' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'mobileNumber' => $this->faker->phoneNumber,
            'department' => $this->faker->department,
            'position' => $this->faker->department,
            'customerType' => $this->faker->randomElement(['Bussiness', 'Individual']),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('Password@1com'), // Change 'password' to your desired default password
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
////////////////////////////////////  static::$password ??= Hash::make('password'),



/////////////////////////
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
