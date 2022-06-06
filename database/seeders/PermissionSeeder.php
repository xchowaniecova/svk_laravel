<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Models\Permission;
// use App\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Str;
use DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'faculty_create',
            'faculty_edit',
            'faculty_index',
            'faculty_delete',

            'conference_create',
            'conference_edit',
            'conference_index',
            'conference_delete',
            
            'user_create',
            'user_edit',
            'user_index',
            'user_delete',

            'registration_create',
            'registration_edit',
            'registration_index',
            'registration_delete',

            'section_create',
            'section_edit',
            'section_destroy',
            'section_index',
            'section_classification',

            'program_create',
            'program_index',

            'results_edit',

            'user_access',
            'editor_access',
            'admin_access',
        ];

        foreach($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // gets all permissions via Gate::before rule --> see AuthServiceProvider
        $admin = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $adminPermission = [
            'section_create',
            'section_edit',
            'section_destroy',
        ];

        // Editor role and permissions
        $editor = Role::create([
            'name' => 'editor',
            'guard_name' => 'web'
        ]);
        $editorPermission = [
            'editor_access',
            'faculty_index',
            'user_index',
            'user_access',
            'registration_edit',
            'registration_index',
            'registration_delete',
            'section_classification',
            'section_index',
            'program_create',
            'program_index',
            'results_edit',
        ];

        foreach($editorPermission as $permission) {
            $editor->givePermissionTo($permission);
        }

        // Student role and permissions
        $student = Role::create([
            'name' => 'student',
            'guard_name' => 'web'
        ]);
        $studentPermission = [
            // 'registration_create',
            'user_access'
        ];

        foreach($studentPermission as $permission) {
            $student->givePermissionTo($permission);
        }



        
        // Admins
        User::create([
            'name'                => 'Denisa',
            'surname'             => 'Chowaniecová',
            'title1_id'           => '1',
            'title2_id'           => null,
            'email'               => 'xchowaniecova@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '1',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($admin);
        User::create([
            'name'                => 'Ľuboš',
            'surname'             => 'Čirka',
            'title1_id'           => '2',
            'title2_id'           => '1',
            'email'               => 'lubos.cirka@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '1',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($admin);

        // Editors
        User::create([
            'name'                => 'Juraj',
            'surname'             => 'Oravec',
            'title1_id'           => '5',
            'title2_id'           => '1',
            'email'               => 'juraj.oravec@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '2',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($editor);
        User::create([
            'name'                => 'Martin',
            'surname'             => 'Kalúz',
            'title1_id'           => '2',
            'title2_id'           => '1',
            'email'               => 'martin.kaluz@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '2',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($editor);
        User::create([
            'name'                => 'Peter',
            'surname'             => 'Szolcsanyi',
            'title1_id'           => '5',
            'title2_id'           => '1',
            'email'               => 'peter.szolcsanyi@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '2',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($editor);
        User::create([
            'name'                => 'Ivan',
            'surname'             => 'Šalitroš',
            'title1_id'           => '5',
            'title2_id'           => '1',
            'email'               => 'ivan.salitros@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '2',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($editor);
        User::create([
            'name'                => 'Lenka',
            'surname'             => 'Galčíková',
            'title1_id'           => '2',
            'title2_id'           => null,
            'email'               => 'lenka.galcikova@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '2',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($editor);
        User::create([
            'name'                => 'Michaela',
            'surname'             => 'Horváthová',
            'title1_id'           => '2',
            'title2_id'           => null,
            'email'               => 'michaela.horvathova@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '2',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($editor);
        
        // Students
        User::create([
            'name'                => 'Ondrej',
            'surname'             => 'Gonda',
            'title1_id'           => '2',
            'title2_id'           => null,
            'email'               => 'xgonda@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '3',
            'student_id'          => '75717',
            'faculty_id'          => '83',
            'remember_token'      => Str::random(10)
        ])->assignRole($student);
        User::create([
            'name'                => 'Kika',
            'surname'             => 'Varmeďová',
            'title1_id'           => '3',
            'title2_id'           => null,
            'email'               => 'xvarmedova@uniba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '3',
            'student_id'          => '55717',
            'faculty_id'          => '88',
            'remember_token'      => Str::random(10)
        ])->assignRole($student);
        User::create([
            'name'                => 'Lucia',
            'surname'             => 'Míková',
            'title1_id'           => '1',
            'title2_id'           => null,
            'email'               => 'xmikoval@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '3',
            'student_id'          => '55717',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($student);
        User::create([
            'name'                => 'Rastislav',
            'surname'             => 'Fáber',
            'title1_id'           => '1',
            'title2_id'           => null,
            'email'               => 'xfaber@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '3',
            'student_id'          => '86633',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($student);
        User::create([
            'name'                => 'Lívia',
            'surname'             => 'Homolová',
            'title1_id'           => '1',
            'title2_id'           => null,
            'email'               => 'xhomolova@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '3',
            'student_id'          => '86968',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($student);
        User::create([
            'name'                => 'Michal',
            'surname'             => 'Krištof',
            'title1_id'           => '1',
            'title2_id'           => null,
            'email'               => 'xkristof@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '3',
            'student_id'          => '77624',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($student);
        User::create([
            'name'                => 'Trieu',
            'surname'             => 'Nguyen Hai',
            'title1_id'           => '1',
            'title2_id'           => null,
            'email'               => 'xnguynhai@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '3',
            'student_id'          => '86788',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($student);
        User::create([
            'name'                => 'Erika',
            'surname'             => 'Pavlovičová',
            'title1_id'           => '1',
            'title2_id'           => null,
            'email'               => 'xpavlovicovae@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '3',
            'student_id'          => '91950',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($student);
        User::create([
            'name'                => 'Jakub',
            'surname'             => 'Puk',
            'title1_id'           => '1',
            'title2_id'           => null,
            'email'               => 'xpukj@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '3',
            'student_id'          => '65077',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($student);
        User::create([
            'name'                => 'Michaela',
            'surname'             => 'Vogl',
            'title1_id'           => '1',
            'title2_id'           => null,
            'email'               => 'xvogl@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '3',
            'student_id'          => '86724',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($student);
        User::create([
            'name'                => 'Marek',
            'surname'             => 'Wadinger',
            'title1_id'           => '1',
            'title2_id'           => null,
            'email'               => 'xwadinger@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '3',
            'student_id'          => '91815',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($student);
        User::create([
            'name'                => 'Alexandra',
            'surname'             => 'Žabková',
            'title1_id'           => '1',
            'title2_id'           => null,
            'email'               => 'xzabkova@stuba.sk',
            'email_verified_at'   => now(),
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'                => '3',
            'student_id'          => '86974',
            'faculty_id'          => '79',
            'remember_token'      => Str::random(10)
        ])->assignRole($student);
    }
}
