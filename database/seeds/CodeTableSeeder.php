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
			'code' => '00016', //šifra
			'max_value' => '5290', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZD BREŽICE',
            'description' => 'ČERNELČEVA CESTA 8',
			'code' => '00100', //šifra
			'max_value' => '8250', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZDRAVSTVENI DOM NOVA GORICA',
            'description' => 'REJČEVA ULICA 4',
			'code' => '00131', //šifra
			'max_value' => '5000', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZD TOLMIN',
            'description' => 'PREŠERNOVA ULICA 6 A',
			'code' => '00133', //šifra
			'max_value' => '5220', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZD LENDAVA - EH LENDVA',
            'description' => 'KIDRIČEVA ULICA 34',
			'code' => '00351', //šifra
			'max_value' => '9220', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZD METLIKA',
            'description' => 'C. BRATSTVA IN ENOTNOSTI 71',
			'code' => '00371', //šifra
			'max_value' => '8330', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZD LJUTOMER',
            'description' => 'C. I. SLOVENSKEGA TABORA 2',
			'code' => '00352', //šifra
			'max_value' => '9240', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'DOM UPOKOJENCEV ŠMARJE PRI JELŠAH',
            'description' => 'RAKEŽEVA ULICA 8',
			'code' => '02063', //šifra
			'max_value' => '3240', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZD RADEČE',
            'description' => 'ULICA OF 8',
			'code' => '02968', //šifra
			'max_value' => '1433', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'ZDRAVSTVENI DOM KOPER CASA DELLA SANITA CAPODISTRIA',
            'description' => 'DELLAVALLEJEVA ULICA 3',
			'code' => '03401', //šifra
			'max_value' => '6000', //pošta
        ]);
		$hospitals->codes()->create([
            'name' => 'SB JESENICE',
            'description' => 'CESTA MARŠALA TITA 112',
			'code' => '04071', //šifra
			'max_value' => '4270', //pošta
        ]);
		
		// DIETS
        $diets = CodeType::create([
            'name' => 'Diete',
            'description' => 'Seznam diet',
        ]);
		$diets->codes()->create([
            'name' => 'Dieta pri celiakiji',
			'description' => 'Celiakija je kronična sistemska avtoimuna bolezen, ki najpogosteje prizadene tanko črevo in je posledica preobčutljivosti na gluten. Z besedo gluten imenujemo pomembne proteine zrnja pšenice, podobne proteine pa najdemo tudi v zrnju ječmena, rži, pire in tudi ovsa. Gluten lahko povzroči okvaro sluznice tankega črevesa, kar ima za posledico zmanjšano funkcijo črevesa in motnje v absorpciji hrane. Bolniki imajo zaradi tega prebavne motnje, velikokrat pa pride tudi do pomanjkanja osnovnih sestavin hrane, kot tudi do pomanjkanja mineralov in vitaminov. Pogosto so prizadeti tudi drugi organski sitemi, saj je celiakija bolezen, ki prizadene celoten organizem in se kaže s številnimi resnimi zapleti.

Z odvzemom vzorca črevesne sluznice (biopsija) lahko pri nezdravljeni celiakiji dokažemo tipične spremembe sluznice tankega črevesa. Resice tankega črevesa izginejo, sluznica postane ploska - atrofična. Z brezglutensko hrano si bolna sluznica tankega črevesa postopoma opomore. Stanje bolnika se postopoma izboljša, bolnik začne pridobivati na teži, krvna slika se normalizira in končno se tudi prizadeta sluznica ne razlikuje več od zdrave.',
			'code' => 'D001',
        ]);
		$diets->codes()->create([
            'name' => 'Dieta za ledvične bolnike',
			'description' => 'Dieta je eden temeljev zdravljenja kronične ledvične bolezni
Pri kronični ledvični bolezni je primerna prehrana eden od temeljev zdravljenja bolezni, saj lahko s primerno dieto upočasnimo napredovanje bolezni oziroma zmanjšamo kopičenje odvečnih snovi in vode, ki ostajajo v telesu, če so ledvice že prenehale delovati in se bolnik zdravi z dializo.
V različnih obdobjih razvoja kronične ledvične bolezni mora bolnik upoštevati različna prehranska priporočila, prav tako na način prehranjevanja vplivajo druge bolezni, ki jih morebiti ima bolnik. Zato poznamo različne ledvične diete. Ledvice imajo pomembno vlogo pri presnovi kalija, natrija, kalcija, vitamina D, fosforja in vode. Nepravilno delovanje ledvic spremeni presnovo teh snovi, zato je treba z dieto uravnavati, koliko teh snovi lahko bolnik v različnih fazah bolezni zaužije.',
			'code' => 'D002',
        ]);
		$diets->codes()->create([
            'name' => 'Dieta pri refluksni bolezni',
			'description' => 'Živila, ki jih odsvetujemo:

polnomastno mleko
, mlečne izdelke (z največ
2% mašč
ob
), čokoladno
mleko;

ocvrta zelenjava, zelenjavne omake in paradižnik
, kumarice
;

limone, pomaranče, grenivke, ananas;

mlečni in mastni kruh;

perutninska maščoba in koža, klobase, salame, slanina;

vse živalske in rastlinske maščobe;

čokolado, pepermint, na maščobi prip
ravljene sladice (krofi, miške...);

alkohol, kava z ali brez kofeina,
močan ruski ali zeleni čaj,
gazirane pijače;

kremne, goveje, piščančje, kisle juhe;

začimbe kot so: feferoni, čili, curry, česen čebula, rdeča paprika, poper.
Priporočamo:

posn
eto mlek
o, mlečne izdelke z največ 
2% maščobe;

vso zelenjavo pripravljeno brez maščob;

jabolka, jagodičasto sadje, melona,, banane, breskve;

vse kruhe z malo maščob, polnozrnati izdelki, testenine;

pusto meso, perutnina brez kože;

čim manj sleherne maščobe;

vse ob
like sladic, vendar z majhno vsebnostjo maščob (<3g/kos);

sokove, vodo, zeliščne čaje brez kofeina in mete;

juhe pripravljene brez prežganja, brez dodatkov maščob, najbolje zelenjavne;

vse ostale začimbe, ki niso odsvetovane, sol v zmernih količinah.
Pri
dieti upoštevamo tudi samo pripravo hrane
:

ta naj bo sveže kuhana v malo tekočine ali dušena v lastnem soku, ali pečena 
brez maščob;

hrano zabelimo, ko je že kuhana, vendar s čim manj hladne maščobe, oljem, 
maslom ali smetano;

hrana naj bo mehka, lahka i
n ne sme povzročati zaprtja;

ne sme biti ne prevroča, niti ledeno mrzla;

izogibamo se jedem in pijačam, ki napenjajo.
Posebno pazljivost moramo nameniti samim obrokom hrane
:

obroki hrane naj bodo pogostejši, a manj obilni;

izogibati se je potrebno 
prigr
izkom;

med jedjo se ne sme uživajti
večjih količin tekočine;

jesti je potrebno počasi in dobro prežvečiti
;

večerjati 
vsa
j
2
-
3 ure pred span
jem, pri hujših težavah opustiti
večerjo;

takoj po obroku ni prime
rno počivati leže, raje ostanemo
pokonci.
Poleg  u
poštevanja diete, svetujemo še nekaj dodatnih napotkov, ki vam bodo 
olajšali življenje pri GERB
-
u
: 

takoj po obroku ni primerno počivati leže, raje ostanemo pokonci.

vzdržujte primerno telesno težo; 

opustite kajenje; 

izogibajte  se  nošenju  tesnih  oblačil
v   pasu,   sklanjanju   i   globokemu 
pripogibanju;                                        

počivajte in spite z vzdignjenim zgornjim delom telesa. ',
			'code' => 'D003',
        ]);
		$diets->codes()->create([
            'name' => 'Dieta za sladkorne bolnike',
			'description' => 'Enako kot vse bolezni sodobne družbe je tudi sladkorno bolezen mogoče preprečiti (ali odložiti njen nastanek) z zdravim načinom življenja – z rednim gibanjem, zdravo prehrano in vzdrževanjem normalne telesne teže. Za zdravo življenje se je treba odločiti čim bolj zgodaj, v tem duhu je treba vzgajati že otroke.',
			'code' => 'D004',
        ]);
		$diets->codes()->create([
            'name' => 'Dieta za znižanje holesterola',
			'description' => 'Hrana je nujno potrebna za življenje. Za normalno delovanje naše telo potrebuje ustrezno kombinacijo raznolikih hranil: beljakovin, ogljikovih hidratov in maščob, vitaminov in mineralov. Uravnotežena prehrana je pomembna osnova za zdravje, dobro počutje ter telesno in duševno zmogljivost.
Nepravilno prehranjevanje in nezdrav način življenja pripomoreta k nastanku bolezni srca in ožilja, motenj v presnovi maščob, sladkorni bolezni in zvišanemu krvnemu tlaku.

Sodobne prehranske navade večinoma ne ustrezajo priporočilom za zdravo prehrano, saj je naša hrana energetsko (kalorično) preveč bogata, vsebuje preveč maščob (predvsem nasičenih maščob), preveč sladkorja, preveč soli in preveč alkohola ter premalo prehranskih vlaknin.',
			'code' => 'D005',
        ]);
		$diets->codes()->create([
            'name' => 'Prehrana pri driski',
			'description' => 'Driska (diareja) je prebavna motnja, za katero je značilno tekoče blato, povečana pogostost odvajanja in zvečana količina blata v primerjavi s siceršnjim vzorcem pri določeni osebi. Driska navadno ni nevarna in jo lahko obvladamo sami. Lahko je akutna (nekaj ur do nekaj dni) ali kronična (več kot štiri tedne oziroma se ponavlja).

Čeprav lahko drisko s pravilnim samozdravljenjem največkrat pozdravimo sami, ni vedno tako. Včasih moramo obiskati zdravnika, ki poišče vzrok driske in jo primerno zdravi. Zdravnika je treba obiskati, če driska kljub samozdravljenju ne izgine v tednu dni oziroma se po dveh dneh stanje še poslabša, če zaradi driske nastopi zmerna ali huda dehidracija organizma, če dolgotrajno bruhate, če drisko spremlja visoka telesna temperatura, če je driska krvava, jo spremljajo hude bolečine v trebuhu ter če se pojavi akutna driska pri nosečnicah in majhnih otrocih. Pozorni morajo biti tudi bolniki s kroničnimi spremljajočimi boleznimi, na primer sladkorni in srčni bolniki ter bolniki z zmanjšano obrambno odpornostjo organizma. Pozorni moramo biti tudi, če se med jemanjem antibiotikov ali po njem pojavi huda driska.',
			'code' => 'D006',
        ]);
		$diets->codes()->create([
            'name' => 'Dieta za znižanje trigliceridov',
			'description' => ' Povečana raven trigliceridov v krvi je znana kot neodvisni dejavnik tveganja za razvoj kroničnih srčno-žilnih bolezni, ki so vodilni vzrok smrti v razvitem svetu. Koronarna srčna bolezen je najbolj pogosta oblika srčno-žilnih bolezni, ki nastane zaradi ateroskleroze koronarnih arterij, ki dovajajo kri srčni mišici.

Pri razviti aterosklerozi lahko pride do motenj pri pretoku krvi in posledično infarkta. Huda hipertrigliciredimija lahko povzroči tudi druge zdravstvene zaplete kot so zamaščenost jeter in akutni pankreatitis. Dejavniki, ki povečajo raven trigliceridov so prehrana (vegetarijanska, z zelo nizko vsebnostjo maščob ali bogata z rafiniranimi ogljikovimi hidrati), estrogeni, alkohol, kajenje, telesna neaktivnost, debelost, nezdravljen diabetes, hipotioridizem, kronična ledvična bolezen in jeterne bolezni.
Povečana raven trigliceridov v krvi je zelo pogosta tudi pri metabolnem sindromu (pred diabetes), kot dejavnik tveganja pa naj bi bila še posebej pomembna pri znižanih vrednostih HDL holesterola in sladkornih bolnikih. Raven trigliceridov se v krvi poveča tudi v akutnih vnetnih stanjih.

Kaj so trigliceridi in kakšna je njihova vloga v organizmu
Maščoba je sestavni del človekove prehrane. Poleg tega, da izboljša okusnost hrane, je velik nosilec energije in topilec vitaminov A, D, E in K. Potrebna je tudi za številne presnovne in fiziološke procese v organizmu in vzdrževanje strukturne in funkcionalna celote celičnih membran. Ker človeško telo ne more samo izdelati vseh potrebnih maščobnih kislin, jih je nujno potrebno zaužiti s hrano. Nahajajo se v hrani rastlinskega in živalskega izvora.
Maščobe so tudi edina oblika energije, ki jo telo lahko shranjuje na daljši časovni rok. Te maščobne zaloge se nalagajo v maščobnem tkivu, ki pomaga tudi pri ohranjanju telesne temperature in fizični zaščiti notranjih organov.
Okrog 95 % vseh prehranskih maščob se nahaja v obliki trigliceridov. Glede na vrsto maščobnih kislin, ki jih trigliceridi vsebujejo, govorimo o nasičenih, enkrat nenasičenih in večkrat nenasičenih maščobah.

Krvni trigliceridi
Maščobe (trigliceridi, fosfolipidi, holesterol) se po krvi prenašajo vezane na posebne beljakovine. Komplekse beljakovin in maščob imenujemo lipoproteini. Razlikujemo jih po sestavi, velikosti in gostoti. Lipoproteini, ki v večjih količinah prenašajo trigliceride so hilomikroni, lipoproteini zelo nizke gostote (VLDL) in lipoproteini vmesne gostote (IDL).
Klinično se merjenje trigliceridov v krvi nanaša na skupne vrednosti VLDL, IDL in presnovnih ostankov trigliceridov. Hilomikroni prenašajo s hrano zaužite maščobe v telesna tkiva in jetra, zato narastejo predvsem po jedi z mastno hrano. Naloga VLDL je nasprotno od hilomikronov prenos maščob iz jeter v ostala telesna tkiva, medtem, ko iz IDL nastaja LDL holesterol.
Nizke vrednosti VLDL imajo običajno vitki posamezniki in posamezniki, ki so redno telesno aktivni. Debelost in uživanje prekomernih količin alkohola je na drugi strani povezano z višjimi vrednostmi VLDL. Veliki VLDL delci, katerih nivo je povečan pri vegetarijanski prehrani in prehrani z malo maščob, naj ne bi predstavljali tveganja za razvoj ateroskleroze. Nasprotno pa tveganje za aterosklerozo predstavljajo majhni delci VLDL, ki jih npr. opažamo pri metabolnem sindromu.

Prehrana pri povišanih trigliceridih v krvi
Obravnava pri povišanih trigliceridih zahteva zmanjšanje teže pri prekomerno težkih in debelih posameznikih, povečanje telesne aktivnosti, prenehanje kajenja in zdravljenje sladkorne bolezni, če je ta prisotna. V osnovi se priporoča prehrana z majhno vsebnostjo nasičenih maščob in holesterola, zmanjšanje uživanja rafiniranih ogljikovih hidratov in odsvetuje uživanje alkohola. K znižanju krvnega nivoja trigliceridov pripomore tudi uživanje omega-3 maščobnih kislin iz ribjega olja, saj zavirajo nastajanje VLDL.

Prehrana pri povišanih trigliceridih pri idealni ali normalni telesni teži temelji na energijsko in hranilno uravnoteženi prehrani in na pravilnem režimu prehranjevanja:
• energijski vnos je v ravnovesju s porabljeno energijo
• zagotoviti je potrebno 4-5 rednih obrokov na 2,5 – 3 ure
• vrednosti celokupnega prehranskega holesterola naj dnevno ne presegajo 200mg
• delež vseh maščob naj predstavlja 20-25 % dnevnega energijskega vnosa (naj bo tretjino nižji od priporočil)
• delež nasičenih maščob naj ne bi presegal 5 % dnevnega energijskega vnosa
• delež beljakovin naj predstavlja 15 % dnevnega energijskega vnosa
• delež ogljikovih hidratov naj predstavlja 55 in ne več kot 60 % dnevnega energijskega vnosa
• priporočen vnos omega-3 maščobnih kislin znaša 1-3 g/dan
• priporočen vnos prehranske vlaknine znaša od 25 – 30 g/dan, od tega 7-13 g/dan topne prehranske vlaknine
• priporočen vnos rastlinskih sterolov znaša 2-3 g/dan
• v prehrano vključimo polnovredna žita in žitne izdelke, sadje in zelenjavo ter stročnice
• 3 do 4-krat tedensko uživamo predvsem mastne morske ribe (losos, slanik, sardele, sardine, skuša, tuna) (vsaj 2-krat na teden)2
• ker se priporoča prehrana z manjšo vsebnostjo maščob, je potrebna zmerna uporaba vseh živil bogatih z maščobo. Iz prehrane popolnoma izločimo svinjsko mast, ocvirke, slanino, mastno meso, maslo, smetana, mastne sire, kokosovo maščobo, majonezo.
• pri izbiri maščob dajemo prednost enkrat in večkrat nenasičenim maščobam: oljčno, laneno in repično olje, mastne ribe, oreški in semena, avokado
• omejimo uporabo rafiniranih in s sladkorjem bogatih živil: bel kruh, bel riž, izdelki iz bele moke, piškoti, peciva, sladke pijače in sokovi

Indeks Aterogenosti in razmerje P/S
Dejstvo, da maščobne kisline vplivajo na koncentracijo maščob v krvi, je znano že dolgo. Razmerje P/S je v preteklosti služilo za oceno primernosti maščob in predstavlja razmerje med večkrat nenasičenimi maščobnimi kislinami (VNMK) in nasičenimi maščobnimi kislinami (NMK). Kadar je razmerje P/S posamezne maščobe nižje 0,5 je ta maščoba bolj primerna za prehrano ljudi, saj se pri takšnih maščobah zmanjša tveganje za  kardiovaskularna obolenja. Pomembno je, koliko maščob in katere maščobne kisline posamezno meso vnaša v obrok in s tem vpliva na razmerje maščobnih kislin v obroku. S pustim mesom v obrok vnesemo sorazmerno malo maščob, zato je tudi vpliv na razmerje maščobnih kislin majhen.',
			'code' => 'D007',
        ]);
		$diets->codes()->create([
            'name' => 'Dieta pri boleznih jeter',
			'description' => 'Sposobnost prebavljanja in apetit je pri teh bolnikih zelo različen, zato n
aj bodo te 
diete zelo individualno prilagojene. Če bolnik začuti težave 
po zaužitju določenega 
živila (
spahovanje, napet trebuh, vetrovi...), naj ga izpusti iz jedilnika in nadomesti z 
drugim, po katerem nima težav. Hrana teh bolnikov je pogosto neokusna zar
adi 
omejitve soli, tekočine in beljakovin.
Pri jetrni cirozi z 
ascitesom
, je dietno zdravljenje pomembno. Pri ascitesu, kot 
najpogostejšem zapletu jetrne ciroze, se poveča absorpcija vode in natrija in
s tem 
celote
n volumen tekočin.
Takemu bolniku določim
o dieto z omejenim vnosom soli na 
2g
/
dan
, ter približno 1500ml tekočine na dan.
Naslednji pogosti zaplet pri jetrni cirozi je nastanek portosistemske encefalopatije 
(PSE )
, 
ki je posledica hiperamoniemije (povišan amonijak v sistemski cirkulaciji ), ki 
zastruplja
možgane
. 
Jetrne encefalopatije  pa ne povzroča le en strup, temveč še 
številni drugi, znani in manj znani, ki nastajajo v črevesju in se razgrajajo v jetrih. 
Zdravilo laktuloza v dozi 10
-
30ml 3
-
krat dnevno ( Portalak ), ki deluje odvajalno, 
zniž
uje nastanek in absorpcijo amonijaka. Pri zdravljenju PSE pa je pomembna 
predvsem dieta z omejenimi
živalskimi
beljakovinami v hrani. Pri akutnem 
poslabšanju PSA je vnos 
beljakovin 20
-
30g/dan, nato količino beljakovin 
postopno dvigamo na 40
-
60 g/dan
. Zažel
eno je, da bolnik dobi dnevno vsaj 1g 
beljakovin/kg telesne teže. Beljakovine v hrani naj bodo enakomerno razporejene v 
vse obrokih in naj bodo predvsem rastlinskega izvora, ker delujejo odvajalno, znižuje 
pH črevesne vsebine in sprošča manj amonijaka.
Priporočene jedi pri trajno varovalni dieti jetrnih bolezni,  pri tem upoštevamo 
vnos beljakovin, tekočin in soli:

vsi čaji s sladkorjem ali medom, razen močnega ruskega čaja;

vse mineralne vode, naravni sadni sokovi;

vsi mlečni izdelki (kislo mleko, jogu
rt,  kefir,  maslo,  skuta),  zlasti  mleko  kot 
samostojna pijača ali z dodatkom žitn
e  kave,  kave  brez  kofeina, 
čokoladno 
mleko;

jajčne jedi;

vse vrste
juh (kostne, mesne, zelenjavne
) s posneto maščobo, brez prežganja;

vse vrste nemastnega mesa (
kuhano, dušeno 
in pečeno z minimalno količino 
maščobe),  nemastne ribe, perutnina, drobovina v manjši količini, hrenovke, 
posebna in pariška salama;

vse vrste žitnih izdelkov, krompir, polento, kaše;

določene  vrste  zelenjave  (lahke):korenje,  cvetača,  špinača,  rdeča  pesa,
blitva...Kuhane    solate,  mehke  surove  solate:  motovilec,  mehka  glavnata 
solata...

vse vrste svežega sadja v 
manjši količini, kuhano sadje (kompoti, čežane
), 
marmelade;

sladice: pudingi, narastki, ne premastno pecivo, kvašeno pecivo en do dva dni 
staro, brez težkih nadevov;

kruh en dan star bel ali črn, prepečenec;

zabele
-
lahko  maslo,
olje  predvsem  olivno,  vitaminizirane  margarine
-
vse  ne
razbeljeno in v minimalni ko
ličini;  

začimbe domače, naravne.
Prepovedane jedi in živila:

alkoholne pijače, močan ruski čaj, kava s kofeinom, gazirane in zelo mrzle ali 
prevroče pijače;  

pikantni masni siri, majoneza, polnomastno mleko in mlečni izdelki, kisla in 
sladka smetana,
sladoled;    

vse mastne, pikantne juhe in juhe z dodatkom prežganja;

vse  mastne  jedi,  meso  z  vidno  maščobo,  ocvrte  jedi,  prekajeno  meso, 
divjačino, meso in ribe  iz pločevink, klobase, paštete..;  

težje škrobne jedi ( žganci, štruklji vseh vrst, sveži k
ruh,  potice,  krompirjevo 
testo, vodni  žličniki, pražen ali pečen krompir, ješprenj,..); 

groba zelenjava ( zelje, paprika, česen čebula, kumare, vse trde solate, stročji 
fižol, kisla repa in zelje, konzervirana zelenjava;  

večje količine svežega sadja, s
uho sadje, orehi, lešniki...;

vse sladke in mastne sladice, ocvrte jedi ( krofi, miške...), torte, potice, mastne 
kreme;

svinjska mast, zaseka, ocvirki;

vse ostre začimbe.',
			'code' => 'D008',
        ]);
		$diets->codes()->create([
            'name' => 'Dieta pri boleznih želodca in dvanajstnika',
			'description' => 'Izločimo vse jedi in dodatke hrani, k
i pospešujejo izločanje želodčne kisline:

mesne juhe; 

hrano s konzervansi, 

vse začimbe (papriko
,f
eferone, poper, čebulo, česen, por, gorčico
,  kis,  hren, 
jušne kocke...); 

koncentrirane sladke jedi (torte, potice...);

močno slana
in kisla živila in jedi;

peč
ene  in  ocvrte  jedi,  majoneze,  zaseko,
svinjsko  mast,  ocvirke,  maslo, 
margarino in smetano v večjih količinah...; 

pikantne sire, mastne sire, polnomastno mleko, sladolede
; 

močan ruski ali
zeleni čaj, kamilični čaj, kavo,vročo čokolado
, kakao;

gazirane in al
koholne pijače.
Izločimo tudi jedi in živila, ki mehanično dražijo želodec: 

grobo  surovo  zelenjavo,  stročnice,
gobe,   kislo   repo,   zelje,konzervirano 
zelenjavo;

sadje sveže in 
suho, marmelade, orehe, lešnike
...;

kitasto 
meso,
prekajeno  meso,  klobase,  salam
e, paštete, divja
čino, meso in 
ribe iz pločevink
...;

sveže pečen kruh in graham kruh, kruh z dodatkom semen...;

žgance, cmoke, štruklje, otrobe.

Opustimo kajenje!
Hrana
,
ki je posebej priporočljiva, ker želodčno kislino dobro nevtralizira, je lahko 
prebavljiv
a  beljakovinska  hrana:  mlado  meso  (brez  vidne  maščobe),  mlad  sirček, 
skuta, mehko kuhano jajce, mleko (1,6% maščobe) in mlečne pijače brez sladkorja.
Za dodatne vmesne obroke so tako primerni številni mlečni izdelki, maslo, nepikantni 
siri, prešana šunka, 
jabolčna čežana, kompoti, banana itd. Kruh naj bo star en dan, 
namesto kruha lahko zaužijemo prepečenec ali kekse.
Če slabo prenašamo mleko, 
ga lahko razredčimo s čajem, z žitno kavo, mineralno 
vodo ali s sadnim sokom, če nam kljub temu škoduje uživanje mleka, ga izločimo iz 
vsakodnevne prehrane.
Če imamo slabo zobovje, uživamo kašasto
ali dobro sesekljano hrano.
Najbolj  primerni  nači
ni  pripr
ave  hrane  so
kuhanje  in
dušenje  v  lastnem  soku  ali 
alu
minijasti foliji
.
Č
e pečemo
,
uporabimo minimalno količino olja
ali
masla.  Precvrtih 
olj in masti ne smemo uporabljati. 
Hrana mora biti primerno topla, ker prevroča ali premrzla draži želodčno sluznico.
Tekočino pijemo šele po obroku.',
			'code' => 'D009',
        ]);
		
		// diseases
        $diseases = CodeType::create([
            'name' => 'Bolezni',
            'description' => 'Seznam bolezni',
        ]);
		$diseases->codes()->create([
            'name' => 'Esencialna hipertenzija',
			'description' => '',
			'code' => 'MKB10I10',
        ]);
		$diseases->codes()->create([
            'name' => 'Hipertenzivna srčna bolezen z (zastojno) srčno odpovedjo',
			'description' => '',
			'code' => 'MKB10I11',
        ]);
		$diseases->codes()->create([
            'name' => 'Diabetes tip 2',
			'description' => '',
			'code' => 'MKB10E11',
        ]);
		$diseases->codes()->create([
            'name' => 'Diabetes tip 1',
			'description' => '',
			'code' => 'MKB10E10',
        ]);
		$diseases->codes()->create([
            'name' => 'Hiperplazija prostate',
			'description' => '',
			'code' => 'MKB10N40',
        ]);
		$diseases->codes()->create([
            'name' => 'Hipotiroza (druge vrste)',
			'description' => '',
			'code' => 'MKB10E03',
        ]);
		$diseases->codes()->create([
            'name' => 'Cistitis (vnetja sečnega mehurja)',
			'description' => '',
			'code' => 'MKB10N30',
        ]);
		$diseases->codes()->create([
            'name' => 'Hiperholesterolemija',
			'description' => '',
			'code' => 'MKB10E78.0',
        ]);
		$diseases->codes()->create([
            'name' => 'Gripa, virus ni dokazan',
			'description' => '',
			'code' => 'MKB10J11',
        ]);
		$diseases->codes()->create([
            'name' => 'Panična anksiozna motnja',
			'description' => '',
			'code' => 'MKB10F41.0',
        ]);
		$diseases->codes()->create([
            'name' => 'Zmerna depresivna motnja',
			'description' => '',
			'code' => 'MKB10F32.1',
        ]);
		$diseases->codes()->create([
            'name' => 'Alergijski rinitis zaradi peloda',
			'description' => '',
			'code' => 'MKB10J30.1',
        ]);
		$diseases->codes()->create([
            'name' => 'Glavkom',
			'description' => '',
			'code' => 'MKB10H40',
        ]);
		$diseases->codes()->create([
            'name' => 'Akutno serozno vnetje srednjega ušesa',
			'description' => '',
			'code' => 'MKB10H65.0',
        ]);
		$diseases->codes()->create([
            'name' => 'Aortna (valvularna) stenoza',
			'description' => '',
			'code' => 'MKB10I35.0',
        ]);
		$diseases->codes()->create([
            'name' => 'Impotenca organskega izvora',
			'description' => '',
			'code' => 'MKB10N48.4',
        ]);
		$diseases->codes()->create([
            'name' => 'Gastroezofagealna refluksna bolezen (GERB)',
			'description' => '',
			'code' => 'MKB10K21',
        ]);
		$diseases->codes()->create([
            'name' => 'Razjeda na želodcu',
			'description' => '',
			'code' => 'MKB10K25',
        ]);
		$diseases->codes()->create([
            'name' => 'Limfatična levkemija',
			'description' => '',
			'code' => 'MKB10C91',
        ]);
		$diseases->codes()->create([
            'name' => 'Mieloična levkemija',
			'description' => '',
			'code' => 'MKB10C92',
        ]);
		
		// medicals
        $medicals = CodeType::create([
            'name' => 'Zdravila',
            'description' => 'Seznam zdravil',
        ]);
		$medicals->codes()->create([
            'name' => 'Enalapril Vitabalans 10 mg tbl',
			'description' => 'http://www.vitabalans.com/index.php?id=zopitin0004',
			'code' => '082392',
        ]);
		$medicals->codes()->create([
            'name' => 'Piramil 10 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/F2D46D0FDF63B711C12579C2003F5E1A/$File/a-016418.pdf',
			'code' => '016470',
        ]);
		$medicals->codes()->create([
            'name' => 'Enap 10 mg tbl',
			'description' => 'http://www.krka.si/sl/zdravila-in-izdelki/zdravila-na-recept/enap/1323/#title',
			'code' => '028479',
        ]);
		$medicals->codes()->create([
            'name' => 'Olivin 10 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/68FDAEEE845A0E52C12579C2003F563B/$File/a-016414.pdf',
			'code' => '059064',
        ]);
		$medicals->codes()->create([
            'name' => 'Concor 5 mg tbl',
			'description' => 'http://si.draagle.com/#!/drug/kzk/?sub=10',
			'code' => '011444',
        ]);
		$medicals->codes()->create([
            'name' => 'Byol 5 mg tbl',
			'description' => 'http://www.lek.si/si/zdravila/na-recept/pakiranje/5862/',
			'code' => '115746',
        ]);
		$medicals->codes()->create([
            'name' => 'Borez 5 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/C393D32B6CCD5421C12579EC00200928/$File/a-009508.pdf',
			'code' => '129607',
        ]);
		$medicals->codes()->create([
            'name' => 'Concordina 5 mg/5 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/65930B0D5833253BC1257C780004AF95/$File/a-013730.pdf',
			'code' => '146097',
        ]);
		$medicals->codes()->create([
            'name' => 'Lodoz 5 mg/6,25 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/73A663A39EB07033C12579C2003F5EE2/$File/a-014615.pdf',
			'code' => '060755',
        ]);
		$medicals->codes()->create([
            'name' => 'Sobycor 5 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/06C4EB4CE17A2068C1257C780004B023/$File/a-013839.pdf',
			'code' => '146144',
        ]);
		$medicals->codes()->create([
            'name' => 'Aglurab 1000 mg tbl',
			'description' => 'http://www.medis.si/fileadmin/medis/medis.si/docs/Navodilo_za_uporabo_Aglurab_SI.pdf',
			'code' => '144343',
        ]);
		$medicals->codes()->create([
            'name' => 'Glucophage 1000 mg tbl',
			'description' => 'http://si.draagle.com/#!/greader/?file=http%3A%2F%2Fskrito.draagle.com%2Fmedia%2Fd%2Fpil%2F040886_pil.pdf',
			'code' => '040886',
        ]);
		$medicals->codes()->create([
            'name' => 'Belformin 500 mg tbl',
			'description' => 'https://mediately.co/si/drugs/WjSUunNJrYrsXmP7DiMg2FANnb9/belformin-500-mg-filmsko-oblozene-tablete',
			'code' => '145137',
        ]);
		$medicals->codes()->create([
            'name' => 'Formagliben 500 mg/2,5 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/C35AF3CC02742C17C12579EC0020018C/$File/a-007344.pdf',
			'code' => '108375',
        ]);
		$medicals->codes()->create([
            'name' => 'Metfogamma 1000 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/4FC2A54BA1DBA6A0C12579C2003F6956/$File/a-020018.pdf',
			'code' => '042021',
        ]);
		$medicals->codes()->create([
            'name' => 'Siofor 1000 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/1D5A54DC62638DE6C12579C2003F61CD/$File/a-014628.pdf',
			'code' => '025550',
        ]);
		$medicals->codes()->create([
            'name' => 'Actrapid 100 i.e. Raztopina za injiciranje v viali',
			'description' => 'https://www.diagnosia.com/si/zdravila/actrapid-100-ieml-raztopina-za-injiciranje-v-viali',
			'code' => '030619',
        ]);
		$medicals->codes()->create([
            'name' => 'Actrapid FlexPen 100 i.e. Raztopina za injiciranje v napolnjenem injekcijskem peresniku',
			'description' => 'https://www.diagnosia.com/si/zdravila/actrapid-flexpen-100-ieml-raztopina-za-injiciranje-v-napolnjenem-injekcijskem-peresniku',
			'code' => '051101',
        ]);
		$medicals->codes()->create([
            'name' => 'Humulin M3 100 i.e./ml suspenzija za injiciranje v vložku',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/5536585C91748BDFC12579C2003F5D63/$File/a-012384.pdf',
			'code' => '095990',
        ]);
		$medicals->codes()->create([
            'name' => 'Insuman Rapid 100 i.e./ml OptiSet raztopina za injiciranje',
			'description' => 'https://myhealthbox.eu/fr/view/1697664/a841ce6cfa958e9d21d2636b18e07e8c/leaflet',
			'code' => '030147',
        ]);
		$medicals->codes()->create([
            'name' => 'Mixtard 10 NovoLet 100 i.e./ml suspenzija za injiciranje v napolnjenem injekcijskem peresniku',
			'description' => 'http://www.diagnosia.com/si/zdravila/mixtard-30-novolet-100-ieml-suspenzija-za-injiciranje-v-napolnjenem-injekcijskem-peresniku',
			'code' => '019534',
        ]);
		$medicals->codes()->create([
            'name' => 'Ranitidin Accord 150 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/C3E218A9243FF5E9C1257C310004BB75?opendocument',
			'code' => '145976',
        ]);
		$medicals->codes()->create([
            'name' => 'Ranital 150 mg tbl',
			'description' => 'http://www.lek.si/si/zdravila/brez-recepta/ranital-s-150/',
			'code' => '071684',
        ]);
		$medicals->codes()->create([
            'name' => 'Metamizol STADA 500 mg/ml peroralne kapljice, raztopina',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/017078003F4E9B32C1257CC90083116E/$File/a-014247.pdf',
			'code' => '146311',
        ]);
		$medicals->codes()->create([
            'name' => 'Analgin 500 mg tbl',
			'description' => 'http://data.zdravila.net/pdf/a-010513.pdf',
			'code' => '000191',
        ]);
		$medicals->codes()->create([
            'name' => '	Omnic Ocas 0,4 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/7C3C54F51BD29C59C12579C2003F63EF?opendocument',
			'code' => '038695',
        ]);
		$medicals->codes()->create([
            'name' => 'Combodart 0,5 mg/0,4mg kaps',
			'description' => 'http://si.draagle.com/#!/greader/?file=http%3A%2F%2Fskrito.draagle.com%2Fmedia%2Fd%2Fpil%2F105864_pil.pdf',
			'code' => '105864',
        ]);
		$medicals->codes()->create([
            'name' => 'Miktan 0,4 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/374B2D55A7D6E43AC12579EC002008A5/$File/a-016035.pdf',
			'code' => '128333',
        ]);
		$medicals->codes()->create([
            'name' => 'Morvesin 0,4 mg trde kapsule	',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/CD18459F93237B13C12579C2003F68AF/$File/a-015652.pdf',
			'code' => '033880',
        ]);
		$medicals->codes()->create([
            'name' => 'Tanyz 0,4 mg trde kapsule',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/B940B7C0F083BE58C12579C2003F637A/$File/a-015072.pdf',
			'code' => '038245',
        ]);
		$medicals->codes()->create([
            'name' => 'Dicitirox 50 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/3291459E7EB4AD14C1257CB400833420?opendocument',
			'code' => '146102',
        ]);
		$medicals->codes()->create([
            'name' => 'Eltroxin 50 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/2ABD62F024313965C12579C2003F5CBB/$File/a-012092.pdf',
			'code' => '092010',
        ]);
		$medicals->codes()->create([
            'name' => 'Euthyrox 50 mg tbl',
			'description' => 'http://si.draagle.com/#!/source/ljn/?drug=ljo',
			'code' => '023442',
        ]);
		$medicals->codes()->create([
            'name' => 'Ciprobay 500 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/6151BEF7B09CA95AC12579C2003F5062?opendocument',
			'code' => '022454',
        ]);
		$medicals->codes()->create([
            'name' => 'Ciprinol 500 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/44DDA83404E35C16C12579C2003F533A/$File/a-015920.pdf',
			'code' => '040398',
        ]);
		$medicals->codes()->create([
            'name' => 'Ciprofloksacin Lek 500 mg tbl',
			'description' => 'http://www.lek.si/si/zdravila/na-recept/pakiranje/1692/',
			'code' => '086029',
        ]);
		$medicals->codes()->create([
            'name' => 'Primotren 80mg/ 400 mg tbl',
			'description' => 'http://www.lek.si/si/zdravila/na-recept/pakiranje/433/',
			'code' => '069418',
        ]);
		$medicals->codes()->create([
            'name' => 'Coupet 20 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/F52A113BA34EB9E3C12579EC00200024?opendocument',
			'code' => '104426',
        ]);
		$medicals->codes()->create([
            'name' => 'Sorvasta 20 mg tbl',
			'description' => 'http://www.krka.si/sl/zdravila-in-izdelki/zdravila-na-recept/sorvastatablete/1673/',
			'code' => '109827',
        ]);
		$medicals->codes()->create([
            'name' => 'Vosustat 20 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/EBA7391D45C8FEBDC12579EC0020021A/$File/a-014601.pdf',
			'code' => '109932',
        ]);
		$medicals->codes()->create([
            'name' => 'Rosuvastatin Teva 20 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/A2118DFEC432DB52C12579EC00200204/$File/a-016289.pdf',
			'code' => '109690',
        ]);
		$medicals->codes()->create([
            'name' => 'Daleron 500 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/1B374BA216FAD256C12579C2003F6932?opendocument',
			'code' => '034487',
        ]);
		$medicals->codes()->create([
            'name' => 'Lekadol 500 mg tbl',
			'description' => 'http://www.lek.si/si/zdravila/brez-recepta/lekadol-filmsko-oblozene-tablete/',
			'code' => '055654',
        ]);
		$medicals->codes()->create([
            'name' => 'Calpol 250 mg/5 ml peroralna suspenzija',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/74B2434C07A44F18C12579C2003F4B3E/$File/a-011568.pdf',
			'code' => '002739',
        ]);
		$medicals->codes()->create([
            'name' => 'Ibuem 250 mg/250 mg/50 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/4D14143C7F6E1F04C1257C620004CDD8/$File/a-016095.pdf',
			'code' => '146066',
        ]);
		$medicals->codes()->create([
            'name' => 'Panadol 500 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/97D3848355D4ABDAC12579C2003F5CDE/$File/a-015216.pdf',
			'code' => '093351',
        ]);
		$medicals->codes()->create([
            'name' => 'Paracetamol svečke 500 mg (Lekarne Ljubljana)',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/C8122F0572FA7141C12579EC001FFF17/$File/a-600695.pdf',
			'code' => '600695',
        ]);
		$medicals->codes()->create([
            'name' => 'Tevitamol 500 mg tablete',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/FCD99A29EDCF611EC12579F900492129/$File/a-016002.pdf',
			'code' => '136058',
        ]);
		$medicals->codes()->create([
            'name' => 'Lexaurin 3 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/5C58B200098CB5A2C12579C2003F53E1?opendocument',
			'code' => '046124',
        ]);
		$medicals->codes()->create([
            'name' => 'Lekotam 3 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/1AF7CA6F1A775F6BC12579C2003F53C6/$File/a-015373.pdf',
			'code' => '045136',
        ]);
		$medicals->codes()->create([
            'name' => 'Apaurin 10 mg tbl',
			'description' => 'http://www.krka.si/sl/zdravila-in-izdelki/zdravila-na-recept/apaurintablete/1287/',
			'code' => '019348',
        ]);
		$medicals->codes()->create([
            'name' => 'Cipralex 10 mg',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/0049AAE59E3AA8D3C12579C2003F532C?opendocument',
			'code' => '040096',
        ]);
		$medicals->codes()->create([
            'name' => 'Citafort 10 mg tbl',
			'description' => 'http://www.lek.si/si/zdravila/na-recept/pakiranje/5775/',
			'code' => '125610',
        ]);
		$medicals->codes()->create([
            'name' => 'Ecytara 10 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/8911B2FE3FFF0EF2C12579EC001FF931/$File/a-016214.pdf',
			'code' => '058793',
        ]);
		$medicals->codes()->create([
            'name' => 'Elicea 10 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/A9B3E333AEC06FBEC12579EC001FFC93/$File/a-016422.pdf',
			'code' => '085685',
        ]);
		$medicals->codes()->create([
            'name' => 'Escitalopram Krka 10 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/C0CAA315ECDB0887C1257CC90083113C/$File/a-016017.pdf',
			'code' => '146299',
        ]);
		$medicals->codes()->create([
            'name' => 'Otigem 10 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/011783EE948D7D8FC12579EC00200501/$File/a-016059.pdf',
			'code' => '118460',
        ]);
		$medicals->codes()->create([
            'name' => 'Solatcit 10 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/90DBE9EE574E4B0BC12579EC00200012/$File/a-016440.pdf',
			'code' => '104213',
        ]);
		$medicals->codes()->create([
            'name' => 'Doreta 37,5 mg/325 mg',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/8BA9838F72FB4FA4C12579EC001FFABB?opendocument',
			'code' => '072940',
        ]);
		$medicals->codes()->create([
            'name' => 'Tramal 150 mg tbl',
			'description' => 'http://www.zdravila.net/navodilo.php?navodilo=s-005819.pdf&d',
			'code' => '012114',
        ]);
		$medicals->codes()->create([
            'name' => 'Tadol 100 mg tbl s podaljšanim sproščanjem',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/63B2B4273D302F22C12579C2003F4E25/$File/a-016266.pdf',
			'code' => '012084',
        ]);
		$medicals->codes()->create([
            'name' => 'Tramadol Vitabalans 50 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/031488B8CE92CA7AC1257BAC0083438E/$File/a-014109.pdf',
			'code' => '145499',
        ]);
		$medicals->codes()->create([
            'name' => 'Zaracet 37,5 mg/325 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/871247132BF7287FC12579EC0020072B/$File/a-011732.pdf',
			'code' => '124680',
        ]);
		$medicals->codes()->create([
            'name' => 'Flonidan 10 mg',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/85571397365F09F1C12579EC001FF803?opendocument',
			'code' => '020583',
        ]);
		$medicals->codes()->create([
            'name' => 'Claritine S 10 mg tbl',
			'description' => 'http://www.lekarnar.com/izdelki/claritine-s-tablete',
			'code' => '062987',
        ]);
		$medicals->codes()->create([
            'name' => 'Florgan 10 mg orodisperzibilne tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/DA55403BA60DE053C12579EC001FF806/$File/a-013832.pdf',
			'code' => '051420',
        ]);
		$medicals->codes()->create([
            'name' => 'Rinolan 10 mg tablete',
			'description' => 'https://www.lekarna24ur.com/public/upload/dokumenti/Rinolan_navodilo_pdf.pdf',
			'code' => '058238',
        ]);
		$medicals->codes()->create([
            'name' => 'Bimatoprost Sandoz 0,3 mg/ml kapljice',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/A3DFEF2F17A035ACC1257D1600831212?opendocument',
			'code' => '146530',
        ]);
		$medicals->codes()->create([
            'name' => 'Lumigan 0,1 mg/ml kapljice',
			'description' => 'https://www.diagnosia.com/si/zdravila/lumigan-01-mgml-kapljice-za-oko-raztopina',
			'code' => '102229',
        ]);
		$medicals->codes()->create([
            'name' => 'Brimonidin Medops 2 mg/ml kapljice za oko',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/727DB8859728BBDEC12579F90049223E/$File/a-016139.pdf',
			'code' => '139603',
        ]);
		$medicals->codes()->create([
            'name' => 'Timalen 2,5 mg/ml kapljice za oko, raztopina',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/86C91BB4FE577DACC12579EC00200369/$File/a-014453.pdf',
			'code' => '114022',
        ]);
		$medicals->codes()->create([
            'name' => 'Latanox 50 mg/ml kapljice za oko',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/159103D546E2C185C12579EC00200367/$File/a-020005.pdf',
			'code' => '114006',
        ]);
		$medicals->codes()->create([
            'name' => 'Hiconcil 500 mg trde kapsule',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/2F6CCCC907EB6078C12579C2003F514E?opendocument',
			'code' => '025666',
        ]);
		$medicals->codes()->create([
            'name' => 'Amoksiklav 500mg/125mg tbl',
			'description' => 'http://www.lek.si/si/zdravila/na-recept/pakiranje/89/',
			'code' => '069280',
        ]);
		$medicals->codes()->create([
            'name' => 'Betaklav 500 mg/125 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/1FFC4EAA3F7319EEC1257EAB00837141/$File/a-015915.pdf',
			'code' => '147056',
        ]);
		$medicals->codes()->create([
            'name' => 'Ospamox 500 mg disperzibilne tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/1C2B687B0E1FB855C12579C2003F6948/$File/a-016157.pdf',
			'code' => '041866',
        ]);
		$medicals->codes()->create([
            'name' => 'Lasix 40 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/582412352E8F356CC12579C2003F58F2?opendocument',
			'code' => '072656',
        ]);
		$medicals->codes()->create([
            'name' => 'Edemid 40 mg tbl',
			'description' => 'http://www.lek.si/si/zdravila/na-recept/pakiranje/198/',
			'code' => '026778',
        ]);
		$medicals->codes()->create([
            'name' => 'Belfil 50 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/C78700915441F103C12579EC002001C7?opendocument',
			'code' => '108995',
        ]);
		$medicals->codes()->create([
            'name' => 'Sildenafil Teva 100 mg tbl',
			'description' => 'https://www.diagnosia.com/si/zdravila/sildenafil-teva-100-mg-filmsko-oblozene-tablete',
			'code' => '097420',
        ]);
		$medicals->codes()->create([
            'name' => 'Tornetis 100 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/396405FCEAF6D06DC12579EC001FFD67/$File/a-014664.pdf',
			'code' => '091782',
        ]);
		$medicals->codes()->create([
            'name' => 'Viagra 50 mg tbl',
			'description' => 'https://www.diagnosia.com/si/zdravila/viagra-50-mg-filmsko-oblozene-tablete',
			'code' => '093564',
        ]);
		$medicals->codes()->create([
            'name' => 'Nolpaza 20 mg gastrorezistentne tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/520C2C9888BDDC6CC12579C2003F6677/$File/a-016474.pdf',
			'code' => '013200',
        ]);
		$medicals->codes()->create([
            'name' => 'Nexium 20 mg gastrorezistentne tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/33C7A15D9E906947C12579C2003F4EB7/$File/a-015564.pdf',
			'code' => '013730',
        ]);
		$medicals->codes()->create([
            'name' => 'Rupurut 500 mg žvečljive tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/AE0A1FEA862CC338C12579C2003F5986/$File/a-014527.pdf',
			'code' => '075566',
        ]);
		$medicals->codes()->create([
            'name' => 'Acipan 20 mg gastrorezistentne tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/16D4CBF7CC46F980C12579C2003F67F1/$File/a-016396.pdf',
			'code' => '028622',
        ]);
		$medicals->codes()->create([
            'name' => 'Controloc 20 mg gastrorezistentne tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/C780D3BD9FE393DAC12579C2003F50BD/$File/a-015817.pdf',
			'code' => '023507',
        ]);
		$medicals->codes()->create([
            'name' => 'Glivec 100 mg tbl',
			'description' => 'http://rxed.eu/sl/g/Glivec/5/',
			'code' => '080608',
        ]);
		$medicals->codes()->create([
            'name' => 'Meaxin 100 mg tbl',
			'description' => 'http://www.cbz.si/cbz/bazazdr2.nsf/o/9F5DD2DFF700BFEDC1257B4B00836C1C/$File/a-013808.pdf',
			'code' => '145415',
        ]);
		$medicals->codes()->create([
            'name' => 'Imatinib Teva 100 mg tbl',
			'description' => 'http://rxed.eu/sl/i/Imatinib+Teva/5/',
			'code' => '145204',
        ]);
    }
}
