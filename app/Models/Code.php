<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    /**
     * Define the keys that are used to easier locate often used codes in the database.
     *
     * @var array
     */
    public static $codeTypes = [
        'MALE' => 'MALE',
        'FEMALE' => 'FEMALE',

        'ADMIN' => 'ADMINISTRATOR',
        'DOCTOR' => 'DOCTOR',
        'NURSE' => 'NURSE',
        'PATIENT' => 'PATIENT',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'codes';

    public static function MALE()
    {
        return static::whereKey(static::$codeTypes['MALE'])->first()->id;
    }

    public static function FEMALE()
    {
        return static::whereKey(static::$codeTypes['FEMALE'])->first()->id;
    }

    public static function ADMIN()
    {
        return static::whereKey(static::$codeTypes['ADMIN'])->first()->id;
    }

    public static function DOCTOR()
    {
        return static::whereKey(static::$codeTypes['DOCTOR'])->first()->id;
    }

    /**
     * Get the code type that this code belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(CodeType::class, 'code_type');
    }
}
