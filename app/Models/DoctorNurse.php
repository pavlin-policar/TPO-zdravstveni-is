<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Postcodes
 *
 * @property int nurse
 * @property int doctor
 *
 * @package App\Models
 */
class DoctorNurse extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'doctor_nurse';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nurse', 'doctor'];

}
