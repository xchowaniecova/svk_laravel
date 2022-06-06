<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
        $this->call(ConferenceSeeder::class);
        $this->call(TitleSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(UniversitySeeder::class);
        $this->call(FacultySeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(SectionStartSeeder::class);
        // $this->call(UserSeeder::class);
        $this->call(UserSectionStartSeeder::class);
        $this->call(RegistrationSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(CmsPagesSeeder::class);
        // \App\Models\User::factory(5)->create();
             
    }
}
