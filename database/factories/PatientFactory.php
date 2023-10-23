<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
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

        $user = function ($usersIds, $patientsIds) {
                $userId = fake()->unique()->randomElement($usersIds);

                while (in_array($userId, $patientsIds)) {
                    $userId = fake()->unique()->randomElement($usersIds);
                }

                return $userId;
        };

        $user = $user($usersIds, $patientsIds);

        $userData= User::find($user);

        $userBirthdate = Carbon::parse($userData->birthdate);

        $twelveYearsAgo = Carbon::now()->subYears(12);

        if ($userBirthdate->isAfter($twelveYearsAgo)) {

            $pattern = "/\b(?:Sr\.|Dr\.|Sra\.|Srta\.|Dr\.)\s*/i";

            $responsableName = fake('pt_BR')->optional()->name();
            $responsableName = preg_replace($pattern, '', $responsableName);

            if ($responsableName) {
                $responsableCpf = fake('pt_BR')->cpf();
            }
        }

        return [
            'user_id' => $userData->id,
            'cpf' => fake('pt_BR')->cpf(),
            'telephones' => $telephones,
            'cep' => fake()->randomNumber(8),
            'address' => fake()->streetName(),
            'number_address' => fake()->buildingNumber(),
            'responsable_cpf' => @$responsableCpf ?: null,
            'responsable_name' => @$responsableName ?: null,
        ];
    }
}
