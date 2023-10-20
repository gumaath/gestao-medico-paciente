<?php

namespace Database\Factories;

use App\Models\Medic;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
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
        $adminsIds = User::where('admin', 1)->pluck('id')->toArray();

        return [
            'medic_id' => fake()->randomElement($medicsIds),
            'patient_id' => fake()->randomElement($patientsIds),
            'appointment_date' => fake()->dateTimeBetween('-2 weeks', '+2 months'),
            'request_by' => fake()->randomElement($adminsIds),
        ];
    }
}
