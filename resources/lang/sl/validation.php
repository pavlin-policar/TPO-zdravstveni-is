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

    'accepted'             => 'Vrednost :attribute mora biti sprejet.',
    'active_url'           => 'Vrednost :attribute ni veljavna povezava.',
    'after'                => 'Vrednost :attribute mora biti za datumom :date.',
    'alpha'                => 'Vrednost :attribute lahko vsebuje samo črke.',
    'alpha_dash'           => 'Vrednost :attribute lahko vsebuje samo črke in številke.',
    'alpha_num'            => 'Vrednost :attribute lahko vsebuje samo črke in številke.',
    'array'                => 'Vrednost :attribute mora biti tabela.',
    'before'               => 'Vrednost :attribute mora biti pred datumom :date.',
    'between'              => [
        'numeric' => 'Vrednost :attribute mora biti med :min in :max.',
        'file'    => 'Vrednost :attribute mora vsebovati med :min in :max kb.',
        'string'  => 'Vrednost :attribute mora vsebovati med :min in :max znakov.',
        'array'   => 'Vrednost :attribute mora vsebovati med :min in :max elementov.',
    ],
    'boolean'              => 'Vrednost :attribute mora biti drži ali ne drži.',
    'confirmed'            => 'Vrednost :attribute se ne ujema.',
    'date'                 => 'Vrednost :attribute ni veljaven datum.',
    'date_format'          => 'Vrednost :attribute se ne ujema s formatom :format.',
    'different'            => 'Vrednost :attribute in :other se morata razlikovati.',
    'digits'               => 'Vrednost :attribute :digits mora biti število.',
    'digits_between'       => 'Vrednost :attribute mora vsebovati število med :min in :max .',
    'distinct'             => 'Vrednost :attribute vsebuje podvojeno vredmost.',
    'email'                => 'Vrednost :attribute mora biti veljaven elektronski naslov.',
    'exists'               => 'Izbran :attribute ni veljaven.',
    'filled'               => 'Polje :attribute je zahtevano.',
    'image'                => 'V :attribute se mora nahajati slika.',
    'in'                   => 'Izbrana vrednost :attribute ni veljaven.',
    'in_array'             => 'Vrednost :attribute ne obstaja v :other.',
    'integer'              => 'Vrednost :attribute mora biti celo število.',
    'ip'                   => 'Vrednost :attribute mora biti veljaven IP naslov.',
    'json'                 => 'Vrednost :attribute mora biti veljaven JSON niz.',
    'max'                  => [
        'numeric' => 'Vrednost :attribute ne sme biti višja od :max.',
        'file'    => 'Vrednost :attribute ne sme imeti več kot :max kb.',
        'string'  => 'Vrednost :attribute ne sme imeti več kot :max znakov.',
        'array'   => 'Vrednost :attribute ne sme imeti več kot :max elementov.',
    ],
    'mimes'                => 'Vrednost :attribute mora biti datoteka formata: :values.',
    'min'                  => [
        'numeric' => 'Vrednost :attribute mora biti vsaj :min.',
        'file'    => 'Vrednost :attribute mora imeti vsaj :min kb.',
        'string'  => 'Vrednost :attribute mora imeti vsaj :min znakov.',
        'array'   => 'Vrednost :attribute mora imeti vsaj :min elementov.',
    ],
    'not_in'               => 'Izbrana vrednost :attribute ni veljavna.',
    'numeric'              => 'Vrednost :attribute mora biti število.',
    'present'              => 'Vrednost :attribute mora biti izpolnjena.',
    'regex'                => 'Vsebovana vrednost atributa :attribute ni veljavna.',
    'required'             => 'Vsebovana vrednost atributa :attribute je zahtevana.',
    'required_if'          => 'Vsebovana vrednost atributa :attribute je zahtevana, ko je :other v :value.',
    'required_unless'      => 'Vsebovana vrednost atributa :attribute je zahtevana, razen če je :other is v :values.',
    'required_with'        => 'Vsebovana vrednost atributa :attribute je zahtevan, ko je :values prisotna.',
    'required_with_all'    => 'Vsebovana vrednost atributa :attribute je zahtevan, ko so :values prisotne.',
    'required_without'     => 'Vsebovana vrednost atributa :attribute je zahtevan, ko :values ni prisoten.',
    'required_without_all' => 'Vsebovana vrednost atributa :attribute je zahtevana, ko nobena od :values ni prisotna.',
    'same'                 => 'Vrednost :attribute in :other se morata ujemati.',
    'size'                 => [
        'numeric' => 'Vrednost :attribute mora biti :size.',
        'file'    => 'Vrednost :attribute mora imeti :size kb.',
        'string'  => 'Vrednost :attribute mora imeti :size znakov.',
        'array'   => 'Vrednost :attribute mora imeti :size elementov.',
    ],
    'string'               => 'Vrednost :attribute mora biti niz.',
    'timezone'             => 'Vrednost :attribute mora biti veljaven časovni pas.',
    'unique'               => 'Vrednost :attribute je že zasedena.',
    'url'                  => 'Vrednost :attribute ni v pravilnem formatu.',

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
