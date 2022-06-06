<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Section_start;
use App\Http\Requests\StoreConferenceRequest;
use App\Http\Requests\UpdateConferenceRequest;
use Illuminate\Http\Request;
use Session, Carbon;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conferences = Conference::all();

        $actualConf = Conference::orderBy('id','desc')->first();
        $conf1 = Conference::orderBy('id','desc')->value('date_start');
        $conf2 = Conference::orderBy('id','desc')->value('date_end');
        $reg1 = Conference::orderBy('id','desc')->value('reg_start');
        $reg2 = Conference::orderBy('id','desc')->value('reg_end');

        $now = Carbon\Carbon::now()->format('d.m.Y');

        $id = Conference::max('id');
        $name = Conference::where('id',$id)->value('name');
        $order = Conference::where('id',$id)->value('order');
        $conf_date = Conference::where('id',$id)->value('conf_date');

        return view('conference.index',compact('conferences','name','order','conf_date'))
        ->with('actualConf',$actualConf)
        ->with('conf1',$conf1)
        ->with('conf2',$conf2)
        ->with('reg1',$reg1)
        ->with('reg2',$reg2)
        ->with('now',$now);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Conference::class);
        return view('conference.create')->with('create', true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreConferenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConferenceRequest $request)
    {
        $this->authorize('create',Conference::class);
        $v = [
            'name'        => 'nullable',
            'conf_date'   => 'nullable|date',
            'date_start'  => 'required|date',
            'date_end'    => 'required|date',
            'reg_start'   => 'required|date',
            'reg_end'     => 'required|date',
          ];
          $validated = $request->validate($v);
          
          $last_id = Conference::max('id');
          $last_order = Conference::where('id',$last_id)->value('order');
          $new_order = $last_order+1;

          $section = Section_start::where('conf_id',$last_id)->get();
          
          $new_conf = Conference::create([
              'name'       => $request['name'],
              'order'      => $new_order,
              'conf_date'  => $request['conf_date'],
              'date_start' => $request['date_start'],
              'date_end'   => $request['date_end'],
              'reg_start'  => $request['reg_start'],
              'reg_end'    => $request['reg_end'],
          ]);

          foreach ($section as $s) {
              Section_start::create([
                  'conf_id' => $new_conf->id,
                  'name' => $s->name,
                  'name_en' => $s->name_en,
                  'final_created' => 0,
              ]);
          }
          Session::flash('success', __('conference.saved'));
          return redirect('conference');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function show(Conference $conference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Conference::max('id');
        $name = Conference::where('id',$id)->value('name');
        $conference = Conference::find($id);

        return view('conference.create',compact('name','conference'))
        ->with('create', false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConferenceRequest  $request
     * @param  \App\Models\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v = [
            'name'        => 'nullable',
            'conf_date'   => 'nullable|date',
            'date_start'  => 'required|date',
            'date_end'    => 'required|date',
            'reg_start'   => 'required|date',
            'reg_end'     => 'required|date',
          ];
          $validated = $request->validate($v);
      
          $c = Conference::find($id);
          $c->name = $request->name;
          $c->conf_date = $request->conf_date;
          $c->date_start = $request->date_start;
          $c->date_end = $request->date_end;
          $c->reg_start = $request->reg_start;
          $c->reg_end = $request->reg_end;
      
          try {
            $c->save();
            Session::flash('success', __('conference.saved'));
            return redirect('conference');
          } catch (\Exception $e) {
            Session::flash('failure', $e->getMessage());
            return redirect()->back()->withInput();
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Section_start::where('conf_id',$id)->delete();
        Conference::find($id)->delete();
        Session::flash('success', __('conference.deleted'));
        return redirect('conference');

    }
}
