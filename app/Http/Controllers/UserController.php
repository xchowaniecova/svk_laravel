<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Faculty;
use App\Models\Conference;

use DB, Auth, Session;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $user = User::leftJoin('first_titles', 'users.title1_id', '=', 'first_titles.id')
        ->leftJoin('second_titles', 'users.title2_id', '=', 'second_titles.id')
        ->select([
        'users.*',
        'first_titles.title AS title1',
        'second_titles.title AS title2'
        ])->whereIn('role', [1, 2])->orderBy('surname')->get();

        $section = DB::table('users_section_start')
        ->join('users','users_section_start.user_id','=','users.id')
        ->join('section_starts','users_section_start.section_start_id','=','section_starts.id')
        ->select([
            'section_starts.name AS section'
        ]);

        return view('users.index',compact('user','section'));
    }

    public function edit_user() 
    {
        $this->authorize('user_access',User::class);

        $user_id = Auth::user()->id;
        $user = User::where('users.id',$user_id)
        ->leftJoin('first_titles','first_titles.id','=','users.title1_id')
        ->leftJoin('second_titles','second_titles.id','=','users.title2_id')
        ->leftJoin('faculties','faculties.id','=','users.faculty_id')
        ->select('users.*','first_titles.title AS t1','second_titles.title AS t2','faculties.name AS fac')
        ->get();

        $faculties = Faculty::join('universities','universities.id','=','faculties.university_id')
        ->select('universities.shortcut','faculties.id','faculties.name')->get();

        return view('users.edit_user',compact('user','faculties'))
        ->with('listSchools', $this->listSchools())
        ->with('listTitles', $this->listTitles())
        ->with('listTitles2', $this->listTitles2());
    }

    public function update_user(Request $request) 
    {
        $this->authorize('user_access',User::class);

        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'surname'    => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255'],
            'title1_id'  => 'nullable',
            'title2_id'  => 'nullable',
            'student_id' => 'required',
            'faculty_id' => 'nullable',
            'faculty'    => 'nullable',
            'university' => 'nullable',
        ]);

        try {
            User::where('id',$request['id'])->update([
                'name'       => $request['name'],
                'surname'    => $request['surname'],
                'email'      => $request['email'],
                'title1_id'  => ($request['title1_id'] >= 1) ? $request['title1_id'] : NULL,
                'title2_id'  => ($request['title2_id'] >= 1) ? $request['title2_id'] : NULL,
                'student_id' => $request['student_id'],
                'faculty_id' => ($request['missing-fac'] == 1) ? NULL : $request['faculty_id'],
                'faculty'    => ($request['missing-fac'] == 1) ? $request['faculty'] : NULL,
                'university' => ($request['missing-fac'] == 1) ? $request['university'] : NULL,
            ]);

            Session::flash('success', __('users.updated'));
            return redirect('osobne-udaje');
        } catch (\Exception $e) {
            Session::flash('failure', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware(['role:admin','permission:user_create']);

        return view('users.create')
        ->with('listTitles',$this->listTitles())
        ->with('listTitles2',$this->listTitles2());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = [
            'name'      => 'required|string',
            'surname'   => 'required|string',
            'title1'    => 'nullable',
            'title2'    => 'nullable',
            'email'     => 'required|email|unique:App\Models\User,email',
            'role'      => 'nullable'
          ];
        $validated = $request->validate($v);
        
        try {

            if($request['role'] == 1) {
                User::create([
                    'title1_id'  => ($request['title1'] >= 1) ? $request['title1'] : NULL,
                    'title2_id'  => ($request['title2'] >= 1) ? $request['title2'] : NULL,
                    'name'       => $request['name'],
                    'surname'    => $request['surname'],
                    'email'      => $request['email'],
                    'password'   => Hash::make($this->defaultPassword()),
                    'role'       => ($request['role'] == 1) ? 1 : 2,
                ])->assignRole('admin');
            }
            else {
                User::create([
                    'title1_id'  => ($request['title1'] >= 1) ? $request['title1'] : NULL,
                    'title2_id'  => ($request['title2'] >= 1) ? $request['title2'] : NULL,
                    'name'       => $request['name'],
                    'surname'    => $request['surname'],
                    'email'      => $request['email'],
                    'password'   => Hash::make($this->defaultPassword()),
                    'role'       => ($request['role'] == 1) ? 1 : 2,
                ])->assignRole('editor');
            }
        
            Session::flash('success', __('users.created'));
            return redirect('users');
        } catch (Exception $e) {
        // For later use
        // if (Auth::user()->role == 0){
        //   Session::flash('failure', $e->getMessage());
        // } else {
        //   Session::flash('failure', 'Opps... please contact administrator');
        // }
        Session::flash('failure', $e->getMessage());
        return redirect()->back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
 
        return view('users.edit')
        ->with('user', $user)
        ->with('listTitles', $this->listTitles())
        ->with('listTitles2', $this->listTitles2());


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if($request['role'] == 1) {
            $user->update([
                'title1_id'  => ($request['title1_id'] >= 1) ? $request['title1_id'] : NULL,
                'title2_id'  => ($request['title2_id'] >= 1) ? $request['title2_id'] : NULL,
                'name'       => $request['name'],
                'surname'    => $request['surname'],
                'email'      => $request['email'],
                'role'       => ($request['role'] == 1) ? 1 : 2,
            ]);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole('admin');
        }
        else {
            $user->update([
                'title1_id'  => ($request['title1_id'] >= 1) ? $request['title1_id'] : NULL,
                'title2_id'  => ($request['title2_id'] >= 1) ? $request['title2_id'] : NULL,
                'name'       => $request['name'],
                'surname'    => $request['surname'],
                'email'      => $request['email'],
                'role'       => ($request['role'] == 1) ? 1 : 2,
            ]);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole('editor');
        }

        Session::flash('success', __('users.updated'));
        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        Session::flash('success', __('users.deleted'));
        return redirect('users');
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'zoznam-uzivatelov.xlsx');
    }

    public function emails() 
    {
        $actual = Conference::max('id');

        $section = DB::table('registrations')->where('registrations.conf_id',$actual)
        ->join('section_finals','section_finals.id','=','registrations.section_final_id')
        ->join('users','users.id','=','registrations.user_id')
        ->select('registrations.*',
                'section_finals.name',
                DB::raw('GROUP_CONCAT(users.email SEPARATOR "<br>") AS email'))
        ->groupBy('registrations.section_final_id')
        ->orderBy('section_finals.name')->get();
       
        return view('users.emails', compact('section'));
    }

}
