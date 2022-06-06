<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Author;
use App\Models\Faculty;
use App\Models\Conference;
use App\Models\FirstTitle;
use App\Models\SecondTitle;
use App\Models\Section_final;
use App\Models\Review;
use App\Models\UserSectionStart;

use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Requests\UpdateRegistrationRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReviewAdded;

use Illuminate\Http\Request;

use Session, DB, Auth, PDF;
use \Carbon\Carbon;

use App\Exports\IBANExport;
use App\Exports\StatisticsExport;
use Maatwebsite\Excel\Facades\Excel;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $registration = DB::table('registrations')
        ->join('section_starts','registrations.section_start_id','=','section_starts.id')
        ->leftJoin('section_finals','registrations.section_final_id','=','section_finals.id')
        ->join('users','registrations.user_id','=','users.id')
        ->join('faculties','faculties.id','=','users.faculty_id')
        ->join('universities','faculties.university_id','=','universities.id')
        ->select([
            'registrations.id','registrations.name_contribution','registrations.phd','registrations.review',
            'section_starts.name AS section',
            'section_finals.name AS fsection',
            'faculties.name AS faculty',
            'universities.shortcut AS uni'
        ])->orderBy('registrations.id','desc')->get();

        $authors = Author::all();
        $review = Review::join('registrations','registrations.id','=','reviews.reg_id')->select('');
        return view('registration.index',compact('registration','authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $faculties = Faculty::leftJoin('universities','universities.id','=','faculties.university_id')
        ->select('faculties.*','universities.shortcut AS shortcut')
        ->orderBy('faculties.name')->get();

        $title1 = FirstTitle::all();
        $title2 = SecondTitle::all();

        return view('registration.create')
        ->with('listUniversities',$this->listUniversities())
        ->with('listSectionStart',$this->listSectionStart())
        ->with('title1',$title1)
        ->with('title2',$title2)
        ->with('listSchools',$this->listSchools())
        ->with('faculties',$faculties);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRegistrationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $actual = Conference::max('id');
        $user_id = Auth::user()->id;
        $usurname = Auth::user()->surname;

        $v = [
            'name_contribution'  => 'required',
            'section'            => 'required',  
            'abstract_file'      => 'required|mimes:pdf',   
            'name.*'             => 'required',
            'surname.*'          => 'required',
            'phd'                => 'nullable',
            'agree_bank_account' => 'required',
            'agree_gdpr'         => 'required',
            'agree_citate'       => 'required',
            'agree_video'        => 'nullable',
            'iban'               => 'required',
            'swift'              => 'nullable', 
            'title1_id.*'        => 'nullable',
            'title2_id.*'        => 'nullable',
            'title1.*'           => 'nullable',
            'title2.*'           => 'nullable',
            'presentation'       => 'required',
        ];
        $validated = $request->validate($v);

        $file = $request->file('abstract_file');
        $abstract_original = $file->getClientOriginalName();
        $abstract_storage = $file->hashName(); 
        $file->store('public/abstracts');
                
        try {
            $r = Registration::create([
                'conf_id'            => $actual,
                'user_id'            => $user_id,
                'name_contribution'  => $request['name_contribution'],
                'abstract_original_file' => $abstract_original,
                'abstract_storage_file'  => $abstract_storage,
                'phd'                => ($request['phd'] == 1) ? 1 : 0,
                'section_start_id'   => $request['section'],
                'iban'               => $request['iban'],
                'swift'              => $request['swift'],
                'agree_bank_account' => ($request['agree_bank_account'] == 1) ? 1 : 0,
                'agree_gdpr'         => ($request['agree_gdpr'] == 1) ? 1 : 0,
                'agree_citation'     => ($request['agree_citate'] == 1) ? 1 : 0,
                'agree_video'        => ($request['agree_video'] == 1) ? 1 : 0,
            ]);
            
            $reg_id = $r->id;

            $i = 0;

           foreach ($request['name'] as $key => $name) {
              $a = Author::create([
                'reg_id'    => $reg_id,
                'name'      => $name,
                'title1_id' => ($request['title1_id'][$key] >= 1) ? $request['title1_id'][$key] : NULL,
                'title1'    => $request['title1'][$key],
                'surname'   => $request['surname'][$key],
                'title2_id' => ($request['title2_id'][$key] >= 1) ? $request['title2_id'][$key] : NULL,
                'title2'    => $request['title2'][$key],
                'order' => $i++,
                'presentation' => ($request['presentation'] == $key) ? 1 : 0
            ]);
           } 

        Session::flash('success', __('registrations.created'));
        return redirect('home'); 
        
        } catch (\Exception $e) {
        Session::flash('failure', $e->getMessage());
        return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
    }

    public function indexEdit()
    {
        $user_id = Auth::user()->id;
        $role = Auth::user()->role;
        $user_section = UserSectionStart::where('user_id',$user_id)->get('section_start_id');
        
        $registration = Registration::join('users','registrations.user_id','=','users.id')
        ->join('section_starts','registrations.section_start_id','=','section_starts.id')
        ->leftJoin('section_finals','registrations.section_final_id','=','section_finals.id')
        ->get([
            'registrations.*',
            'section_starts.name AS ssection',
            'section_finals.name AS fsection',
            'users.email AS email'
        ]);
        $fsection = Section_final::all();
        $authors = Author::all();

        return view('registration.index_edit',compact('registration','authors','fsection','user_section','role'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Auth::user()->role;
        $user_id = Auth::user()->id;
        if($role == 3) {
            $registration = Registration::where('id',$id)->where('user_id',$user_id)->first();
        }
        else {
            $registration = Registration::find($id);
        }
        if(!$registration) {
            return abort(403);
        }

        $uname = Auth::user()->name;
        $usurname = Auth::user()->surname;

        $authors = Author::all()->where('reg_id','=',$id);
        $title1 = FirstTitle::all();
        $title2 = SecondTitle::all();

        return view('registration.edit', compact('registration','authors','title1','title2','uname','usurname','role'))
        ->with('listSectionStart',$this->listSectionStart())
        ->with('listTitles',$this->listTitles())
        ->with('listTitles2',$this->listTitles2());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegistrationRequest  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $file = $request->file('abstract_file');
        $abstract_original = $file->getClientOriginalName();
        $abstract_storage = $file->hashName(); 
        $file->store('public/abstracts');

        Registration::find($id)->update([
                'name_contribution'  => $request['name_contribution'],
                'abstract_original_file' => $abstract_original,
                'abstract_storage_file'  => $abstract_storage,
                'phd'                => ($request['phd'] == 1) ? 1 : 0,
                'section_start_id'   => $request['section_start_id'],
                'iban'               => $request['iban'],
                'swift'              => $request['swift'],
        ]);
        
        $i = 0;

        Author::where('reg_id', $id)->delete();
        foreach ($request['name'] as $key => $name) {
            if(trim($name) && trim($request['surname'][$key])) {
                $a = Author::create([
                'reg_id'    => $id,
                'name'      => $name,
                'title1_id' => ($request['title1_id'][$key] >= 1) ? $request['title1_id'][$key] : NULL,
                'title1'    => $request['title1'][$key],
                'surname'   => $request['surname'][$key],
                'title2_id' => ($request['title2_id'][$key] >= 1) ? $request['title2_id'][$key] : NULL,
                'title2'    => $request['title2'][$key],
                'order'     => $i++,
                'presentation' => ($request['presentation'] == $key) ? 1 : 0
                ]);
            }
        } 

        Session::flash('success', __('registrations.updated'));

        if(Auth::user()->role == 3)
            return redirect()->route('registration.edit', [$id]); //redirect('registration.edit')->with('id',$id);
        else
            return redirect('registracia_edit_all');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {
        $registration->delete();
        return redirect('registracia_edit_all');
    }

    public function review(Request $request) 
    {    
        $validated = $request->validate([
            'recenzia'    => 'required|integer',
            'text_spravy' => 'nullable|string',
            'rev_stop'    => 'nullable|date'
        ]);

        $actual = Conference::max('id');
        $user_id = Auth::user()->id;

        try {        
            Review::create([
                'conf_id'   => $actual,
                'reg_id'    => $request['reg_id'],
                'user_id'   => $user_id,
                'text'      => $request['text_spravy'],
                'rev_stop'  => $request['rev_stop'],
                'review'    => $request['recenzia'],
            ]);  
            Registration::where('id',$request['reg_id'])->update(['review' => $request['recenzia']]);

            if($request['recenzia'] != 1) {
                $author_id = DB::table('registrations')->where('id',$request['reg_id'])->pluck('user_id'); 
                $aname = DB::table('users')->where('id',$author_id)->value('name');
                $uname = DB::table('users')->where('id',$user_id)->value('name');
                $usurname = DB::table('users')->where('id',$user_id)->value('surname');
                $emailAddress = DB::table('users')->where('id',$author_id)->value('email');
                if ($request['rev_stop'] != null) {
                    $rev_stop = \Carbon\Carbon::createFromFormat('Y-m-d', $request['rev_stop'])->format('d.m.Y');
                }
                else {
                    $rev_stop = $request['rev_stop'];
                }    
                $data['text']     = $request['text_spravy'];
                $data['rev_stop'] = $rev_stop;
                $data['aname']    = $aname;
                $data['uname']    = $uname;
                $data['usurname'] = $usurname;
                $data['review']   = $request['recenzia'];
                Mail::to($emailAddress)->send(new ReviewAdded($data));
            }
                        
        Session::flash('success', __('registrations.review_added'));
        return redirect('registracia_edit_all'); 
        
        } catch (\Exception $e) {
        Session::flash('failure', $e->getMessage());
        return redirect()->back()->withInput();
        }
    }

    public function export() 
    {
        return Excel::download(new IBANExport, 'zoznam-bankovych-udajov.xlsx');
    }

    public function statistics() 
    {
        return Excel::download(new StatisticsExport, 'statistiky.xlsx');
    }
}
