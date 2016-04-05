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
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'code_types';

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
