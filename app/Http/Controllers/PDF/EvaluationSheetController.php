<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;
use PDF;

class EvaluationSheetController extends Controller
{
    public function simplePDF() {

        $id = Conference::max('id');
        $name = Conference::where('id',$id)->value('name');
        $i = [1,2,3,4,5,6,7,8,9,10,11,12];
        $data = compact(['i','name']);
        $pdf = PDF::loadView('pdf.evaluation_sheet', $data)->setPaper('a4', 'landscape');
        return $pdf->stream('hodnotiaci_harok.pdf');
    
    }

}
