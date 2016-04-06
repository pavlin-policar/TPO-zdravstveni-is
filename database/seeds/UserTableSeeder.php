<?php

use App\Models\Code;
use App\Models\User;
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
            'person_type' => Code::ADMIN()->id,
        ]);
        $user->confirmEmail();
        $user->save();

        $user = new User([
            'first_name' => 'Doctor',
            'last_name' => 'Doctor',
            'email' => 'doctor1@zis.si',
            'password' => Hash::make('password'),
            'person_type' => Code::DOCTOR()->id,
        ]);
        $user->confirmEmail();
        $user->save();

        $user = new User([
            'first_name' => 'Doctor',
            'last_name' => 'Doctor',
            'email' => 'doctor2@zis.si',
            'password' => Hash::make('password'),
            'person_type' => Code::DOCTOR()->id,
        ]);
        $user->confirmEmail();
        $user->save();

        $user = new User([
            'first_name' => 'Pavlin',
            'last_name' => 'Poličar',
            'email' => 'pavlin.g.p@gmail.com',
            'password' => Hash::make('password'),
            'person_type' => Code::PATIENT()->id,
            'address' => 'Address',
            'birth_date' => \Carbon\Carbon::create(1994, 3, 12),
        ]);
        $user->confirmEmail();
        $user->save();
        $user->charges()->create([
            'first_name' => 'Miran',
            'last_name' => 'Slejkovič',
            'address' => 'Address',
            'person_type' => Code::PATIENT()->id,
            'birth_date' => \Carbon\Carbon::create(1996, 4, 9),
        ]);
    }

}