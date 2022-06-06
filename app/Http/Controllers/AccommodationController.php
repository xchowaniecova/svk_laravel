<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Models\Conference;

use \Carbon\Carbon;
use Auth, Session;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Conference::max('id');
        $name = Conference::where('id',$id)->value('name');
        $conf_date = Conference::where('id',$id)->value('conf_date');
        $conf_date = \Carbon\Carbon::createFromFormat('Y-m-d', $conf_date)->format('d.m.Y');

        return view('accommodation.index', compact('conf_date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Conference::max('id');
        $name = Conference::where('id',$id)->value('name');
        $conf_date = Conference::where('id',$id)->value('conf_date');
        $date2 = \Carbon\Carbon::createFromFormat('Y-m-d', $conf_date)->format('d.m.Y');
        $date3 = \Carbon\Carbon::createFromFormat('Y-m-d', $conf_date)->addDay()->format('d.m.Y');
        $date1 = \Carbon\Carbon::createFromFormat('Y-m-d', $conf_date)->subDay()->format('d.m.Y');
        
        return view('accommodation.create',compact('date1','date2','date3'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $conf_id = Conference::max('id');
        $user_id = Auth::user()->id;

        $v = [
            'acc1'     => 'nullable',
            'acc2'     => 'nullable',
            'position' => 'required',
          ];
          $validated = $request->validate($v);
      
          try {
            $accommodation = Accommodation::create([
                'conf_id' => $conf_id,
                'user_id' => $user_id,
                'accommodation1' => ($request['acc1'] == 1) ? 1 : 0,
                'accommodation2' => ($request['acc2'] == 1) ? 1 : 0,
                'position' => $request['position']
            ]);
         
            Session::flash('success', __('accommodation.created'));           
            return redirect()->route('accommodation.edit', [$accommodation->id]);
          } catch (Exception $e) {
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
        $conf_id = Conference::max('id');
        $name = Conference::where('id', $conf_id)->value('name');
        $conf_date = Conference::where('id', $conf_id)->value('conf_date');
        $date2 = \Carbon\Carbon::createFromFormat('Y-m-d', $conf_date)->format('d.m.Y');
        $date3 = \Carbon\Carbon::createFromFormat('Y-m-d', $conf_date)->addDay()->format('d.m.Y');
        $date1 = \Carbon\Carbon::createFromFormat('Y-m-d', $conf_date)->subDay()->format('d.m.Y');

        $user = Auth::user();
        if($user->role == 3) {
            $accommodation = Accommodation::where('id', $id)->where('user_id', $user->id)->first();
        }
        else {
            $accommodation = Accommodation::find($id);
        }
        if(!$accommodation) {
            return abort(403);
        }
        return view('accommodation.edit', compact('accommodation', 'user', 'date1', 'date2', 'date3'));
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
        Accommodation::find($id)->update([
            'accommodation1' => $request['acc1'],
            'accommodation2' => $request['acc2'],
            'position'       => $request['position']
        ]);

        Session::flash('success', __('accommodation.updated'));

        return redirect()->route('accommodation.edit', [$id]);
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
