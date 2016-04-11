<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Code extends Model
{
    use SoftDeletes;
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
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'name',
        'description',
        'code_type',
        'min_value',
        'max_value',
    ];

    /**
     * Get the male key type.
     *
     * @return mixed
     */
    public static function MALE()
    {
        return static::whereKey(static::$codeTypes['MALE'])->first();
    }

    /**
     * Get the female key type.
     *
     * @return mixed
     */
    public static function FEMALE()
    {
        return static::whereKey(static::$codeTypes['FEMALE'])->first();
    }

    /**
     * Get the admin key type.
     *
     * @return mixed
     */
    public static function ADMIN()
    {
        return static::whereKey(static::$codeTypes['ADMIN'])->first();
    }

    /**
     * Get the doctor key type.
     *
     * @return mixed
     */
    public static function DOCTOR()
    {
        return static::whereKey(static::$codeTypes['DOCTOR'])->first();
    }

    /**
     * Get the nurse key type.
     *
     * @return mixed
     */
    public static function NURSE()
    {
        return static::whereKey(static::$codeTypes['NURSE'])->first();
    }

    /**
     * Get the patient key type.
     *
     * @return mixed
     */
    public static function PATIENT()
    {
        return static::whereKey(static::$codeTypes['PATIENT'])->first();
    }

    /**
     * Get the personal doctor key type.
     *
     * @return mixed
     */
    public static function PERSONAL_DOCTOR()
    {
        return static::whereKey(static::$codeTypes['PERSONAL_DOCTOR'])->first();
    }

    /**
     * Get the personal dentist key type.
     *
     * @return mixed
     */
    public static function PERSONAL_DENTIST()
    {
        return static::whereKey(static::$codeTypes['PERSONAL_DENTIST'])->first();
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

    /**
     * Get all the types from measurement.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function measurementType()
    {
        return $this->hasMany(Measurement::class, 'type');
    }
}
