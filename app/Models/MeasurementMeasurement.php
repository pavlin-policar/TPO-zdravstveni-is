<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeasurementMeasurement extends Model
{
    use SoftDeletes;
    protected $table = 'measurement_measurement';
    protected $fillable = [
        'note',
        'big_measurement',
        'small_measurement',
    ];
}
