<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'codeTypes';

    /**
     * Get all the codes that belong to this codeType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function codes()
    {
        return $this->hasMany(Code::class, 'codeType');
    }
}
