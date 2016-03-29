<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

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
}
