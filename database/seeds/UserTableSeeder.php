<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 25. 03. 2016
 * Time: 20:57
 */
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'firstName'     => 'Admin',
            'lastName' => 'Admin',
            'email'    => 'admin@admin.si',
            'password' => Hash::make('admin'),
            'personType' => '1',
        ));
    }

}