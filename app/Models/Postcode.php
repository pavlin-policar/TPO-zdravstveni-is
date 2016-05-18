<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Postcodes
 *
 * @property int    postcode
 * @property string post
 *
 * @package App\Models
 */
class Postcode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['postcode', 'post'];

    /**
     * Get a human readable string to represent the post.
     *
     * @return string
     */
    public function getDisplayAttribute()
    {
        return $this->post . ' (' . $this->postcode . ')';
    }

    /**
     * Get a string representation of the object.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->postcode . ' ' . $this->post;
    }
}
