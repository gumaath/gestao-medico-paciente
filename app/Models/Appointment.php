<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Appointment
 *
 * @property int $id
 * @property int $patient_id
 * @property int $medic_id
 * @property \Carbon\Carbon $appointment_date
 * @property int $request_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property Medic $medic
 * @property Patient $patient
 *
 * @package App\Models
 */
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

    /**
     * Get the medic associated with the appointment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medic()
    {
        return $this->belongsTo(Medic::class, 'medic_id');
    }

    /**
     * Get the patient associated with the appointment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
