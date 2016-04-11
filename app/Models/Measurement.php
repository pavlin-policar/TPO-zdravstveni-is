<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Checks
 *
 *
 * @package App\Models
 */
class Measurement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'measurements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['provider', 'patient', 'type', 'check', 'time'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'time',
    ];

    /**
     * Get the patients.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient');
    }
    /**
     * Get the provider.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider');
    }
    /**
     * Get the type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Code::class, 'type');
    }
    /**
     * Get the check.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function check()
    {
        return $this->belongsTo(Checks::class, 'check');
    }

    /**
     * Get all the checkMedical.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checkMedical()
    {
        return $this->hasMany(CheckMedical::class, 'check');
    }

}
