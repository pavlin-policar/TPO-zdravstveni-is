<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeasurementMeasurement extends Model
{
    protected $table = 'measurement_measurement';
    protected $fillable = [
        'note',
        'big_measurement',
        'small_measurement',
    ];
}
