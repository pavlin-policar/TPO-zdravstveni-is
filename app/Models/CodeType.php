<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CodeType
 *
 * @property int    id
 * @property string key
 * @property string name
 * @property string description
 *
 * @package App\Models
 */
class CodeType extends Model
{
    /**
     * Define the keys that are used to easier locate often used codes in the database.
     *
     * @var array
     */
    public static $codeTypes = [
        'GENDER' => 'GENDER',
        'USER_TYPES' => 'USER_TYPES',
        'DOCTOR_TYPES' => 'DOCTOR_TYPES',
        'PERSON_RELATIONSHIPS' => 'PERSON_RELATIONSHIPS',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'code_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the genders key type.
     *
     * @return mixed
     */
    public static function GENDERS()
    {
        return static::whereKey(static::$codeTypes['GENDER'])->first();
    }

    /**
     * Get the user types key type.
     *
     * @return mixed
     */
    public static function USER_TYPES()
    {
        return static::whereKey(static::$codeTypes['USER_TYPES'])->first();
    }

    /**
     * Get the doctor types key type.
     *
     * @return mixed
     */
    public static function DOCTOR_TYPES()
    {
        return static::whereKey(static::$codeTypes['DOCTOR_TYPES'])->first();
    }

    /**
     * Get all the codes that belong to this codeType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function codes()
    {
        return $this->hasMany(Code::class, 'code_type');
    }
}
