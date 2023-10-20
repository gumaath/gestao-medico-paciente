<?php

namespace Database\Factories;

use App\Models\Medic;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medic>
 */
class MedicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $usersIds = User::pluck('id')->toArray();
        $medicsIds = Medic::pluck('user_id')->toArray();
        $specialitiesCount = Specialty::count();

        return [
            'user_id' => function() use ($usersIds, $medicsIds) {
                $userId = fake()->unique()->randomElement($usersIds);

                while (in_array($userId, $medicsIds)) {
                    $userId = fake()->unique()->randomElement($usersIds);
                }

                return $userId;
            },
            'specialty_id' => fake()->numberBetween(1, $specialitiesCount),
            'crm' => fake()->randomNumber(5),
        ];
    }
}
