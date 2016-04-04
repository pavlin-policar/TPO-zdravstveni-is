<?php

use App\Models\Postcode;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Postcode::create([
            'postcode' => 1000,
            'post' => 'Ljubljana',
        ]);
    }
}
