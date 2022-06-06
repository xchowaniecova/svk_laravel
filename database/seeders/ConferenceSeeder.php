<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conferences')->insert([
            [
                'name'       => 'Chemia vsade okolo nas',
                'order'      => '22',
                'conf_date'  => '2020-12-10',
                'date_start' => '2020-09-14',
                'date_end'   => '2020-12-11',
                'reg_start'  => '2020-09-14',
                'reg_end'    => '2020-12-4',
            ],
            [
                'name'       => 'Chémia a technológie pre život',
                'order'      => '23',
                'conf_date'  => '2021-12-12',
                'date_start' => '2021-09-20',
                'date_end'   => '2021-12-13',
                'reg_start'  => '2021-09-20',
                'reg_end'    => '2021-12-6',
            ],
                   
        ]);

    }
}
