<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'patient_id',
        'medic_id',
        'appointment_date',
        'request_by',
    ];


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
