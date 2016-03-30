<?php

namespace App\Repositories;

use App\Models\Code;
use App\Models\CodeType;

class GenderRepository
{
    /**
     * Get a list of all possible genders.
     *
     * @return mixed
     */
    public function getGenders()
    {
        return CodeType::where('codeItemName', 'Spol')->firstOrFail()->codes;
    }

    /**
     * Get the male gender Code object.
     *
     * @return Code
     */
    public function getMale()
    {
        return $this->getGenders()->filter(function (Code $code) {
            return strcasecmp($code->codeName, 'Moški') === 0;
        })->first();
    }

    /**
     * Get the femail gender Code object.
     *
     * @return Code
     */
    public function getFemale()
    {
        return $this->getGenders()->filter(function (Code $code) {
            return strcasecmp($code->codeName, 'Ženski') === 0;
        })->first();
    }
}