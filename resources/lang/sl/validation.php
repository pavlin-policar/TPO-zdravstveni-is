<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Vrednost mora biti sprejeta.',
    'active_url'           => 'Vrednost ni veljavna povezava.',
    'after'                => 'Vrednost mora biti za datumom :date.',
    'alpha'                => 'Vrednost lahko vsebuje samo črke.',
    'alpha_dash'           => 'Vrednost lahko vsebuje samo črke in številke.',
    'alpha_num'            => 'Vrednost lahko vsebuje samo črke in številke.',
    'array'                => 'Vrednost mora biti tabela.',
    'before'               => 'Vrednost mora biti pred datumom :date.',
    'between'              => [
        'numeric' => 'Vrednost mora biti med :min in :max.',
        'file'    => 'Vrednost mora vsebovati med :min in :max kb.',
        'string'  => 'Vrednost mora vsebovati med :min in :max znakov.',
        'array'   => 'Vrednost mora vsebovati med :min in :max elementov.',
    ],
    'boolean'              => 'Vrednost mora biti drži ali ne drži.',
    'confirmed'            => 'Vrednost se ne ujema.',
    'date'                 => 'Vrednost ni veljaven datum.',
    'date_format'          => 'Vrednost se ne ujema s formatom :format.',
    'different'            => 'Vrednost :attribute in :other se morata razlikovati.',
    'digits'               => 'Vrednost :digits mora biti število.',
    'digits_between'       => 'Vrednost mora vsebovati število med :min in :max .',
    'distinct'             => 'Vrednost vsebuje podvojeno vredmost.',
    'email'                => 'Vrednost mora biti veljaven elektronski naslov.',
    'exists'               => 'Izbran element ni veljaven.',
    'filled'               => 'Polje je zahtevano.',
    'image'                => 'Tu se mora nahajati slika.',
    'in'                   => 'Izbrana vrednost ni veljaven.',
    'in_array'             => 'Vrednost ne obstaja v :other.',
    'integer'              => 'Vrednost mora biti celo število.',
    'ip'                   => 'Vrednost mora biti veljaven IP naslov.',
    'json'                 => 'Vrednost mora biti veljaven JSON niz.',
    'max'                  => [
        'numeric' => 'Vrednost ne sme biti višja od :max.',
        'file'    => 'Vrednost ne sme imeti več kot :max kb.',
        'string'  => 'Vrednost ne sme imeti več kot :max znakov.',
        'array'   => 'Vrednost ne sme imeti več kot :max elementov.',
    ],
    'mimes'                => 'Vrednost mora biti datoteka formata: :values.',
    'min'                  => [
        'numeric' => 'Vrednost mora biti vsaj :min.',
        'file'    => 'Vrednost mora imeti vsaj :min kb.',
        'string'  => 'Vrednost mora imeti vsaj :min znakov.',
        'array'   => 'Vrednost mora imeti vsaj :min elementov.',
    ],
    'not_in'               => 'Izbrana vrednost ni veljavna.',
    'numeric'              => 'Vrednost mora biti število.',
    'present'              => 'Vrednost mora biti izpolnjena.',
    'regex'                => 'Vsebovana vrednost atributa ni veljavna.',
    'required'             => 'Vsebovana vrednost atributa je zahtevana.',
    'required_if'          => 'Vsebovana vrednost atributa je zahtevana, ko je :other v :value.',
    'required_unless'      => 'Vsebovana vrednost atributa je zahtevana, razen če je :other is v :values.',
    'required_with'        => 'Vsebovana vrednost atributa je zahtevan, ko je :values prisotna.',
    'required_with_all'    => 'Vsebovana vrednost atributa je zahtevan, ko so :values prisotne.',
    'required_without'     => 'Vsebovana vrednost atributa je zahtevan, ko :values ni prisoten.',
    'required_without_all' => 'Vsebovana vrednost atributa je zahtevana, ko nobena od :values ni prisotna.',
    'same'                 => 'Vrednost :attribute in :other se morata ujemati.',
    'size'                 => [
        'numeric' => 'Vrednost mora biti :size.',
        'file'    => 'Vrednost mora imeti :size kb.',
        'string'  => 'Vrednost mora imeti :size znakov.',
        'array'   => 'Vrednost mora imeti :size elementov.',
    ],
    'string'               => 'Vrednost mora biti niz.',
    'timezone'             => 'Vrednost mora biti veljaven časovni pas.',
    'unique'               => 'Vrednost je že zasedena.',
    'url'                  => 'Vrednost ni v pravilnem formatu.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
