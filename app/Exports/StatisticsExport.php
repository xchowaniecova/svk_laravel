<?php

namespace App\Exports;

use App\Models\Registration;
use App\Models\Conference;
use App\Models\Section_final;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;

class StatisticsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'Sekcia',
            'Počet prác',
            'Z toho PhD.',
            'Počet účastníkov FCHPT',
            'Z toho PhD.',
            'Počet účastníkov z iných VŠ',
            'Z toho PhD.',
        ];
    }

    public function collection()
    {
        $conf_id = Conference::max('id');
        $name = Section_final::where('conf_id',$conf_id)->pluck('name')->toArray();
        $section = Section_final::where('conf_id',$conf_id)->pluck('id');
        $sfid = Registration::where('conf_id',$conf_id)->pluck('section_final_id');
        // dd($sfid);

        // $statistic = Section_final::leftJoin('registrations','section_finals.id','=','registrations.section_final_id')
        // ->leftJoin('users','users.id','=','registrations.user_id')
        // ->select(
        //     'section_finals.name',
        //     DB::raw("count(registrations.section_final_id) as sfid"),
        //     DB::raw("count(registrations.section_final_id) as sfid"),
        // )->groupBy('section_finals.id')->get();

        foreach ($section as $s) {
                $posters[] = Registration::where('section_final_id',$s)->count();
                $phd1[] = Registration::where('section_final_id',$s)->where('phd',1)->count();
                $fchpt[] = Registration::join('users','users.id','=','registrations.user_id')
                                        ->where('section_final_id',$s)->where('faculty_id',79)->count();
                $phd2[] = Registration::join('users','users.id','=','registrations.user_id')
                                        ->where('section_final_id',$s)->where('faculty_id',79)->where('phd',1)->count();
                $other[] = Registration::join('users','users.id','=','registrations.user_id')
                                        ->where('section_final_id',$s)->where('faculty_id','!=',79)->count();
                $phd3[] = Registration::join('users','users.id','=','registrations.user_id')
                                        ->where('section_final_id',$s)->where('faculty_id','!=',79)->where('phd',1)->count();
            
        }
        $statistic = collect($name)->zip($posters, $phd1, $fchpt, $phd2, $other, $phd3)->all();
        return collect($statistic);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }

    
}
