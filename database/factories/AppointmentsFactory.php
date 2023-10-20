<?php

namespace Database\Factories;

use App\Models\Medic;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $patientsIds = Patient::pluck('id')->toArray();
        $medicsIds = Medic::pluck('id')->toArray();

        return [
            'medic_id' => fake()->randomElement($medicsIds),
            'patient_id' => fake()->randomElement($patientsIds),
            'appointment_date' => fake()->dateTimeBetween('-2 weeks', '+2 months')
        ];
    }
}
