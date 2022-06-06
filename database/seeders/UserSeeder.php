<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('id', '>', 0)->delete();
        //User::factory(4)->create();
        DB::table('users')->insert([
        [
            'name'                => 'Denisa',
            'surname'             => 'Chowaniecová',
            'title1_id'           => '1',
            'title2_id'           => null,
            'email'               => 'xchowaniecova@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '1',
            'remember_token'      => Str::random(10)
        ],
        [
            'name'                => 'Ľuboš',
            'surname'             => 'Čirka',
            'title1_id'           => '2',
            'title2_id'           => '1',
            'email'               => 'lubos.cirka@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '1',
            'remember_token'      => Str::random(10)
        ],
        [
            'name'                => 'Juraj',
            'surname'             => 'Oravec',
            'title1_id'           => '5',
            'title2_id'           => '1',
            'email'               => 'juraj.oravec@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '2',
            'remember_token'      => Str::random(10)
        ],
        [
            'name'                => 'Martin',
            'surname'             => 'Kalúz',
            'title1_id'           => '2',
            'title2_id'           => '1',
            'email'               => 'martin.kaluz@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '2',
            'remember_token'      => Str::random(10)
        ],
        [
            'name'                => 'Peter',
            'surname'             => 'Szolcsanyi',
            'title1_id'           => '5',
            'title2_id'           => '1',
            'email'               => 'peter.szolcsanyi@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '2',
            'remember_token'      => Str::random(10)
        ],
        [
            'name'                => 'Ivan',
            'surname'             => 'Šalitroš',
            'title1_id'           => '5',
            'title2_id'           => '1',
            'email'               => 'ivan.salitros@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '2',
            'remember_token'      => Str::random(10)
        ],
        [
            'name'                => 'Lenka',
            'surname'             => 'Galčíková',
            'title1_id'           => '2',
            'title2_id'           => null,
            'email'               => 'lenka.galcikova@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '2',
            'remember_token'      => Str::random(10)
        ],
        [
            'name'                => 'Michaela',
            'surname'             => 'Horváthová',
            'title1_id'           => '2',
            'title2_id'           => null,
            'email'               => 'michaela.horvathova@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '2',
            'remember_token'      => Str::random(10)
        ],
        ]);
    }

    
}
