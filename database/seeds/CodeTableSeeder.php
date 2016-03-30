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
        $gendersType = CodeType::create([
            'codeItemName' => 'Spol',
            'codeItemDescription' => '',
        ]);
        Code::create([
            'codeType' => $gendersType->id,
            'codeName' => 'Moški',
            'codeDescription' => '',
        ]);
        Code::create([
            'codeType' => $gendersType->id,
            'codeName' => 'Ženski',
            'codeDescription' => '',
        ]);
    }
}
