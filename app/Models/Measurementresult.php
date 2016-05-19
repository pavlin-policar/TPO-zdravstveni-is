<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Checks
 *
 *
 * @package App\Models
 */
class MeasurementResult extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'measurement_results';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['measurement', 'type', 'result'];


    /**
     * Get the measurements.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function measurement()
    {
        return $this->belongsTo(Measurement::class, 'measurement');
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

}
