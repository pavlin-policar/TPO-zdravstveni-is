<?php

use App\Models\Code;
use App\Models\CodeType;
use Illuminate\Database\Seeder;

class CodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('codes')->delete();
        DB::table('code_types')->delete();
        // GENDERS
        $gendersTypes = CodeType::create([
            'key' => CodeType::$codeTypes['GENDER'],
            'name' => 'Spol',
            'description' => '',
        ]);
        $gendersTypes->codes()->create([
            'key' => Code::$codeTypes['MALE'],
            'name' => 'Moški',
            'description' => '',
        ]);
        $gendersTypes->codes()->create([
            'key' => Code::$codeTypes['FEMALE'],
            'name' => 'Ženski',
            'description' => '',
        ]);

        // USER TYPES
        $userTypes = CodeType::create([
            'key' => CodeType::$codeTypes['USER_TYPES'],
            'name' => 'Vrste uporabnikov',
            'description' => '',
        ]);
        $userTypes->codes()->create([
            'key' => Code::$codeTypes['ADMIN'],
            'name' => 'Administrator',
            'description' => 'Glavni urednik strani',
        ]);
        $userTypes->codes()->create([
            'key' => Code::$codeTypes['DOCTOR'],
            'name' => 'Zdravnik',
            'description' => 'Zdravnik ali zobozdravnik',
        ]);
        $userTypes->codes()->create([
            'key' => Code::$codeTypes['NURSE'],
            'name' => 'Medicinska sestra',
            'description' => 'Medicinska sestra',
        ]);
        $userTypes->codes()->create([
            'key' => Code::$codeTypes['PATIENT'],
            'name' => 'Pacient',
            'description' => '',
        ]);

        // DOCTOR TYPES
        $doctorTypes = CodeType::create([
            'key' => CodeType::$codeTypes['DOCTOR_TYPES'],
            'name' => 'Vrste zdravnikov',
            'description' => '',
        ]);
        $doctorTypes->codes()->create([
            'key' => Code::$codeTypes['PERSONAL_DOCTOR'],
            'name' => 'Osebni zdravnik',
            'description' => '',
        ]);
        $doctorTypes->codes()->create([
            'key' => Code::$codeTypes['PERSONAL_DENTIST'],
            'name' => 'Osebni zobozdravnik',
            'description' => '',
        ]);

        // PEOPLE RELATIONSHIPS
        $doctorTypes = CodeType::create([
            'key' => CodeType::$codeTypes['PERSON_RELATIONSHIPS'],
            'name' => 'Vrste sorodstvenih razmerij',
        ]);
        $doctorTypes->codes()->create(['name' => 'Brat / Sestra']);
        $doctorTypes->codes()->create(['name' => 'Starš']);
        $doctorTypes->codes()->create(['name' => 'Mož / Žena']);
        $doctorTypes->codes()->create(['name' => 'Otrok']);
        $doctorTypes->codes()->create(['name' => 'Drugo bljižnje sorodstvo']);
        $doctorTypes->codes()->create(['name' => 'Daljno sorodstvo']);
        $doctorTypes->codes()->create(['name' => 'Prijatelj']);
        $doctorTypes->codes()->create([
            'name' => 'Znanec',
            'description' => 'Osebi se med seboj poznata.',
        ]);;
        $doctorTypes->codes()->create([
            'name' => 'Neznanec',
            'description' => 'Osebi se med seboj ne poznata.',
        ]);

        // BLOOD PRESSURE
        $systolicBP = CodeType::create(['name' => 'Sistoličen krvni tlak']);
        $systolicBP->codes()->create([
            'name' => 'Normal',
            'max_value' => '120',
        ]);
        $systolicBP->codes()->create([
            'name' => 'Prehypertension',
            'min_value' => '120',
            'max_value' => '139',
        ]);
        $systolicBP->codes()->create([
            'name' => 'Hypertension (stage 1)',
            'min_value' => '140',
            'max_value' => '159',
        ]);
        $systolicBP->codes()->create([
            'name' => 'Hypertension (stage 2)',
            'min_value' => '160',
            'max_value' => '179',
        ]);
        $systolicBP->codes()->create([
            'name' => 'Hypertensive crisis',
            'min_value' => '180',
        ]);
        $systolicBP = CodeType::create(['name' => 'Diastoličen krvni tlak']);
        $systolicBP->codes()->create([
            'name' => 'Normal',
            'max_value' => '80',
        ]);
        $systolicBP->codes()->create([
            'name' => 'Prehypertension',
            'min_value' => '80',
            'max_value' => '89',
        ]);
        $systolicBP->codes()->create([
            'name' => 'Hypertension (stage 1)',
            'min_value' => '90',
            'max_value' => '99',
        ]);
        $systolicBP->codes()->create([
            'name' => 'Hypertension (stage 2)',
            'min_value' => '100',
            'max_value' => '109',
        ]);
        $systolicBP->codes()->create([
            'name' => 'Hypertensive crisis',
            'min_value' => '110',
        ]);

        // HEART BEAT
        $sugarLevelTypes = CodeType::create([
            'name' => 'Raven sladkorja',
            'description' => 'Raven sladkorja v krvi',
        ]);
    }
}
