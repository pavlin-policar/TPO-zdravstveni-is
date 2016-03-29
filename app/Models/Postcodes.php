<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PostalCode
 *
 * @property int    postCode
 * @property string post
 *
 * @package App\Models
 */
class Postcodes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';
}
