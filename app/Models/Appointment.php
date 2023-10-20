<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public function medic()
    {
        return $this->belongsTo(Medic::class, 'medic_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
