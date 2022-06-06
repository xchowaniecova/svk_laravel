<?php

namespace App\Http\Controllers;

use App\Models\Section_start;
use App\Models\Section_final;
use App\Models\Start_final;
use App\Models\Conference;
use App\Models\UserSectionStart;
use App\Models\UserSectionFinal;
use App\Models\User;
use App\Http\Requests\StoreSection_startRequest;
use App\Http\Requests\UpdateSection_startRequest;
use Session, DB;

class SectionStartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actual = Conference::max('id');
        $section = DB::table('section_starts')->where('section_starts.conf_id',$actual)
        ->leftJoin('user_section_starts','user_section_starts.section_start_id','=','section_starts.id')
        ->leftJoin('users','users.id','=','user_section_starts.user_id')
        ->select([
            'section_starts.id AS id',
            'section_starts.name AS name',
            'section_starts.name_en AS name_en',
            'users.name AS uname',
            'users.surname AS surname',
        ])->orderBy('section_starts.name')->get();

        return view('section_start.index', compact('section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',SectionStart::class);
        
        return view('section_start.create')
        ->with('create', true)
        ->with('listEditors',$this->listEditors());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSection_startRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSection_startRequest $request)
    {
        $this->authorize('create',SectionStart::class);

        $actual = Conference::max('id');
        $v = [
            'name'    => 'required|string',
            'name_en' => 'nullable|string',
            'admin'   => 'required',
          ];
          $validated = $request->validate($v);
      
          try {
            $s = Section_start::create([
              'name'    => $request['name'],
              'name_en' => $request['name_en'],
              'conf_id' => $actual
            ]);
           
            $section_id = $s->id;
           
            UserSectionStart::create([
              'conf_id' => $actual,
              'section_start_id' => $section_id,
              'user_id' => $request['admin']
            ]);
           
            Session::flash('success', __('section_starts.created'));
            return redirect('section_start');
          } catch (Exception $e) {
            Session::flash('failure', $e->getMessage());
            return redirect()->back()->withInput();
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section_start  $section_start
     * @return \Illuminate\Http\Response
     */
    public function show(Section_start $section_start)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section_start  $section_start
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $this->authorize('update', $id);
                
        $section = Section_start::find($id);
        $admin = UserSectionStart::where('section_start_id',$id)->first();
        return view('section_start.edit', compact('section','admin'))
        ->with('listEditors',$this->listEditors());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSection_startRequest  $request
     * @param  \App\Models\Section_start  $section_start
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSection_startRequest $request, $id)
    {
        $this->authorize('update', $id);
        
        Section_start::find($id)->update([
          'name'    => $request['name'],
          'name_en' => $request['name_en'],
        ]);
        UserSectionStart::where('section_start_id',$id)->update(['user_id' => $request['admin']]);
        Session::flash('success', __('section_starts.updated'));
        return redirect('section_start');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section_start  $section_start
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section_start $section_start)
    {
        $section_start->delete();
        return redirect('section_start');
    }

    // Zachovanie povodnej sekcie
    public function keep(UpdateSection_startRequest $request) 
    {
        $actual = Conference::max('id');
        
        $v = [
            'name'        => 'required|string',
            'name_en'     => 'required|string',
            'user_id'     => 'required',
          ];
        $validated = $request->validate($v);
      
        try {
          
          $f = Section_final::create([
            'name'        => $request['name'],
            'name_en'     => $request['name_en'],
            'conf_id'     => $actual,
          ]);

          $f_id = $f->id;

          Start_final::create([
            'section_start_id' => $request['id'],
            'section_final_id' => $f_id,
          ]);

          UserSectionFinal::create([
            'conf_id' => $actual,
            'user_id' => $request['user_id'],
            'section_final_id' => $f_id,
          ]);

          Section_start::find($request['id'])->update(array('final_created'=>'1'));

          Session::flash('success', __('section_finals.created'));
          return redirect('section_final');
        } catch (Exception $e) {
          Session::flash('failure', $e->getMessage());
          return redirect()->back()->withInput();
        }
    }

    public function keepForm(UpdateSection_startRequest $request) 
    {
      $section = DB::table('section_starts')
      ->leftJoin('user_section_starts','user_section_starts.section_start_id','=','section_starts.id')
      ->where('section_starts.id', $request->id)->first();
      $listEditors = $this->listEditors();
      return response()->json([
          'title' => $section,
          'body'  => view('section_final.modal.keep_form',compact('section','listEditors'))->render()
      ]);
    }

    // Rozdelenie povodnej sekcie
    public function splitForm(UpdateSection_startRequest $request) 
    {
      $section = DB::table('section_starts')->where('section_starts.id', $request->id)->first();
      $listEditors = $this->listEditors();
      return response()->json([
          'title' => $section,
          'body'  => view('section_final.modal.split_form',compact('section','listEditors'))->render()
      ]);
    }

    // Rozdelenie povodnej sekcie
    public function combineForm(UpdateSection_startRequest $request) 
    {
      $actual = Conference::max('id');
      $section = DB::table('user_section_starts')
      ->where('user_section_starts.conf_id', $actual)
      ->where('section_starts.final_created', 0)
      ->join('users','user_section_starts.user_id','=','users.id')
      ->join('section_starts','user_section_starts.section_start_id','=','section_starts.id')
      ->select([
          'section_starts.id AS id',
          'section_starts.name AS name',
          'section_starts.name_en AS name_en',
          'users.name AS uname',
          'users.surname AS surname',
      ])->orderBy('section_starts.name')->get();
      $listEditors = $this->listEditors();
      return response()->json([
          'body'  => view('section_final.modal.combine_form',compact('section','listEditors'))->render()
      ]);
    }    

    // Rozdelenie povodnej sekcie
    public function split(StoreSection_startRequest $request) 
    {
      $actual = Conference::max('id');

      $v = [
          'name.*'        => 'required|string',
          'name_en.*'     => 'required|string',
          'user_id.*'     => 'required', 
        ];
      $validated = $request->validate($v);
    
      try {
        
        foreach ($request['name'] as $key => $name) {
          $f = Section_final::create([
            'name'        => $name,
            'name_en'     => $request['name_en'][$key],
            'conf_id'     => $actual,
          ]);

          $f_id = $f->id;
          
          Start_final::create([
            'section_start_id' => $request['id'],
            'section_final_id' => $f_id,
          ]);

          UserSectionFinal::create([
            'conf_id' => $actual,
            'user_id' => $request['user_id'][$key],
            'section_final_id' => $f_id,
          ]);
        }

        Section_start::find($request['id'])->update(array('final_created'=>'1'));

        Session::flash('success', __('section_finals.created'));
        return redirect('section_final');
      } 
      catch (Exception $e) {
        Session::flash('failure', $e->getMessage());
        return redirect()->back()->withInput();
      }
    }

    // Spajanie sekcii
    public function combine(StoreSection_startRequest $request) 
    {
      $actual = Conference::max('id');
      
      $v = [
          'name'        => 'required|string',
          'name_en'     => 'required|string',
          'user_id'     => 'required',
          'section_start_id' => 'required|min:2',
        ];

      $validated = $request->validate($v);   
      
      try {
        
        $f = Section_final::create([
          'name'        => $request['name'],
          'name_en'     => $request['name_en'],
          'conf_id'     => $actual,
        ]);

        $f_id = $f->id;

        UserSectionFinal::create([
          'conf_id' => $actual,
          'user_id' => $request['user_id'],
          'section_final_id' => $f_id,
        ]);

        foreach ($request['section_start_id'] as $key => $section_start) {
          Start_final::create([
            'section_start_id' => $section_start,
            'section_final_id' => $f_id,
          ]);
  
          Section_start::find($section_start)->update(array('final_created'=>'1'));
        }
        
        Session::flash('success', __('section_finals.created'));
        return redirect('section_final');
      } catch (Exception $e) {
        Session::flash('failure', $e->getMessage());
        return redirect()->back()->withInput();
      }
    }
    
    public function classificate(StoreSection_startRequest $request)
    {
      $validated = $request->validate(['fsection' => 'required', 'reg_id' => 'required']);

      foreach ($request['reg_id'] as $key => $reg_id) {
          DB::table('registrations')->where('id',$reg_id)
          ->update(['section_final_id' => ($request['fsection'][$key])]);
      }

      Session::flash('success', __('section_finals.updated'));
      return redirect('sekcie_zaradenie');
    }
}
