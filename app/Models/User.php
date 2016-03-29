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
 * @property int    post        Postal code of the address
 * @property string address     Users address
 * @property string email
 * @property string password
 * @property string phoneNumber
 * @property int    ZZCardNumber
 * @property Carbon birthDate
 * @property int    gender
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
        'address',
        'post',
        'email',
        'password',
        'phoneNumber',
        'ZZCardNumber',
        'birthDate',
        'gender',
        'personalDoctor',
        'personalDentist',
        'delegate',
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
     * Check if the user has completed their registration by creating a profile.
     *
     * @return bool
     */
    public function hasCompletedRegistration()
    {
        return $this->address !== null and
        $this->birthDate !== null;
    }
}
