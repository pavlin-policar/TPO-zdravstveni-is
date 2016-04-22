<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AllergiesAndDiseasesMedicalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('allergies_and_diseases_medical')->delete();
        // insert all postcodes from postcodes.sql
        DB::transaction(function () {
            DB::unprepared(File::get('database/seeds/sql/allergies_and_diseases_medical.sql'));
        });
    }
}
