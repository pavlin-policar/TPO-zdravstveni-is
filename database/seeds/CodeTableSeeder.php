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
        ]);
        $doctorTypes->codes()->create([
            'name' => 'Neznanec',
            'description' => 'Osebi se med seboj ne poznata.',
        ]);

        // BLOOD PRESSURE
        $systolicBP = CodeType::create([
            'name' => 'Sistoličen krvni tlak',
            'description' => 'Meri se zjutraj in zvečer. Enota je millimeter živega srebra - mmHg'
        ]);
        $systolicBP->codes()->create([
            'name' => 'Hipotenzija',
            'max_value' => '99',
        ]);
        $systolicBP->codes()->create([
            'name' => 'Normalna vrednost',
            'min_value' => '100',
            'max_value' => '135',
        ]);
        $systolicBP->codes()->create([
            'name' => 'Hipotenzija (stopnje 1)',
            'min_value' => '136',
            'max_value' => '159',
        ]);
        $systolicBP->codes()->create([
            'name' => 'Hipotenzija (stopnje 2)',
            'min_value' => '160',
            'max_value' => '179',
        ]);
        $systolicBP->codes()->create([
            'name' => 'Nenormalne vrednosti',
            'min_value' => '180',
        ]);
        $diastoticBP = CodeType::create([
            'name' => 'Diastoličen krvni tlak',
            'description' => 'Meri se zjutraj in zvečer. Enota je millimeter živega srebra - mmHg'
        ]);
        $diastoticBP->codes()->create([
            'name' => 'Normalna vrednost',
			'min_value' => '60',
            'max_value' => '85',
        ]);
		$diastoticBP->codes()->create([
            'name' => 'Hipotenzija',
            'max_value' => '60',
        ]);
        $diastoticBP->codes()->create([
            'name' => 'Hipotenzija (stopnje 1)',
            'min_value' => '86',
            'max_value' => '99',
        ]);
        $diastoticBP->codes()->create([
            'name' => 'Hipotenzija (stopnje 2)',
            'min_value' => '100',
            'max_value' => '109',
        ]);
        $diastoticBP->codes()->create([
            'name' => 'Nenormalne vrednosti',
            'min_value' => '110',
        ]);

        // Sugar level
        $sugarLevelTypes = CodeType::create([
            'name' => 'Raven sladkorja',
            'description' => 'Raven glukoze v krvi. Merimo 7-krat na dan: pred in po obrokih in pred spanjem. Enota je milimol na liter - mmol/l',
        ]);
		$sugarLevelTypes->codes()->create([
            'name' => 'Normalna vrednost',
			'description' => 'Normalna vrednost',
			'min_value' => '4',
            'max_value' => '6',
        ]);
		$sugarLevelTypes->codes()->create([
            'name' => 'Hipoglikemija',
			'description' => 'Hipoglikemija so vrednosti pod 4,0. Hipoglikemija ni bolezen temveč akutno stanje',
			'min_value' => '0',
            'max_value' => '4',
        ]);
		$sugarLevelTypes->codes()->create([
            'name' => 'Sladkorna bolezen',
			'description' => 'Meritve za sladkorno bolezen so večje od 6,0, pogosto okoli 12,0',
			'min_value' => '6',
            'max_value' => '49',
        ]);
		$sugarLevelTypes->codes()->create([
            'name' => 'Neverjetne vrednosti',
            'max_value' => '0',
        ]);
		$sugarLevelTypes->codes()->create([
            'name' => 'Neverjetne vrednosti',
			'min_value' => '50',
        ]);
		// HEART BEAT
        $heartBeat = CodeType::create([
            'name' => 'Srčni utrip',
            'description' => 'Meri se skupaj z pritiskom Enota je število srčnih utripov v minuti – BPM (beats per minute)',
        ]);
		$heartBeat->codes()->create([
            'name' => 'Normalna vrednost',
			'description' => 'Normalna vrednost',
			'min_value' => '60',
            'max_value' => '100',
        ]);
		$heartBeat->codes()->create([
            'name' => 'Bradikardija',
			'min_value' => '30',
            'max_value' => '60',
        ]);
		$heartBeat->codes()->create([
            'name' => 'Tahikardija',
			'min_value' => '100',
            'max_value' => '200',
        ]);
		$heartBeat->codes()->create([
            'name' => 'Neverjetne vrednosti',
            'max_value' => '30',
        ]);
		$heartBeat->codes()->create([
            'name' => 'Neverjetne vrednosti',
			'min_value' => '200',
        ]);
		// BODY TEMPERATURE
        $bodyTemperature = CodeType::create([
            'name' => 'Telesna temperatura',
            'description' => 'Meri se 2 – 3 na dan. Enota je stopinja Celzija - °C',
        ]);
		$bodyTemperature->codes()->create([
            'name' => 'Normalna vrednost',
			'description' => 'Normalna vrednost',
			'min_value' => '35.5',
            'max_value' => '37.4',
        ]);
		$bodyTemperature->codes()->create([
            'name' => 'Hipotermija',
			'min_value' => '34',
            'max_value' => '35.5',
        ]);
		$bodyTemperature->codes()->create([
            'name' => 'Hipertermija',
			'min_value' => '37.5',
            'max_value' => '41.9',
        ]);
		$bodyTemperature->codes()->create([
            'name' => 'Neverjetne vrednosti',
            'max_value' => '34',
        ]);
		$bodyTemperature->codes()->create([
            'name' => 'Neverjetne vrednosti',
			'min_value' => '42',
        ]);
		// WEIGHT
        $weight = CodeType::create([
            'name' => 'Telesna teža',
            'description' => 'Meri se običajno enkrat na teden (pri bolnikih s srčnim popuščanjem se meri enkrat na dan). Enota je kilogram - kg. Normalne vrednosti so vrednosti indeksa telesne mase – BMI (body mass index)',
        ]);
		$weight->codes()->create([
            'name' => 'Normalna vrednost',
			'description' => 'Normalna vrednost',
			'min_value' => '20',
            'max_value' => '24',
        ]);
		$weight->codes()->create([
            'name' => 'Podhranjenost',
			'min_value' => '15',
            'max_value' => '20',
        ]);
		$weight->codes()->create([
            'name' => 'Prekomerna teža',
			'min_value' => '24',
            'max_value' => '50',
        ]);
		$weight->codes()->create([
            'name' => 'Neverjetne vrednosti',
            'max_value' => '15',
        ]);
		$weight->codes()->create([
            'name' => 'Neverjetne vrednosti',
			'min_value' => '50',
        ]);
		//Zdravstveni domovi
		$hospitals = CodeType::create([
            'key' => CodeType::$codeTypes['INSTITUTIONS'],
            'name' => 'Zdravstvene ustanove',
			'description' => 'Seznam zdravstvenih domov in bolnišnic.',
        ]);
        $hospitals->codes()->create([
            'name' => 'SB NOVA GORICA',
            'description' => 'ULICA PADLIH BORCEV 13 A',
			'min_value' => '00016', //šifra
			'max_value' => '5290', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZD BREŽICE',
            'description' => 'ČERNELČEVA CESTA 8',
			'min_value' => '00100', //šifra
			'max_value' => '8250', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZDRAVSTVENI DOM NOVA GORICA',
            'description' => 'REJČEVA ULICA 4',
			'min_value' => '00131', //šifra
			'max_value' => '5000', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZD TOLMIN',
            'description' => 'PREŠERNOVA ULICA 6 A',
			'min_value' => '00133', //šifra
			'max_value' => '5220', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZD LENDAVA - EH LENDVA',
            'description' => 'KIDRIČEVA ULICA 34',
			'min_value' => '00351', //šifra
			'max_value' => '9220', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZD METLIKA',
            'description' => 'C. BRATSTVA IN ENOTNOSTI 71',
			'min_value' => '00371', //šifra
			'max_value' => '8330', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZD LJUTOMER',
            'description' => 'C. I. SLOVENSKEGA TABORA 2',
			'min_value' => '00352', //šifra
			'max_value' => '9240', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'DOM UPOKOJENCEV ŠMARJE PRI JELŠAH',
            'description' => 'RAKEŽEVA ULICA 8',
			'min_value' => '02063', //šifra
			'max_value' => '3240', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZD RADEČE',
            'description' => 'ULICA OF 8',
			'min_value' => '02968', //šifra
			'max_value' => '1433', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZDRAVSTVENI DOM KOPER CASA DELLA SANITA CAPODISTRIA',
            'description' => 'DELLAVALLEJEVA ULICA 3',
			'min_value' => '03401', //šifra
			'max_value' => '6000', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'SB JESENICE',
            'description' => 'CESTA MARŠALA TITA 112',
			'min_value' => '04071', //šifra
			'max_value' => '4270', //pošta
        ]);
    }
}
