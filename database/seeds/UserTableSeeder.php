<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 25. 03. 2016
 * Time: 20:57
 */
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.si',
            'password' => Hash::make('admin'),
            'person_type' => '1',
        ));
    }

}