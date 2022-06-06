<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\Committee;
use App\Models\Registration;
use App\Models\Section_final;
use App\Models\UserSectionFinal;
use Session, DB, Auth;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actual = Conference::max('id');

        $section = DB::table('registrations')->where('registrations.conf_id',$actual)
        ->join('section_finals','section_finals.id','=','registrations.section_final_id')
        ->select('registrations.id AS reg_id','registrations.section_final_id AS id',
                'section_finals.*')
        ->groupBy('registrations.section_final_id')
        ->orderBy('section_finals.name')->get();

        $registration = DB::table('registrations')->where('registrations.conf_id',$actual)
            ->join('authors','authors.reg_id','=','registrations.id')->where('authors.presentation','1')
            ->select('registrations.name_contribution', 'registrations.section_final_id AS id', 
                    'registrations.program_order AS order', 'registrations.phd AS phd',
                    'authors.reg_id',
                    DB::raw('GROUP_CONCAT(authors.name) AS name'),
                    DB::raw('GROUP_CONCAT(CONCAT(authors.name," ",authors.surname) SEPARATOR ", ") AS surname'))
            ->groupBy('authors.reg_id')
            ->orderBy('registrations.program_order')->get();        

        $committee = Committee::orderBy('member_order')->get();
        $startLectures = $this->startLectures();
       
        return view('program.index', compact('section', 'registration', 'committee', 'startLectures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actual = Conference::max('id');
        $user_id = Auth::user()->id;
        $role = Auth::user()->role;
        $user_section_full = UserSectionFinal::where('user_id', $user_id)->select('section_final_id')->get();
        $user_section = array();
        foreach ($user_section_full as $s) {
            array_push($user_section, $s->section_final_id);
        }
        $section = DB::table('registrations')->where('registrations.conf_id',$actual)
        ->join('section_finals','section_finals.id','=','registrations.section_final_id')
        ->select('registrations.id AS reg_id','registrations.section_final_id AS id',
                'section_finals.*')
        ->groupBy('registrations.section_final_id')
        ->orderBy('section_finals.name')->get();

        $committee = DB::table('committees')
        ->leftJoin('section_finals','committees.section_final_id','=','section_finals.id')
        ->select('committees.*')->get();

        foreach($committee as $c)
        {	
            $section_id[] = $c->section_final_id;
            $member[] = $c->member_name;
            $workplace[] = $c->workplace_name;
            $state[] = $c->workplace_state;
        }

        $registration = DB::table('registrations')->where('registrations.conf_id',$actual)
        ->join('authors','authors.reg_id','=','registrations.id')->where('authors.presentation','1')
        ->select('registrations.name_contribution', 'registrations.section_final_id AS id',
                'authors.reg_id',
                DB::raw('GROUP_CONCAT(authors.name) AS name'),
                DB::raw('GROUP_CONCAT(CONCAT(authors.name," ",authors.surname) SEPARATOR ", ") AS surname'))
        ->groupBy('authors.reg_id')
        ->orderBy('registrations.program_order')->get();
        
        return view('program.create', compact('section','registration','role','user_section','committee'));
    }

    // Zoradenie prispevkov vo finalnych skeciach
    public function sort(Request $request) 
    {
        $i = 1;
        foreach ($request['reg_id'] as $key => $id)
        {
            Registration::where('id',$id)->update([
                'program_order' => $i++
            ]);
        }

        Session::flash('success', __('program.order_created'));
        return redirect('program/create');
    }

    // Zoradenie prispevkov vo finalnych skeciach
    public function sortForm(Request $request) 
    {
        $actual = Conference::max('id');
        $section = DB::table('section_finals')->where('section_finals.id', $request->id)->get();
        $registration = DB::table('registrations')->where('section_final_id', $request->id)
        ->join('authors','authors.reg_id','=','registrations.id')->where('authors.presentation','1')
        ->select('registrations.name_contribution', 'registrations.section_final_id AS id',
                'authors.reg_id',
                DB::raw('GROUP_CONCAT(authors.name) AS name'),
                DB::raw('GROUP_CONCAT(CONCAT(authors.name," ",authors.surname) SEPARATOR ", ") AS surname'))
        ->groupBy('authors.reg_id')
        ->orderBy('registrations.program_order')->get();
        return response()->json([
            'title' => $section,
            'body'  => view('program.modal.sort_form',compact('registration'))->render()
        ]);
    }


    // Tvorba komisie a miestnosti
    public function committee(Request $request) 
    {
        Committee::where('section_final_id',$request['section_final_id'])->delete();
        foreach ($request['name'] as $key => $name) {
            if ($name != null) {
                Committee::create([
                    'section_final_id' => $request['section_final_id'],
                    'member_name'      => $name,
                    'workplace_name'   => $request['workplace'][$key],
                    'workplace_state'  => $request['state'][$key],
                    'member_order'     => $request['member_order'][$key],
                    'accommodation_id' => NULL
                ]);
            }
        } 
        Section_final::where('id',$request['section_final_id'])->update([
            'room'          => $request['room'],
            'room_online'   => $request['room_online'],
            'admin_name'    => $request['admin_name'],
            'admin_email'   => $request['admin_email'],
            'type'          => $request['type']
        ]);

        Session::flash('success', __('program.committee_created'));
        return redirect('program/create');
    }

    // Tvorba komisie a miestnosti
    public function committeeForm(Request $request) 
    {
        $section = DB::table('section_finals')->where('section_finals.id', $request->id)->get();
        $committee = DB::table('committees')->where('committees.section_final_id', $request->id)->get();      
        return response()->json([
            'title' => $section,
            'body'  => view('program.modal.committee_form',compact('committee', 'section'))->render()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
