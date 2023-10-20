<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SpecialtySeeder extends Seeder
{

    public $specialtyNames = [
        'Pediatria',
        'Dermatologia',
        'Cardiologia',
        'Ginecologia',
        'Oftalmologia',
        'Ortopedia',
        'Oncologia',
        'Neurologia',
        'Endocrinologia',
        'Radiologia',
        'Urologia',
        'Psiquiatria',
        'Gastroenterologia',
        'Oncologia Pediátrica',
        'Nefrologia',
        'Reumatologia',
        'Pneumologia',
        'Hematologia',
        'Geriatria',
        'Anestesiologia',
        'Otorrinolaringologia',
        'Dentística',
        'Cirurgia Geral',
        'Cirurgia Plástica',
        'Cirurgia Vascular',
        'Dietética',
        'Farmacologia',
        'Imunologia',
        'Medicina Esportiva',
        'Medicina Legal',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->specialtyNames as $specialtyName) {
            Specialty::firstOrCreate(['name' => $specialtyName]);
        }
    }
}
