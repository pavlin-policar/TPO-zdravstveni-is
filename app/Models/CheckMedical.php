<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CheckMedical
 *
 *
 * @package App\Models
 */
class CheckMedical extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'check_medical';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['note', 'start_takeing', 'end_takeing', 'check', 'cure'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_takeing',
        'end_takeing',
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

}
