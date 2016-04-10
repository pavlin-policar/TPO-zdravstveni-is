<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Checks
 *
 *
 * @package App\Models
 */
class Checks extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'checks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['note', 'patient', 'doctor', 'doctor_date'];


    /**
     * Get the patients.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient');
    }
    /**
     * Get the doctors.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor');
    }
    /**
     * Get the doctorDates.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctorDate()
    {
        return $this->belongsTo(DoctorDates::class, 'doctor_date');
    }

    /**
     * Get all the checkMedical.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checkMedical()
    {
        return $this->hasMany(CheckMedical::class, 'check');
    }

}
