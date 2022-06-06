<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert([
            [
                'id'            => '1',
                'reg_id'        => '1',
                'title1_id'     => '2',
                'title1'        => null,
                'name'          => 'Lucia',
                'surname'       => 'Míková',
                'title2_id'     => null,
                'title2'        => null,
                'presentation'  => '1',
                'order'         => '0'
            ],
            [
                'id'            => '2',
                'reg_id'        => '1',
                'title1_id'     => '5',
                'title1'        => null,
                'name'          => 'Juraj',
                'surname'       => 'Oravec',
                'title2_id'     => '1',
                'title2'        => null,
                'presentation'  => '0',
                'order'         => '1'
            ],

            [
                'id'            => '3',
                'reg_id'        => '2',
                'title1_id'     => '1',
                'title1'        => null,
                'name'          => 'Ondrej',
                'surname'       => 'Gonda',
                'title2_id'     => null,
                'title2'        => null,
                'presentation'  => '1',
                'order'         => '0'
            ],
            [
                'id'            => '4',
                'reg_id'        => '2',
                'title1_id'     => '2',
                'title1'        => 'arch.',
                'name'          => 'Viera',
                'surname'       => 'Nadaska',
                'title2_id'     => '1',
                'title2'        => null,
                'presentation'  => '0',
                'order'         => '1'
            ],

            [
                'id'            => '5',
                'reg_id'        => '3',
                'title1_id'     => null,
                'title1'        => 'MUDr.',
                'name'          => 'Kristína',
                'surname'       => 'Varmeďová',
                'title2_id'     => null,
                'title2'        => null,
                'presentation'  => '1',
                'order'         => '0'
            ],

            //////////////////////////////////////////

            [
                'id'            => '6',
                'reg_id'        => '4',
                'title1_id'     => '1',
                'title1'        => null,
                'name'          => 'Rastislav',
                'surname'       => 'Fáber',
                'title2_id'     => null,
                'title2'        => null,
                'presentation'  => '1',
                'order'         => '0'
            ],

            [
                'id'            => '7',
                'reg_id'        => '5',
                'title1_id'     => '1',
                'title1'        => null,
                'name'          => 'Lívia',
                'surname'       => 'Homolová',
                'title2_id'     => null,
                'title2'        => null,
                'presentation'  => '1',
                'order'         => '0'
            ],

            [
                'id'            => '8',
                'reg_id'        => '6',
                'title1_id'     => '1',
                'title1'        => null,
                'name'          => 'Michal',
                'surname'       => 'Krištof',
                'title2_id'     => null,
                'title2'        => null,
                'presentation'  => '1',
                'order'         => '0'
            ],

            [
                'id'            => '9',
                'reg_id'        => '7',
                'title1_id'     => '1',
                'title1'        => null,
                'name'          => 'Trieu',
                'surname'       => 'Nguyen Hai',
                'title2_id'     => null,
                'title2'        => null,
                'presentation'  => '1',
                'order'         => '0'
            ],
            
            [
                'id'            => '10',
                'reg_id'        => '8',
                'title1_id'     => '1',
                'title1'        => null,
                'name'          => 'Erika',
                'surname'       => 'Pavlovičová',
                'title2_id'     => null,
                'title2'        => null,
                'presentation'  => '1',
                'order'         => '0'
            ],  
            
            [
                'id'            => '11',
                'reg_id'        => '9',
                'title1_id'     => '1',
                'title1'        => null,
                'name'          => 'Jakub',
                'surname'       => 'Puk',
                'title2_id'     => null,
                'title2'        => null,
                'presentation'  => '1',
                'order'         => '0'
            ],  

            [
                'id'            => '12',
                'reg_id'        => '10',
                'title1_id'     => '1',
                'title1'        => null,
                'name'          => 'Michaela',
                'surname'       => 'Vogl',
                'title2_id'     => null,
                'title2'        => null,
                'presentation'  => '1',
                'order'         => '0'
            ],  

            [
                'id'            => '13',
                'reg_id'        => '11',
                'title1_id'     => '1',
                'title1'        => null,
                'name'          => 'Marek',
                'surname'       => 'Wadinger',
                'title2_id'     => null,
                'title2'        => null,
                'presentation'  => '1',
                'order'         => '0'
            ],  

            [
                'id'            => '14',
                'reg_id'        => '12',
                'title1_id'     => '1',
                'title1'        => null,
                'name'          => 'Alexandra',
                'surname'       => 'Žabková',
                'title2_id'     => null,
                'title2'        => null,
                'presentation'  => '1',
                'order'         => '0'
            ],  
        ]);
    }
}
