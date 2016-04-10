<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CheckMedical
 *
 *
 * @package App\Models
 */
class CheckDiet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'check_diet';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['note', 'diet_start', 'diet_end', 'check', 'diet'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'diet_start',
        'diet_end',
    ];

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
     * Get the check.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function diet()
    {
        return $this->belongsTo(Code::class, 'diet');
    }

}
