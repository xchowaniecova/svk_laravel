<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Registration;

class FileController extends Controller
{
    public function download(Request $request) 
    {
        $registration = Registration::find($request->id);
        $filename = $registration->abstract_original_file;
        
        if(Storage::disk('public')->exists('abstracts/' . $request->file)) {
            $path = Storage::disk('public')->path('abstracts/' . $request->file);
            $content = file_get_contents($path);
            return response($content)->withHeaders([
                'Content-Type' => mime_content_type($path),
                'Content-disposition' => 'filename="'. $filename .'"'
            ]);
        }
        return redirect('/404');
    }

    public function admin() 
    {
        $filename = 'doc_admin.pdf';
        $path = Storage::disk('public')->path('docs/' . $filename);
        $content = file_get_contents($path);
        return response($content)->withHeaders([
            'Content-Type' => mime_content_type($path),
            'Content-disposition' => 'filename="'. $filename .'"'
        ]);
    }

    public function editor() 
    {
        $filename = 'doc_editor.pdf';
        $path = Storage::disk('public')->path('docs/' . $filename);
        $content = file_get_contents($path);
        return response($content)->withHeaders([
            'Content-Type' => mime_content_type($path),
            'Content-disposition' => 'filename="'. $filename .'"'
        ]);
    }

    public function student() 
    {
        $filename = 'doc_student.pdf';
        $path = Storage::disk('public')->path('docs/' . $filename);
        $content = file_get_contents($path);
        return response($content)->withHeaders([
            'Content-Type' => mime_content_type($path),
            'Content-disposition' => 'filename="'. $filename .'"'
        ]);
    }
}