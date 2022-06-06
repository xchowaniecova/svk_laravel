<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Faculty;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showregistrationform()
    {
        $faculties = Faculty::join('universities','universities.id','=','faculties.university_id')
        ->select('universities.shortcut','faculties.id','faculties.name')->get();

        return view('auth.register')
        ->with('faculties',$faculties)
        ->with('listTitles',$this->listTitles())
        ->with('listTitles2',$this->listTitles2())
        ->with('listSchools',$this->listSchools());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'       => ['required', 'string', 'max:255'],
            'surname'    => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            'title1_id'  => ['nullable'],
            'title2_id'  => ['nullable'],
            'student_id' => ['required'],
            'faculty_id' => ['nullable'],
            'faculty'    => 'nullable',
            'university' => 'nullable',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // return dd($data);
        return User::create([
            'name'       => $data['name'],
            'surname'    => $data['surname'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'title1_id'  => ($data['title1_id'] >= 1) ? $data['title1_id'] : NULL,
            'title2_id'  => ($data['title2_id'] >= 1) ? $data['title2_id'] : NULL,
            'student_id' => $data['student_id'],
            'faculty_id' => ($data['faculty_id'] >= 1) ? $data['faculty_id'] : NULL,
            'faculty'    => $data['faculty'],
            'university' => $data['university'],
            'role'       => '3',
        ])->assignRole('student');

    }
}
