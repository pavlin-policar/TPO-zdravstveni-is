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
    }
}
