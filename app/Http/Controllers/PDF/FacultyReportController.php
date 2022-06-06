<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use PDF;

class FacultyReportController extends Controller
{
      public function simplePDF() {
       
        $data = Faculty::leftJoin('universities','faculties.university_id','=','universities.id')
        ->select([
            'faculties.*',
            'universities.name AS university'
            ])
        ->orderBy('faculties.name')
        ->get();
  
        view()->share('faculty',$data);
  
        $pdf = PDF::loadView('simplePDF', $data);
    
        return $pdf->download('faculties.pdf');
      }
}
