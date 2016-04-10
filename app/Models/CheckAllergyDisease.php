<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CheckMedical
 *
 *
 * @package App\Models
 */
class CheckAllergyDisease extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'check_allergy_and_disease';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['note', 'discovered_at', 'check', 'allergy_or_disease'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'diet_start',
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
        return $this->belongsTo(Code::class, 'allergy_or_disease');
    }

}
