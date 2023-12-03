<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Patient
 *
 * @property int $id
 * @property int $user_id
 * @property string $cpf
 * @property array $telephones
 * @property int $cep
 * @property string $address
 * @property int $number_address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'cpf',
        'telephones',
        'cep',
        'address',
        'number_address',
        'responsable_cpf',
        'responsable_name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'telephones' => 'json',
        'cep' => 'integer',
        'number_address' => 'integer',
    ];

    /**
     * Get the user associated with the patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Check if the patient is a minor based on their birthdate.
     *
     * @return bool
     */
    public function checkPatientBirthdate()
    {
        $birthdate = $this->user->birthdate; // Adjust this to match your database field name

        $birthdate = Carbon::parse($birthdate);
        $today = Carbon::now();
        $age = $birthdate->diffInYears($today);

        return $age < 12;
    }
}
