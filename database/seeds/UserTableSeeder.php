<?php

use App\Models\Code;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@zis.si',
            'password' => Hash::make('admin'),
            'person_type' => Code::ADMIN(),
        ]);

        User::create([
            'first_name' => 'Doctor',
            'last_name' => '1',
            'email' => 'doctor1@zis.si',
            'password' => Hash::make('password'),
            'person_type' => Code::DOCTOR(),
        ]);
    }

}