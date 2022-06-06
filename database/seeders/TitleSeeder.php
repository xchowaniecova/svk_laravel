<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('first_titles')->insert([
            ['title' => 'Bc.'],
            ['title' => 'Ing.'],
            ['title' => 'doc. Ing.'],
            ['title' => 'Ing. arch.'],
            ['title' => 'Mgr.'],
            ['title' => 'Mgr. art.'],
            ['title' => 'MUDr.'],
            ['title' => 'MDDr.'],
            ['title' => 'MVDr.'],
            ['title' => 'RNDr.'],
            ['title' => 'PharmDr.'],
            ['title' => 'PhDr.'],
            ['title' => 'JUDr.'],
            ['title' => 'PaedDr.'],
            ['title' => 'ThDr.'],
            ['title' => 'doc. Ing.'],
            ['title' => 'doc. Mgr.'],
            ['title' => 'prof. Ing.'],
            ['title' => 'prof. Mgr.'],
            ['title' => 'Dr. h. c.'],
        ]);

        DB::table('second_titles')->insert([
            ['title' => 'PhD.'],
            ['title' => 'DrSc.'],
            ['title' => 'CSc.'],
        ]);
    }
}
