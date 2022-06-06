<?php

namespace App\Exports;

use App\Models\Registration;
use App\Models\Conference;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class IBANExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'Meno',
            'Priezvisko',
            'IBAN',
            'SWIFT',
            'Sekcia'
        ];
    }

    public function collection()
    {
        $conf_id = Conference::max('id');
        $bank = Registration::where('registrations.conf_id',$conf_id)
        ->join('users','users.id','=','registrations.user_id')
        ->join('section_finals','section_finals.id','=','registrations.section_final_id')
        ->select([
            'users.name AS name', 'users.surname',
            'registrations.iban', 'registrations.swift',
            'section_finals.name AS sname'
        ])->orderBy('name')->get();

        return $bank;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
