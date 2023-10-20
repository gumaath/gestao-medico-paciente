<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $qtd_medics = rand(2, 5);
        $qtd_patients = rand(5, 30);

        $qtd_users = $qtd_medics + $qtd_patients;

        $qtd_appointments = $qtd_patients * rand(1, 3);

        \App\Models\User::factory($qtd_users)->create();

        $this->call(SpecialtySeeder::class);

        \App\Models\Medic::factory($qtd_medics)->create();

        \App\Models\Patient::factory($qtd_patients)->create();

        \App\Models\Appointment::factory($qtd_appointments)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
