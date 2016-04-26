<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CheckMedical
 *
 *
 * @package App\Models
 */
class CheckCodes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'checks_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['note', 'start', 'end', 'check', 'code'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start',
        'end',
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
    public function code()
    {
        return $this->belongsTo(Code::class, 'code');
    }


}
