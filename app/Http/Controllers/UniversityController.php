<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use Illuminate\Http\Request;
use App\Models\Faculty;
use APP\Models\User;
use Session;
use Gate;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('faculty_access'),403);

        $universities = University::leftJoin('countries','countries.id','=','universities.country_id')
        ->select('universities.*','countries.country')->orderBy('universities.name')->paginate(20);;
        return view('universities.index',compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',University::class);
        return view('universities.create')->with('listCountries',$this->listCountries());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUniversityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Faculty::class);
        $v = [
            'name'       => 'required',
            'name_en'    => 'required',
            'shortcut'   => 'required',
            'country_id' => 'required'
          ];
        $validated = $request->validate($v);
        
        try {
          University::create($request->all());      
          Session::flash('success', __('faculties.saved'));
          return redirect('universities');
        } catch (\Exception $e) {
          Session::flash('failure', $e->getMessage());
          return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', $id);
        $universities = University::find($id);
        return view('universities.edit', compact('universities'))->with('listCountries',$this->listCountries());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUniversityRequest  $request
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', $id);
        
        University::find($id)->update($request->all());
        Session::flash('success', __('faculties.updated'));
        return redirect('universities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university)
    {
        $this->authorize('delete',$university);
        $university->delete();
        Session::flash('success', __('faculties.deleted'));
        return redirect('universities');
    }
}
