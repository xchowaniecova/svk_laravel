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

class RoomsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'Sekcia',
            'Miestnosť',
            'URL adresa',
        ];
    }

    public function collection()
    {
        $conf_id = Conference::max('id');
        $room = Section_final::where('conf_id',$conf_id)
        ->select([
            'name', 'room', 'room_online'
        ])->orderBy('name')->get();

        return $room;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
