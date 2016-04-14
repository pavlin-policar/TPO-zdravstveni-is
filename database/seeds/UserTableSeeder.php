<?php

use App\Models\Code;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        $user = new User([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@zis.si',
            'password' => Hash::make('admin'),
			'address' => 'Zdravstveni dom 1',
            'person_type' => Code::ADMIN()->id,
			'birth_date' => Carbon::create(1970, 1, 1),
        ]);
        $user->confirmEmail();
        $user->save();

        /**
         * DOCTORS
         */
        $doctor1 = new User([
            'person_type' => Code::DOCTOR()->id,
            'first_name' => 'Leon',
            'last_name' => 'Bizjak',
            'email' => 'doctor1@zis.si',
            'password' => Hash::make('password'),
            'phone_number' => '1348947312',
            'birth_date' => Carbon::create(1970, 1, 1, 0, 0, 0),
            'gender' => Code::MALE()->id,
        ]);
        $doctor1->confirmEmail();
        $doctor1->save();
        $doctor1->doctorProfile()->create([
            'doctor_type_id' => Code::PERSONAL_DOCTOR()->id,
            'doctor_number' => 123123123,
            'max_patients' => 10,
        ]);

        $doctor2 = new User([
            'person_type' => Code::DOCTOR()->id,
            'first_name' => 'Miran',
            'last_name' => 'Kopač',
            'email' => 'doctor2@zis.si',
            'password' => Hash::make('password'),
            'phone_number' => '1348947312',
            'birth_date' => Carbon::create(1970, 1, 1, 0, 0, 0),
            'gender' => Code::MALE()->id,
        ]);
        $doctor2->confirmEmail();
        $doctor2->save();
        $doctor2->doctorProfile()->create([
            'doctor_type_id' => Code::PERSONAL_DOCTOR()->id,
        ]);

        $doctor3 = new User([
            'person_type' => Code::DOCTOR()->id,
            'first_name' => 'Franc',
            'last_name' => 'Bole',
            'email' => 'doctor3@zis.si',
            'password' => Hash::make('password'),
            'phone_number' => '1348947312',
            'birth_date' => Carbon::create(1970, 1, 1, 0, 0, 0),
            'gender' => Code::MALE()->id,
        ]);
        $doctor3->confirmEmail();
        $doctor3->save();
        $doctor3->doctorProfile()->create([
            'doctor_type_id' => Code::PERSONAL_DOCTOR()->id,
        ]);
		
		$doctor4 = new User([
            'person_type' => Code::DOCTOR()->id,
            'first_name' => 'Jože',
            'last_name' => 'Jarc',
            'email' => 'doctor007@zis.si',
            'password' => Hash::make('password'),
            'phone_number' => '1348947312',
            'birth_date' => Carbon::create(1970, 1, 1, 0, 0, 0),
            'gender' => Code::MALE()->id,
        ]);
        $doctor4->confirmEmail();
        $doctor4->save();
        $doctor4->doctorProfile()->create([
            'doctor_type_id' => Code::PERSONAL_DOCTOR()->id,
            'doctor_number' => 12312323,
            'max_patients' => 19,
        ]);

        $dentist1 = new User([
            'person_type' => Code::DOCTOR()->id,
            'first_name' => 'Ana',
            'last_name' => 'Novak',
            'email' => 'dentist1@zis.si',
            'password' => Hash::make('password'),
            'phone_number' => '1348947312',
            'birth_date' => Carbon::create(1970, 1, 1, 0, 0, 0),
            'gender' => Code::MALE()->id,
        ]);
        $dentist1->confirmEmail();
        $dentist1->save();
        $dentist1->doctorProfile()->create([
            'doctor_number' => 8329842,
            'max_patients' => 10,
            'doctor_type_id' => Code::PERSONAL_DENTIST()->id,
        ]);

        $dentist2 = new User([
            'person_type' => Code::DOCTOR()->id,
            'first_name' => 'Mila',
            'last_name' => 'Kunis',
            'email' => 'dentist2@zis.si',
            'password' => Hash::make('password'),
            'phone_number' => '1348947312',
            'birth_date' => Carbon::create(1970, 1, 1, 0, 0, 0),
            'gender' => Code::MALE()->id,
        ]);
        $dentist2->confirmEmail();
        $dentist2->save();
        $dentist2->doctorProfile()->create([
            'doctor_type_id' => Code::PERSONAL_DENTIST()->id,
        ]);
		
		$dentist1 = new User([
            'person_type' => Code::DOCTOR()->id,
            'first_name' => 'Zobni',
            'last_name' => 'Dohtar',
            'email' => 'dentist007@zis.si',
            'password' => Hash::make('password'),
            'phone_number' => '1348947312',
            'birth_date' => Carbon::create(1970, 1, 1, 0, 0, 0),
            'gender' => Code::MALE()->id,
        ]);
        $dentist1->confirmEmail();
        $dentist1->save();
        $dentist1->doctorProfile()->create([
            'doctor_number' => 8329742,
            'max_patients' => 10,
            'doctor_type_id' => Code::PERSONAL_DENTIST()->id,
        ]);

        /**
         * PATIENTS
         */
        $user = new User([
            'person_type' => Code::PATIENT()->id,
            'first_name' => 'Pavlin',
            'last_name' => 'Poličar',
            'email' => 'pavlin.g.p@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'Address',
            'birth_date' => Carbon::create(1994, 3, 12),
        ]);
        $user->confirmEmail();
        $user->save();

		$user->charges()->create([
            'person_type' => Code::PATIENT()->id,
            'first_name' => 'Miran',
            'last_name' => 'Slejkovič',
            'address' => 'Address',
            'birth_date' => Carbon::create(1996, 4, 9),
        ]);
		
		$user = new User([
            'person_type' => Code::PATIENT()->id,
            'first_name' => 'Marko',
            'last_name' => 'Lavrinec',
            'email' => 'markolavrinec@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'Address',
            'birth_date' => Carbon::create(1994, 8, 9),
        ]);
        $user->confirmEmail();
        $user->save();
		
        $user->charges()->create([
            'person_type' => Code::PATIENT()->id,
            'first_name' => 'Oskrbovanec',
            'last_name' => 'Oskrbovani',
            'address' => 'Address',
            'birth_date' => Carbon::create(1949, 12, 11),
        ]);
    }

}