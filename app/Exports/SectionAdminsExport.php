<?php

namespace App\Exports;

use App\Models\Section_final;
use App\Models\Conference;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SectionAdminsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'Názov sekcie [SK]',
            'Názov sekcie [EN]',
            'Miestnosť',
            'URL Adresa',
            'Meno a priezvisko správcu',
            'Email správcu',
        ];
    }

    public function collection()
    {
        $conf_id = Conference::max('id');
        $section = Section_final::where('conf_id',$conf_id)
        ->select([
            'name', 'name_en', 
            'room','room_online',
            'admin_name', 'admin_email'
        ])
        ->orderBy('name')->get();

        return $section;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
