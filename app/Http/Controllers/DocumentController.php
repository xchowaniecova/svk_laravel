<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\Committee;
use App\Models\Section_final;
use App\Models\Registration;
use Carbon\Carbon;

use DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actual = Conference::max('id');

        $section = DB::table('registrations')->where('registrations.conf_id',$actual)
        ->join('section_finals','section_finals.id','=','registrations.section_final_id')
        ->select('registrations.id AS reg_id','registrations.section_final_id AS id',
                'section_finals.*')
        ->groupBy('registrations.section_final_id')
        ->orderBy('section_finals.name')->get();

        $registration = DB::table('registrations')->where('registrations.conf_id',$actual)
        ->join('authors','authors.reg_id','=','registrations.id')->where('authors.presentation','1')
        ->select('registrations.name_contribution', 'registrations.section_final_id AS id', 
                'registrations.program_order AS order', 'registrations.phd AS phd',
                'authors.reg_id',
                DB::raw('GROUP_CONCAT(authors.name) AS name'),
                DB::raw('GROUP_CONCAT(CONCAT(authors.name," ",authors.surname) SEPARATOR ", ") AS surname'))
        ->groupBy('authors.reg_id')
        ->orderBy('registrations.program_order')->get();

        $committee = Committee::orderBy('member_order')->get();
        
        return view('doc.index', compact('section','registration','committee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store1($id)
    { 
        // Nazov sekcie
        $sname = Section_final::find($id)->value('name');
        // Zoznam komisie
        $cid = Committee::where('section_final_id',$id)->pluck('id');
        foreach ($cid as $cid) {
            $committee[] = Committee::where('id',$cid)->value('member_name');
        }
        // Sutazne prispevky
        $rid = Registration::where('section_final_id',$id)->where('phd',0)->pluck('id');
        foreach ($rid as $rid) {
            $posters[] = Registration::leftJoin('authors','authors.reg_id','=','registrations.id')
                        ->where('registrations.id',$rid)->where('authors.presentation',1)
                        ->select(DB::raw('CONCAT(authors.name," ",authors.surname) AS name'))->value('name');
        }
        // Nesutazne prispevky
        $phdid = Registration::where('section_final_id',$id)->where('phd',1)->pluck('id');
        if ($phdid->empty()) {
            $phd_posters = '';
        }
        else {
            foreach ($phdid as $phdid) {
                $phd_posters[] = Registration::leftJoin('authors','authors.reg_id','=','registrations.id')
                            ->where('registrations.id',$phdid)->where('authors.presentation',1)
                            ->select(DB::raw('CONCAT(authors.name," ",authors.surname) AS name'))->value('name');
            }
        }
        // Datum 
        $date = Carbon::now()->format('d.m.Y');
    
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $phpWord->setDefaultFontName('Calibri');
        $phpWord->setDefaultFontSize(11);
        // Definovanie velkosti nadpisov
        $phpWord->addTitleStyle(1, array('size' => 16), array('numStyle' => 'hNum', 'numLevel' => 0, 'spaceAfter' => 500, 'spaceBefore' => 100));
        $phpWord->addTitleStyle(2, array('size' => 14), array('numStyle' => 'hNum', 'numLevel' => 1, 'spaceAfter' => 100, 'spaceBefore' => 300));
        $phpWord->addTitleStyle(3, array('size' => 12), array('numStyle' => 'hNum', 'numLevel' => 2, 'spaceAfter' => 100, 'spaceBefore' => 400));
        $phpWord->addTitleStyle(4, array('size' => 10), array('numStyle' => 'hNum', 'numLevel' => 3, 'spaceAfter' => 100, 'spaceBefore' => 700));
        // Definovanie tabulky
        $tableStyle = array('borderColor' => 'FFFFFF', 'borderSize' => 1, 'cellMargin' => 0);
        $tableWidth = array(5000, 5000);
        $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
        $cellHLeft = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT);
        $cellHRight = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT);
        // Vytvorenie sekcie
        $section = $phpWord->addSection();
        // Nadpis
        $section->addTitle('Prezenčná listina', 1);
        $text = $section->addTitle('Názov sekcie: ' . $sname,2);
        $text = $section->addTitle('Komisia: ',3);
        $i = 1;
        if ($cid->empty()) {
            $text = $section->addText('');
        }        
        else {
            $table = $section->addTable($tableStyle);
            foreach ($committee as $c) {            
                $table->addRow();
                $table->addCell($tableWidth[0])->addText($i . '. ' . $c, null, $cellHLeft);
                $table->addCell($tableWidth[1])->addText('........................................................', null, $cellHRight);
                $i++;
            }
        }
        
        $text = $section->addTitle('Súťažné príspevky: ',3);
        $i = 1;
        $table = $section->addTable($tableStyle);
        foreach ($posters as $p) {  
            $table->addRow();
            $table->addCell($tableWidth[0])->addText($i . '. ' . $p, null, $cellHLeft);
            $table->addCell($tableWidth[1])->addText('........................................................', null, $cellHRight);
            $i++;
        }
        $text = $section->addTitle('Nesúťažné príspevky: ',3);
        $i = 1;
        if ($phdid->empty()) {
            $text = $section->addText('V tejto sekcii sa nenachádzajú nesúťažné príspevky.');
        }
        else {
            $table = $section->addTable($tableStyle);
            foreach ($phd_posters as $pp) {            
                $table->addRow();
                $table->addCell($tableWidth[0])->addText($i . '. ' . $pp, null, $cellHLeft);
                $table->addCell($tableWidth[1])->addText('........................................................', null, $cellHRight);
                $i++;
            }
        }
        $text = $section->addTitle('Hostia: ',3);
        $text = $section->addText('1. ........................................................');
        $text = $section->addText('2. ........................................................');
        $text = $section->addText('3. ........................................................');
        $text = $section->addTitle('V Bratislave, dňa ' . $date, 4);
        

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('prezencna_listina.docx');
        return response()->download(public_path('prezencna_listina.docx'));
    }  
    
    public function store2 ($id) 
    {
        // Nazov sekcie
        $sname = Section_final::find($id)->value('name');
        // Predseda komisie
        $president = Committee::where('section_final_id',$id)->where('member_order',1)->value('member_name');
        // Veduci sekcie
        $leader = Section_final::where('section_final_id',$id)
                                ->join('user_section_finals','user_section_finals.section_final_id','=','section_finals.id')
                                ->join('users','users.id','=','user_section_finals.user_id')
                                ->select(DB::raw('CONCAT(users.name," ",users.surname) AS name'))->value('name');
        // Pocet zareg. prac
        $posters = Registration::where('section_final_id',$id)->count();
        // Pocet zareg. prac
        $comp = Registration::where('section_final_id',$id)->where('phd',0)->count();
        // Datum
        $date = Carbon::now()->format('d.m.Y');
            
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $phpWord->setDefaultFontName('Calibri');
        $phpWord->setDefaultFontSize(11);
        // Definovanie velkosti nadpisov
        $phpWord->addTitleStyle(1, array('size' => 16), array('numStyle' => 'hNum', 'numLevel' => 0, 'spaceAfter' => 500, 'spaceBefore' => 100));
        $phpWord->addTitleStyle(2, array('size' => 14), array('numStyle' => 'hNum', 'numLevel' => 1, 'spaceAfter' => 300, 'spaceBefore' => 300));
        $phpWord->addTitleStyle(3, array('size' => 12), array('numStyle' => 'hNum', 'numLevel' => 2, 'spaceAfter' => 100, 'spaceBefore' => 200));
        $phpWord->addTitleStyle(4, array('size' => 10), array('numStyle' => 'hNum', 'numLevel' => 3, 'spaceAfter' => 100, 'spaceBefore' => 700));
        $phpWord->addTitleStyle(5, array('size' => 10), array('numStyle' => 'hNum', 'numLevel' => 3, 'spaceAfter' => 1000, 'spaceBefore' => 700));
        // Definovanie tabulky
        $tableStyle = array('borderColor' => 'FFFFFF', 'borderSize' => 1, 'cellMargin' => 0);
        $tableWidth = array(5000, 5000);
        $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
        $cellHLeft = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT);
        $cellHRight = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT);
        
        // Vytvorenie sekcie
        $section = $phpWord->addSection();
        
        // Nadpis
        $section->addTitle('Protokol o rokovaní sekcie', 1);
        $text = $section->addTitle('Názov sekcie: ' . $sname,2);
        $text = $section->addText('Predseda komisie: ' . $president);
        $text = $section->addText('Organizačný vedúci sekcie: ' . $leader);
        $text = $section->addText('Celkový počet zaregistrovaných prác: ' . $posters);
        $text = $section->addText('Počet súťažných príspevkov: ' . $comp);
        $text = $section->addText('Hodnotenie súťažných prác: ');
        $text = $section->addText('Hodnotenie sekcie a pripomienky k rokovaniu: ');
        $text = $section->addTitle('Príloha: prezenčná listina',4);
        $text = $section->addTitle('V Bratislave, dňa ' . $date, 5);

        $table = $section->addTable($tableStyle);
        $table->addRow(1);
        $table->addCell($tableWidth[0])->addText('........................................', null, $cellHLeft);
        $table->addCell($tableWidth[1])->addText('........................................', null, $cellHRight);
        $table->addRow(2);
        $table->addCell($tableWidth[0])->addText($president, null, $cellHLeft);
        $table->addCell($tableWidth[1])->addText($leader, null, $cellHRight);
        $table->addRow(3);
        $table->addCell($tableWidth[0])->addText('organizačný vedúci sekcie', null, $cellHLeft);
        $table->addCell($tableWidth[1])->addText('predseda komisie', null, $cellHRight);
        
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('protokol_o_rokovanie_sekcie.docx');
        return response()->download(public_path('protokol_o_rokovanie_sekcie.docx'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
