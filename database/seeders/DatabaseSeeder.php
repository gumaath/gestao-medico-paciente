<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $admin = \App\Models\User::firstOrNew([
            'email' => 'admin@admin.com',
        ]);

        if (!$admin->exists) {
            $admin->fill([
                'name' => 'Admin',
                'admin' => true,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'birthdate' => Carbon::now()->subYears(18),
            ])->save();
        }

        $qtd_medics = rand(2, 5);
        $qtd_patients = rand(5, 30);

        $qtd_users = $qtd_medics + $qtd_patients;

        $qtd_appointments = $qtd_patients * rand(1, 3);

        \App\Models\User::factory($qtd_users)->create();

        $this->call(SpecialtySeeder::class);

        \App\Models\Medic::factory($qtd_medics)->create();

        \App\Models\Patient::factory($qtd_patients)->create();

        \App\Models\Appointment::factory($qtd_appointments)->create();

    }
}
