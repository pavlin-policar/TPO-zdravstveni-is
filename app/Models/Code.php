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
        // genders
        'MALE' => 'MALE',
        'FEMALE' => 'FEMALE',

        // user types
        'ADMIN' => 'ADMINISTRATOR',
        'DOCTOR' => 'DOCTOR',
        'NURSE' => 'NURSE',
        'PATIENT' => 'PATIENT',

        // doctor types
        'PERSONAL_DOCTOR' => 'PERSONAL_DOCTOR',
        'PERSONAL_DENTIST' => 'PERSONAL_DENTIST',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'codes';

    public static function MALE()
    {
        return static::whereKey(static::$codeTypes['MALE'])->first();
    }

    public static function FEMALE()
    {
        return static::whereKey(static::$codeTypes['FEMALE'])->first();
    }

    public static function ADMIN()
    {
        return static::whereKey(static::$codeTypes['ADMIN'])->first();
    }

    public static function DOCTOR()
    {
        return static::whereKey(static::$codeTypes['DOCTOR'])->first();
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
