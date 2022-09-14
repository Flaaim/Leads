<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class AddUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Alex',
            'lastname' => 'Grigoriev',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
