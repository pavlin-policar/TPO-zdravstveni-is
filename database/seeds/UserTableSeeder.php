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
            'last_name' => '1',
            'email' => 'doctor1@zis.si',
            'password' => Hash::make('password'),
            'person_type' => Code::DOCTOR()->id,
        ]);
        $user->confirmEmail();
        $user->save();
    }

}