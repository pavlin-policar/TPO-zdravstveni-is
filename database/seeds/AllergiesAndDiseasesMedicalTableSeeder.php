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
        //TODO check if this actually works (regex is fine, but does the file get found?)
        DB::table('allergies_and_diseases_medical')->delete();
        // insert all postcodes from postcodes.sql
        DB::transaction(function () {
            //DB::unprepared(File::get('database/seeds/sql/allergies_and_diseases_medical.sql'));
            $pattern = '/\((\w+), (\w+), (\w+), (\'[^\']+\'), (\'[^\']+\'), (\d+), (\d+)\)/';
            $sql = file_get_contents('/database/seeds/sql/allergies_diseases_postgres_friendly.sql');
            $result = preg_match_all($pattern, $sql, $results);
            foreach ($results as $result) {
                DB::table('allergies_and_diseases_medical')->insert(
                //note, "sideEffects", deleted_at, created_at, updated_at, allergy_or_disease, cure
                    ['note' => $result[1],
                     'sideEffects' => $result[2],
                     'deleted_at' => $result[3],
                     'created_at' => $result[4],
                     'updated_at' => $result[5],
                     'allergy_or_disease' => $result[6],
                     'cure' => $result[7]]
                );
            }
        });
    }
}
