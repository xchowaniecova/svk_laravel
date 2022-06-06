<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'ID',
            'Titul pred',
            'Meno',
            'Priezvisko',
            'Titul za',
            'Email',
            'Rola (1-admin, 2-editor, 3-študent)',
        ];
    }

    public function collection()
    {
        $user = User::leftJoin('first_titles', 'users.title1_id', '=', 'first_titles.id')
        ->leftJoin('second_titles', 'users.title2_id', '=', 'second_titles.id')
        ->select([
        'users.id', 
        'first_titles.title AS title1',
        'users.name', 'users.surname',
        'second_titles.title AS title2',
        'users.email', 'users.role',
        ])->whereIn('role',[1,2])->orderBy('surname')->get();

        return $user;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}