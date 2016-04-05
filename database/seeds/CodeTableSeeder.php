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

        // BLOOD PRESSURE
        $bloodPressureTypes = CodeType::create([
            'name' => 'Krvni tlak',
            'description' => '',
        ]);

        // HEART BEAT
        $sugarLevelTypes = CodeType::create([
            'name' => 'Raven sladkorja',
            'description' => 'Raven sladkorja v krvi',
        ]);
    }
}
