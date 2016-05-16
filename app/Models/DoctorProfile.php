<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DoctorProfile
 *
 * @property string doctorNumber
 * @property int    maxPatients
 * @property Code   type
 * @property User   user
 * @property Code   institution
 *
 * @package App\Models
 */
class DoctorProfile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'doctor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctor_number',
        'max_patients',
        'doctor_type_id',
        'institution_id',
    ];

    /**
     * Max patients accessor.
     *
     * @return mixed
     */
    public function getDoctorNumberAttribute()
    {
        return $this->attributes['doctor_number'];
    }

    /**
     * Max patients accessor.
     *
     * @return mixed
     */
    public function getMaxPatientsAttribute()
    {
        return $this->attributes['max_patients'];
    }

    /**
     * Check if the doctor profile is actually valid.
     *
     * @return bool
     */
    public function isValid()
    {
        return
            $this->institution_id !== null and
            $this->max_patients !== null and
            $this->doctor_type_id !== null and
            $this->doctor_number !== null;
    }

    /**
     * Check if the doctor profile of a given nurse is actually valid.
     *
     * @return bool
     */
    public function isValidNurse()
    {
        return
            $this->institution_id !== null and
            $this->doctor_type_id !== null and
            $this->doctor_number !== null;
    }

    /**
     * Get the user object associated with the doctor profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the doctor type associated with the doctor profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->belongsTo(Code::class, 'doctor_type_id');
    }

    /**
     * Get the institution associated with the doctor profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function institution()
    {
        return $this->belongsTo(Code::class, 'institution_id');
    }
}
