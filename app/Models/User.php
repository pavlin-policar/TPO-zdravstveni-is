<?php

namespace App\Models;

use App\Repositories\GenderRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int id
 * @property string first_name
 * @property string last_name
 * @property string fullName
 * @property int    post            Postal code of the address
 * @property string address         Users address
 * @property string email
 * @property string password
 * @property string phoneNumber
 * @property int    zz_card_number
 * @property Carbon birth_date
 * @property int    gender
 * @property Carbon created_at
 * @property Carbon modified_at
 * @property Carbon deleted_at
 * @property Carbon last_login
 * @property bool   confirmed
 * @property string confirmation_code
 * @property User   caretaker
 * @property int    person_type
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
    public $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'gender',
        'email',
        'phone_number',
        'post',
        'address',
        'zz_card_number',
        'personal_doctor',
        'personal_dentist',
        'caretaker',
        'password',
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
        'birthDate',
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
     * HELPERS
     */

    /**
     * Check if the current user is the caretaker of a given user.
     *
     * @param User $user
     * @return bool
     */
    public function isCaretakerOf(User $user)
    {
        return $this->id === $user->caretaker->id;
    }

    /**
     * Check if the user has completed their registration by creating a profile.
     *
     * @return bool
     */
    public function hasCompletedRegistration()
    {
        return
            $this->address !== null and
            $this->birth_date !== null;
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
     * Check if the user is an admin user.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->person_type === Code::ADMIN()->id;
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
     * RELATIONSHIPS
     */

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
     * Get the users caretaker, if they have one.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function caretaker()
    {
        return $this->belongsTo(User::class, 'caretaker_id');
    }
}
