<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class AddAnotherUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Any',
            'lastname' => 'Grigorievs',
            'email' => 'any@admin.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
