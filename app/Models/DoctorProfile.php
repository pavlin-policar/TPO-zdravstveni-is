<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    public $fillable = [
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
    public function getMaxPatientsAttribute()
    {
        return $this->max_patients;
    }

    /**
     * Get the user object associated with the doctor profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    /**
     * Get the doctor type associated with the doctor profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(Code::class, 'doctor_type');
    }

    /**
     * Get the institution associated with the doctor profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function institution()
    {
        return $this->hasOne(Code::class, 'institution');
    }
}