<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usersIds = User::pluck('id')->toArray();
        $patientsIds = Patient::pluck('user_id')->toArray();

        $random_number = rand(1, 3);
        for ($x = 1; $x <= $random_number; $x++) {
                $telephones[$x] = fake('pt_BR')->unique()->phoneNumber();
        }
        $telephones = json_encode($telephones);

        return [
            'user_id' => function() use ($usersIds, $patientsIds) {
                $userId = fake()->unique()->randomElement($usersIds);

                while (in_array($userId, $patientsIds)) {
                    $userId = fake()->unique()->randomElement($usersIds);
                }

                return $userId;
            },
            'cpf' => fake('pt_BR')->cpf(),
            'telephones' => $telephones,
            'cep' => fake()->randomNumber(8),
            'address' => fake()->streetName(),
            'number_address' => fake()->buildingNumber()
        ];
    }
}
