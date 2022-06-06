<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\University;
use APP\Models\User;
use Session, Gate, DataTables;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      abort_if(Gate::denies('faculty_access'),403);

      $faculties = Faculty::leftJoin('universities','faculties.university_id','=','universities.id')
      ->select(['faculties.*','universities.name AS university'])->orderBy('faculties.name')->paginate(20);;
      return view('faculties.index',compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Faculty::class);
        return view('faculties.create')->with('listUniversities',$this->listUniversities());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFacultyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Faculty::class);
        $v = [
            'name'       => 'required',
            'university' => 'required',
          ];
        $validated = $request->validate($v);
        
        try {
          Faculty::create([
              'name'          => $request['name'],
              'name_en'       => $request['name_en'],
              'university_id' => $request['university'],
            ]);     
          Session::flash('success', __('faculties.saved'));
          return redirect('faculties');
        } catch (\Exception $e) {
          Session::flash('failure', $e->getMessage());
          return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', $id);
        $faculties = Faculty::find($id);
        return view('faculties.edit', compact('faculties'))
        ->with('listUniversities',$this->listUniversities());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFacultyRequest  $request
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        $this->authorize('update', $id);
        
        Faculty::find($id)->update($request->all());
        Session::flash('success', __('faculties.updated'));
        return redirect('faculties');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faculty $faculty)
    {
        $this->authorize('delete',$faculty);
        $faculty->delete();
        return redirect('faculties');
    }

    public function getFaculty(Request $request)
    {
        if ($request->ajax()) {
            $data = Faculty::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a>
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
