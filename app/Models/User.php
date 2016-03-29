<?php

namespace App\Models;

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
    const MALE = 1;
    const FEMALE = 2;

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
        return $this->gender === static::MALE;
    }

    /**
     * Check if the user is a woman.
     *
     * @return bool
     */
    public function isFemale()
    {
        return $this->gender === static::FEMALE;
    }
}
