<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int id
 * @property string first_name
 * @property string last_name
 * @property string fullName
 * @property int post Postal code of the address
 * @property string address Users address
 * @property string email
 * @property string password
 * @property string phoneNumber
 * @property int zz_card_number
 * @property Carbon birth_date
 * @property int gender
 * @property Carbon created_at
 * @property Carbon modified_at
 * @property Carbon deleted_at
 * @property Carbon last_login
 * @property bool confirmed
 * @property string confirmation_code
 * @property User caretaker
 * @property int person_type
 * @property DoctorProfile doctorProfile If the user is a doctor, they also have a doctor profile.
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'gender',
        'email',
        'phone_number',
        'post',
        'address',
        'zz_card_number',
        'personal_doctor_id',
        'personal_dentist_id',
        'caretaker_id',
        'password',
        'last_login',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'birth_date',
        'last_login',
    ];

    /**
     * ACCESSORS
     */

    /**
     * Get the full name for the user.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        if ($this->last_name !== null) {
            return $this->first_name . ' ' . $this->last_name;
        }
        return $this->first_name;
    }

    /**
     * MUTATORS
     */

    /**
     * Set the email value.
     *
     * @param $value
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = empty($value) ? null : $value;
    }

    /**
     * HELPERS
     */

    /**
     * Check if the user has a caretaker.
     *
     * @return bool
     */
    public function hasCaretaker()
    {
        return $this->caretaker_id !== null;
    }

    /**
     * Check if the current user is the caretaker of a given user.
     *
     * @param User $user
     * @return bool
     */
    public function isCaretakerOf(User $user)
    {
        if ($user->hasCaretaker()) {
            return $this->id === $user->caretaker->id;
        }
        return false;
    }

    /**
     * Check if the user has completed their registration by creating a profile.
     *
     * @return bool
     */
    public function hasCreatedProfile()
    {
        // the doctor profile contains different data than the regular user profile.
        if ($this->isDoctor()) {
            return $this->doctorProfile->isValid();
        } else {
            return
                $this->address !== null and
                $this->birth_date !== null;
        }
    }

    /**
     * Find the relation id between two users, if it exists.
     *
     * @param User $user
     * @return null|int
     */
    public function getRelationIdWith(User $user)
    {
        $relationExists = $this->relationships()->where('user_2', $user->id)->first();
        $relationId = null;
        if ($relationExists !== null) {
            $relationId = $relationExists->pivot->relation_id;
        }
        return $relationId;
    }

    /**
     * Check if the user is a man.
     *
     * @return bool
     */
    public function isMale()
    {
        return $this->gender === Code::MALE()->id;
    }

    /**
     * Check if the user is a woman.
     *
     * @return bool
     */
    public function isFemale()
    {
        return $this->gender === Code::FEMALE()->id;
    }

    /**
     * Check if the user has ever been persisted to storage or if we are dealing with a fresh
     * instance.
     *
     * This can be useful when dealing with dependency injection, if no user is found when
     * requesting a user object with implicit resolution, a fresh User object is supplied. This can
     * be used to check if the object has been fetched from the database or if a new instance was
     * constructed.
     *
     * @return bool
     */
    public function existsInStorage()
    {
        return $this->created_at !== null;
    }

    /**
     * Check if we are dealing with two objects that represent the same user entity.
     *
     * @param User $user
     * @return bool
     */
    public function isSameUserAs(User $user)
    {
        return $this->id === $user->id;
    }

    /**
     * Check if the given user is the doctor of a given patient.
     *
     * @param User $user
     * @return bool
     */
    public function isDoctorOf(User $user)
    {
        return $this->id === $user->personal_doctor_id or $this->id === $user->personal_dentist_id;
    }

    /**
     * Check if the user is an admin user.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->person_type === Code::ADMIN()->id;
    }

    /**
     * Check if the user has more than 18years.
     *
     * @return bool
     */
    public function isAdult()
    {
        $birth=strtotime($this->birth_date);
        $past=strtotime( '-18 years' );
        if($birth<$past)
            return  true;
        else
            return false;
    }

    /**
     * Check if the user is an doctor.
     *
     * @return bool
     */
    public function isDoctor()
    {
        return $this->person_type === Code::DOCTOR()->id;
    }

    /**
     * Check if the user is an nurse.
     *
     * @return bool
     */
    public function isNurse()
    {
        return $this->person_type === Code::NURSE()->id;
    }

    /**
     * Check if the user is an patient.
     *
     * @return bool
     */
    public function isPatient()
    {
        return $this->person_type === Code::PATIENT()->id;
    }

    /**
     * Check if the user has a personal doctor.
     *
     * @return bool
     */
    public function hasDoctor()
    {
        return $this->personal_doctor_id !== null;
    }

    /**
     * Check if the user has a personal dentist.
     *
     * @return bool
     */
    public function hasDentist()
    {
        return $this->personal_dentist_id !== null;
    }

    /**
     * Check if the doctor is a personal doctor.
     *
     * @return bool
     */
    public function isPersonalDoctor()
    {
        if (!$this->isDoctor()) {
            return false;
        }
        return $this->doctorProfile->type->id === Code::PERSONAL_DOCTOR()->id;
    }

    /**
     * Check if the doctor is a personal dentist.
     *
     * @return bool
     */
    public function isPersonalDentist()
    {
        if (!$this->isDoctor()) {
            return false;
        }
        return $this->doctorProfile->type->id === Code::PERSONAL_DENTIST()->id;
    }

    /**
     * Check if the doctor is already treating the maximum amount of patients they have set in their
     * profile.
     *
     * @return bool
     */
    public function acceptingPatients()
    {
        if (!$this->isDoctor()) {
            return false;
        }
        return $this->patients->count() < $this->doctorProfile->max_patients;
    }

    /**
     * Get the users confirmation code.
     *
     * @return string
     */
    public function getConfirmationCode()
    {
        return $this->confirmation_code;
    }

    /**
     * Check if the user has confirmed their email.
     *
     * @return bool
     */
    public function hasConfirmedEmail()
    {
        return (bool)$this->confirmed;
    }

    /**
     * Mark that the user has completed their registration.
     */
    public function confirmEmail()
    {
        $this->confirmed = true;
        $this->confirmation_code = null;
    }

    /**
     * SCOPES
     */

    /**
     * Get only non admin users.
     *
     * @param $query
     * @return mixed
     */
    public function scopeNoAdmin($query)
    {
        return $query->where('person_type', '!=', Code::ADMIN()->id);
    }

    /**
     * Get only the users that have confirmed their email.
     *
     * @param $query
     * @return mixed
     */
    public function scopeNotConfirmedEmail($query)
    {
        return $query->where('confirmed', false);
    }

    /**
     * Get only the users that have created their profile.
     *
     * @param $query
     * @return mixed
     */
    public function scopeNotCreatedProfile($query)
    {
        return $query->whereNull('first_name');
    }

    /**
     * Get only the users that have created their profile.
     *
     * @param $query
     * @return mixed
     */
    public function scopeCreatedProfile($query)
    {
        return $query->whereNotNull('first_name');
    }

    /**
     * RELATIONSHIPS
     */

    /**
     * Get the person type assigned to the given user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Code::class, 'person_type');
    }

    /**
     * Get all the checks associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patientChecks()
    {
        return $this->hasMany(Checks::class, 'patient');
    }

    /**
     * Get all the checks associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctorChecks()
    {
        return $this->hasMany(Checks::class, 'doctor');
    }

    /**
     * Get all the dates associated with the patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patientDate()
    {
        return $this->hasMany(DoctorDates::class, 'patient');
    }

    /**
     * Get all the dates associated with the doctor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctorDate()
    {
        return $this->hasMany(DoctorDates::class, 'patient');
    }

    /**
     * Get all the charges associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function charges()
    {
        return $this->hasMany(User::class, 'caretaker_id');
    }

    /**
     * Get all the providers from measurement.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function measurementProvider()
    {
        return $this->hasMany(Measurement::class, 'provider');
    }
    /**
     * Get all the patients from measurement.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function measurementPatient()
    {
        return $this->hasMany(Measurement::class, 'patient');
    }

    /**
     * Get the users caretaker, if they have one.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function caretaker()
    {
        return $this->belongsTo(User::class, 'caretaker_id');
    }

    /**
     * Get all the users that this user is in a relationship with.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relationships()
    {
        return $this->belongsToMany(User::class, 'user_relationships', 'user_1', 'user_2')
            ->withPivot('relation_id')
            ->withTimestamps();
    }

    /**
     * Get the doctor profile associated with the user if the user is indeed a doctor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|null
     */
    public function doctorProfile()
    {
        return $this->isDoctor() ? $this->hasOne(DoctorProfile::class, 'user_id') : null;
    }

    /**
     * Get the patients who have this doctor listed as their personal doctor / dentist.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patients()
    {
        if ($this->isPersonalDoctor()) {
            return $this->hasMany(User::class, 'personal_doctor_id');
        } else if ($this->isPersonalDentist()) {
            return $this->hasMany(User::class, 'personal_dentist_id');
        }
    }

    /**
     * Get the users personal doctor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'personal_doctor_id');
    }

    /**
     * Get the users personal dentist.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dentist()
    {
        return $this->belongsTo(User::class, 'personal_dentist_id');
    }
}
