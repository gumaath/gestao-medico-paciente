<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'cpf',
        'telephones',
        'cep',
        'address',
        'number_address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'telephones' => 'json',
        'cep' => 'integer',
        'number_address' => 'integer'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function checkPatientBirthdate()
    {

        $birthdate = $this->user->birthdate; // Adjust this to match your database field name

        $birthdate = \Carbon\Carbon::parse($birthdate);
        $today = \Carbon\Carbon::now();
        $age = $birthdate->diffInYears($today);

        return $age < 12;
    }
}
