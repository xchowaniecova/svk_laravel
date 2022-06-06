<?php

namespace App\Exports;

use App\Models\Author;
use App\Models\Conference;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PresenterExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'ID študenta',
            'Titul pred',
            'Meno',
            'Priezvisko',
            'Titul za',
            'Email',
            'Fakulta',
            'Univerzita'
        ];
    }

    public function collection()
    {
        $conf_id = Conference::max('id');
        $presenter = Author::where('authors.presentation',1)
        ->leftJoin('first_titles','first_titles.id','=','authors.title1_id')
        ->leftJoin('second_titles','second_titles.id','=','authors.title2_id')
        ->leftJoin('registrations','registrations.id','=','authors.reg_id')
        ->leftJoin('users','users.id','=','registrations.user_id')
        ->leftJoin('faculties','faculties.id','=','users.faculty_id')
        ->leftJoin('universities','universities.id','=','faculties.university_id')
        ->where('registrations.conf_id',$conf_id)
        ->where('registrations.review',2)
        ->select([
            'users.student_id AS id',
            'first_titles.title AS t1',
            'authors.name AS name', 'authors.surname AS surname', 
            'second_titles.title AS t2',
            'users.email AS mail', 
            'faculties.name AS fac', 'universities.shortcut AS uni'
        ])
        ->orderBy('authors.surname')->get();
        return $presenter;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
