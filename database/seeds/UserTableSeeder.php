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

        $doctor = new User([
            'person_type' => Code::DOCTOR()->id,
            'first_name' => 'Doctor',
            'last_name' => 'Doctor',
            'email' => 'doctor@zis.si',
            'password' => Hash::make('password'),
        ]);
        $doctor->confirmEmail();
        $doctor->save();

        $doctor = new User([
            'person_type' => Code::DOCTOR()->id,
            'first_name' => 'Doctor',
            'last_name' => 'Doctor',
            'email' => 'doctor2@zis.si',
            'password' => Hash::make('password'),
        ]);
        $doctor->confirmEmail();
        $doctor->save();
        $doctor->doctorProfile()->create([
            'doctor_number' => 123123123,
            'max_patients' => 10,
        ]);

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