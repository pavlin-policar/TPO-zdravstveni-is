<?php

namespace App\Models;

use App\Repositories\GenderRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int id
 * @property string firstName
 * @property string lastName
 * @property int post        Postal code of the address
 * @property string address     Users address
 * @property string email
 * @property string password
 * @property string phoneNumber
 * @property int ZZCardNumber
 * @property Carbon birthDate
 * @property int gender
 * @property Carbon created_at
 * @property Carbon modified_at
 * @property Carbon deleted_at
 * @property Carbon last_login
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
        'firstName',
        'lastName',
        'birthDate',
        'gender',
        'email',
        'phoneNumber',
        'post',
        'address',
        'ZZCardNumber',
        'personalDoctor',
        'personalDentist',
        'delegate',
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
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * MUTATORS
     */

    /**
     * HELPERS
     */

    /**
     * Check if the user has completed their registration by creating a profile.
     *
     * @return bool
     */
    public function hasCompletedRegistration()
    {
        return
            $this->address !== null and
            $this->birthDate !== null;
    }

    /**
     * Check if the user is a man.
     *
     * @return bool
     */
    public function isMale()
    {
        return $this->gender === app(GenderRepository::class)->getMale()->id;
    }

    /**
     * Check if the user is a woman.
     *
     * @return bool
     */
    public function isFemale()
    {
        return $this->gender === app(GenderRepository::class)->getFemale()->id;
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
        // TODO implement logic here
        if($this->personType==1)
            return true;
        else
            return false;
    }

    public function isDoctor()
    {
        // TODO implement logic here
        if($this->personType==2)
            return true;
        else
            return false;
    }

    public function isNurse()
    {
        // TODO implement logic here
        if($this->personType==3)
            return true;
        else
            return false;
    }

    public function isPatient()
    {
        // TODO implement logic here
        if($this->personType==5)
            return true;
        else
            return false;
    }

    /**
     * RELATIONSHIPS
     */
}
