<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Medic
 *
 * @property int $id
 * @property int $user_id
 * @property string $crm
 * @property int $specialty_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property User $user
 * @property Specialty $specialty
 *
 * @package App\Models
 */
class Medic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'crm',
        'specialty_id',
    ];

    /**
     * Get the specialty associated with the medic.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function specialty()
    {
        return $this->hasOne(Specialty::class, 'id', 'specialty_id');
    }

    /**
     * Get the user associated with the medic.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
