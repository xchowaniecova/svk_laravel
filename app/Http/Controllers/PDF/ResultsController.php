<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;
use PDF, DB;

class ResultsController extends Controller
{
    public function simplePDF() {

        $id = Conference::max('id');
        $name = Conference::where('id',$id)->value('name');

        $section = DB::table('registrations')->where('registrations.conf_id',$id)
        ->join('section_finals','section_finals.id','=','registrations.section_final_id')
        ->select('registrations.id AS reg_id','registrations.section_final_id AS id',
                'section_finals.name AS fname')
        ->groupBy('registrations.section_final_id')
        ->orderBy('section_finals.name')->get();

        $registration = DB::table('registrations')->where('registrations.conf_id',$id)
        ->join('authors','authors.reg_id','=','registrations.id')->where('authors.presentation','1')
        ->select('registrations.name_contribution', 'registrations.section_final_id AS id', 
                'registrations.program_order AS order', 'registrations.phd AS phd','registrations.placement AS placement',
                'authors.reg_id',
                DB::raw('GROUP_CONCAT(authors.name) AS name'),
                DB::raw('GROUP_CONCAT(CONCAT(authors.name," ",authors.surname) SEPARATOR ", ") AS surname'))
        ->groupBy('authors.reg_id')
        ->orderBy('registrations.placement')->get();

        $data = compact(['name','section','registration']);
        $customPaper = array(0,0,396.85,583.80);
        $pdf = PDF::loadView('pdf.results', $data)->setPaper($customPaper, 'landscape');
        return $pdf->stream('vysledky-pdf.pdf');

    }
}
