<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Postcodes
 *
 * @property int nurse_id
 * @property int institution_id
 *
 * @package App\Models
 */
class NurseInstitutions extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nurses_institutions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nurse_id', 'institution_id'];

}
