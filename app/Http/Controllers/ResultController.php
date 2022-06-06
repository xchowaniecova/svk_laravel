<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\Section_final;
use App\Models\Registration;
use App\Models\UserSectionFinal;
use DB, Session, Auth;

class ResultController extends Controller
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
                'section_finals.name AS fname')
        ->groupBy('registrations.section_final_id')
        ->orderBy('section_finals.name')->get();

        $registration = DB::table('registrations')->where('registrations.conf_id',$actual)
        ->join('authors','authors.reg_id','=','registrations.id')->where('authors.presentation','1')
        ->select('registrations.name_contribution', 'registrations.section_final_id AS id', 
                'registrations.program_order AS order', 'registrations.phd AS phd','registrations.placement AS placement',
                'authors.reg_id',
                DB::raw('GROUP_CONCAT(authors.name) AS name'),
                DB::raw('GROUP_CONCAT(CONCAT(authors.name," ",authors.surname) SEPARATOR ", ") AS surname'))
        ->groupBy('authors.reg_id')
        ->orderBy('registrations.program_order')->get();
        
        return view('results.index', compact('section','registration'));
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
        $user_section = UserSectionFinal::where('user_id',$user_id)->get('section_final_id');

        $section = DB::table('registrations')->where('registrations.conf_id',$actual)
        ->join('section_finals','section_finals.id','=','registrations.section_final_id')
        ->select('registrations.id AS reg_id','registrations.section_final_id AS id',
                'section_finals.name AS fname')
        ->groupBy('registrations.section_final_id')
        ->orderBy('section_finals.name')->get();

        $registration = DB::table('registrations')->where('registrations.conf_id',$actual)
        ->join('authors','authors.reg_id','=','registrations.id')->where('authors.presentation','1')
        ->select('registrations.name_contribution', 'registrations.section_final_id AS id', 
                'registrations.program_order AS order', 'registrations.phd AS phd',
                'authors.reg_id', 'placement',
                DB::raw('GROUP_CONCAT(authors.name) AS name'),
                DB::raw('GROUP_CONCAT(CONCAT(authors.name," ",authors.surname) SEPARATOR ", ") AS surname'))
        ->groupBy('authors.reg_id')
        ->orderBy('registrations.program_order')->get();
        
        return view('results.create', compact('section','registration','role','user_section'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request['reg_id'] as $key => $reg_id) {
            Registration::where('id',$reg_id)->update(['placement' => $request['placement'][$key]]);
        }

        Session::flash('success', __('results.created'));
        return redirect('results/create');
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
