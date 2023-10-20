<?php

namespace Database\Factories;

use Carbon\Carbon;
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
    public function definition(): array
    {

        $pattern = "/\b(?:Sr\.|Dr\.|Sra\.|Srta\.|Dr\.)\s*/i";
        $name = fake('pt_BR')->name();
        $name = preg_replace($pattern, '', $name);

        $responsableName = fake('pt_BR')->optional()->name();
        $responsableName = preg_replace($pattern, '', $responsableName);


        if ($responsableName) {
            $maxBirthdate = Carbon::now()->subYears(12);

            $birthDate = fake()->dateTimeBetween($maxBirthdate, 'now');
            $birthDate = $birthDate;
        } else {
            $minBirthdate = Carbon::now()->subYears(13);
            $birthDate = fake()->dateTimeBetween('-90 years', $minBirthdate);
            $birthDate = $birthDate;
        }

        return [
            'name' => $name,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'birthdate' => $birthDate,
            'responsable_name' => $responsableName ?: null,
            'responsable_cpf' => $responsableName ? fake('pt_BR')->cpf() : null,
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
