<?php

namespace App\Http\Controllers;

use App\Models\Section_final;
use App\Models\Section_start;
use App\Models\Start_final;
use App\Models\Conference;
use App\Models\UserSectionFinal;
use App\Models\UserSectionStart;
use App\Models\User;
use App\Models\Registration;
use App\Http\Requests\StoreSection_finalRequest;
use App\Http\Requests\UpdateSection_finalRequest;
use Session, DB, Auth;

use App\Exports\RoomsExport;
use App\Exports\SectionAdminsExport;
use Maatwebsite\Excel\Facades\Excel;

class SectionFinalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index',SectionFinal::class);
        
        $actual = Conference::max('id');        

        $section = Section_start::where('section_starts.conf_id',$actual)->where('section_starts.final_created','0')
        ->leftJoin('user_section_starts','user_section_starts.section_start_id','=','section_starts.id')
        ->select(
            'section_starts.id AS id', 'section_starts.conf_id AS conf_id',   
            'user_section_starts.user_id AS user_id',
            'section_starts.name AS name', 'section_starts.name_en AS name_en', 
            'section_starts.final_created AS final_created'
        )->orderBy('name')->get();
        foreach ($section as $s) {
            $posters[] = Registration::where('section_start_id',$s->id)->count();
        }
        $section = $section->zip($posters)->all();

        $fsection = Start_final::join('section_finals','start_finals.section_final_id','=','section_finals.id')
        ->join('section_starts','start_finals.section_start_id','=','section_starts.id')
        ->join('user_section_finals','user_section_finals.section_final_id','=','section_finals.id')
        ->join('users','users.id','=','user_section_finals.user_id')
        ->select(
            'section_finals.id','section_finals.name','section_finals.name_en', 
            'start_finals.id','start_finals.section_final_id AS fid', 
            'users.name AS uname', 'users.surname AS usurname', 'users.email AS email',
            DB::raw('GROUP_CONCAT(section_starts.name SEPARATOR ",<br>") AS sname'))
        ->groupBy('start_finals.section_final_id')
        ->orderBy('section_finals.name')->get(); 

        $admins = User::all()->whereIn('role', [1, 2]);

        return view('section_final.index', compact('section','fsection','admins'))
        ->with('listEditors',$this->listEditors());
    }

    public function indexEditor() 
    {
        $this->authorize('section_index',SectionFinal::class);

        $actual = Conference::max('id');

        $section = DB::table('section_finals')->where('section_finals.conf_id',$actual)
        ->leftJoin('registrations','section_finals.id','=','registrations.section_final_id')
        ->select(
            'registrations.id AS reg_id','registrations.section_final_id AS id',
            'section_finals.name AS fname',
            'section_finals.name_en AS fname_en',
        )->groupBy('section_finals.id')
        ->orderBy('section_finals.name')->get();
        foreach ($section as $s) {
            if ($s->id == null) {
                $posters[] = 0;
            }
            else {
                $posters[] = Registration::where('section_final_id',$s->id)->count();
            }
        }
        $section = $section->zip($posters)->all();

        $registration = DB::table('registrations')->where('registrations.conf_id',$actual)
        ->join('authors','authors.reg_id','=','registrations.id')
        ->join('users','users.id','=','registrations.user_id')
        ->leftJoin('faculties','faculties.id','=','users.faculty_id')
        ->leftJoin('universities','universities.id','=','faculties.university_id')
        ->select('registrations.name_contribution', 'registrations.section_final_id AS id',
                'authors.reg_id','users.email','users.faculty AS fac','users.university AS uni',
                'faculties.name AS faculty', 'universities.name AS university',
                DB::raw('GROUP_CONCAT(authors.name) AS name'),
                DB::raw('GROUP_CONCAT(CONCAT(authors.name," ",authors.surname) SEPARATOR ", ") AS surname'))
        ->groupBy('authors.reg_id')
        ->orderBy('registrations.name_contribution')->get();

        return view('section_final.index_editor', compact('section','registration'));
    }

    public function classification()
    {
        $this->authorize('section_index',SectionFinal::class);
        $user_id = Auth::user()->id;
        $role = Auth::user()->role;
        $user_section = UserSectionStart::where('user_id',$user_id)->get('section_start_id');

        $actual = Conference::max('id');
        
        $section = DB::table('registrations')->where('registrations.conf_id',$actual)->where('registrations.review','2')
        ->join('section_starts','section_starts.id','=','registrations.section_start_id')
        ->select('registrations.id AS reg_id','registrations.section_start_id AS id','section_starts.name AS sname')
        ->groupBy('registrations.section_start_id')
        ->orderBy('section_starts.name')->get();      
        foreach ($section as $s) {
            $posters[] = Registration::where('section_start_id',$s->id)->count();
            $posters_ok[] = Registration::where('section_start_id',$s->id)->where('review',2)->count();
        }
        $posters = collect($posters)->zip($posters_ok);
        $section = $section->zip($posters)->all();

        $registration = DB::table('registrations')->where('registrations.conf_id',$actual)->where('registrations.review','2')
        ->join('authors','authors.reg_id','=','registrations.id')
        ->select('registrations.name_contribution', 'registrations.section_start_id AS id', 'registrations.section_final_id',
                'authors.reg_id',
                DB::raw('GROUP_CONCAT(authors.name) AS name'),
                DB::raw('GROUP_CONCAT(CONCAT(authors.name," ",authors.surname) SEPARATOR ", ") AS surname'))
        ->groupBy('authors.reg_id')
        ->orderBy('registrations.name_contribution')->get();

        $fsection = Section_final::orderBy('name')->get();

        return view('section_final.classification', compact('section','registration','fsection','role','user_section'))
        ->with('listSectionFinal',$this->listSectionFinal());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSection_finalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSection_finalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section_final  $section_final
     * @return \Illuminate\Http\Response
     */
    public function show(Section_final $section_final)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section_final  $section_final
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('section_edit',$id);

        $section = Section_final::find($id);
        $admin = UserSectionFinal::where('section_final_id',$id)->first();
        return view('section_final.edit', compact('section','admin'))
        ->with('listEditors',$this->listEditors());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSection_finalRequest  $request
     * @param  \App\Models\Section_final  $section_final
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSection_finalRequest $request, $id)
    {
        $this->authorize('section_edit',$id);

        Section_final::find($id)->update([
            'name'    => $request['name'],
            'name_en' => $request['name_en'],
            'room'    => $request['room'],
            'type'    => $request['type']
        ]);
        UserSectionFinal::where('section_final_id',$id)->update(['user_id' => $request['admin']]);
        Session::flash('success', __('section_finals.updated'));
        return redirect('section_final');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section_final  $section_final
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section_final $section_final)
    {
        $this->authorize('section_destroy',$section_final);

        $final_id = $section_final->id;
        $start_id = Start_final::where('section_final_id',$final_id)->pluck('section_start_id');

        foreach ($start_id as $sid) {
            $s = Section_start::where('id',$sid)->update(array('final_created'=>'0'));
        }

        $section_final->delete();
        return redirect('section_final');
    }

    public function export() 
    {
        return Excel::download(new SectionAdminsExport, 'zoznam-spravcov.xlsx');
    }

    public function export2() 
    {
        return Excel::download(new RoomsExport, 'zoznam-miestnosti.xlsx');
    }
}
