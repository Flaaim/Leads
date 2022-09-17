<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class AddSource extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sources')->insert([
            ['title'=> 'Website'],
            ['title'=> 'Istagram'],
            ['title'=> 'Facebook'],
            ['title'=> 'Pinterest'],
        ]);
    }
}
