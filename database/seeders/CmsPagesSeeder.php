<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_pages')->insert([
            [
                'title'        => 'Chémia a technológia pre život', 
                'title_nav'    => 'Domov',
                'slug'         => 'domov',
                'content1'     => '<p>V stredu 24. novembra 2021 sa na Fakulte chemickej a potravinárskej technológie STU v Bratislave uskutočnila 23. celoslovenská študentská vedecká konferencia s medzinárodnou účasťou pod názvom "Chémia a technológie pre život". S ohľadom na aktuálnu epidemiologickú situáciu sa konferencie realizovala v online formáte, v prostredí Google Meet.</p><p>Študentská vedecká konferencia "Chémia a technológie pre život" sa dlhodobo profiluje ako platforma na podporu vedeckej práce a zdieľania kreatívnych myšlienok talentovaných študentov. Podporujeme vedecký výskum prinášajúci inovatívne riešenia, ktoré zohľadňujú udržateľnú priemyselnú produkciu, environmentálnu a spoločenskú zodpovednosť.</p><p>Študentská vedecká konferencia je organizovaná v odbore <b>chémia a chemická a potravinárska technológia</b>. Študentská vedecká konferencia je príležitosťou pre študentov 1. stupňa (bakalárskeho) a 2. stupňa (inžinierskeho/magisterského) vysokoškolského štúdia súťažne prezentovať vedecké a odborné práce. <b>Najlepšie práce v jednotlivých sekciách boli odmenené</b>.</p><p>Na študentskej vedeckej konferencii prebehla v jednotlivých sekciách aj nesúťažná prehliadka prác študentov 3. stupňa (doktorandského) vysokoškolského štúdia.</p><h3>Dôležité termíny:</h3><ul><li><b>otvorenie registrácie: </b>20. september 2021</li><li><b>odovzdanie príspevkov a registrácia: </b>29. október 202<b> 1. november 2021</strong></li><li><b>konanie konferencie:</b> 24. november 2021</li></ul>',
                'content2'     => null,
                'status'       => '1',
                'order'        => '1',
                'editable'     => '1'
            ],
            [
                'title'       => 'Informácie pre autorov',
                'title_nav'   => 'Informácie pre autorov',
                'slug'        => 'informacie-pre-autorov',
                'content1'    => '<h2>Registrácia</h2><p>Elektronická registrácia účastníkov bude otvorená 20. spetembra 2021. <b>Uzavretá bola </b>1. novembra 2021.</b></p><p><b>Po úspešnej registrácií príspevku vám bol doručený e-mail, v ktorom bude dôležitý prístupový odkaz (URL). Pomocou tohto odkazu bolo možné upravovať svoj príspevok (rozšírený abstrakt) a registračné údaje až do termínu uzavretia registrácie</b> 1. novembra 2021</b></p><h2>Abstrakt</h2><p><b>Abstrakt musí byť vo formate PDF vypracovaný striktne v súlade s <a href="https://www.uiam.sk/~oravec/svk/svk_template.docx">predlohou pre MS Word</a> (svoj abstrakt vytvoríte v MS Word a potom uložíte ako súbor formátu <em>pdf</em>).</b></p>',
                'content2'    => '<h2>Forma príspevkov</h2><h2><p>Zaregistrované príspevky budú vo forme abstraktu zverejnené v elektronickom zborníku s vlastným ISBN číslom.<br>Príspevok je možné vypracovať a prezentovať v nasledujúcich jazykoch:</p><ul><li>slovenský jazyk</li><li>český jazyk</li><li>anglický jazyk</li></ul><p>Aby bolo možné abstrakt v zborníku zverejniť, musí vyhovať nasledujúcim kritériam:</p><ul><li>abstrakt musí byť vo formáte <b>PDF</b>(vyplňte <a href="https://www.uiam.sk/~oravec/svk/svk_template.docx">predlohu pre MS Word</a> a potom abstrakt uložte ako súbor formátu pdf),</li><li>formát strany: A4,</li><li>rozsah: 1 až 2 strany,</li><li>ostatné podrobnosti sú uvedené v predlohe, ktorú je možné <a href="https://www.uiam.sk/~oravec/svk/svk_template.docx"> stiahnúť tu</a>.</li></ul></h2>',
                'status'      => '1',
                'order'       => '2',
                'editable'    => '1',
            ],
            [
                'title'       => 'Program',
                'title_nav'   => 'Program',
                'slug'        => 'program',
                'content1'    => 'null',
                'content2'    => null,
                'status'      => '1',
                'order'       => '3',
                'editable'    => '0',
            ],
            [
                'title'       => 'Výsledky',
                'title_nav'   => 'Výsledky',
                'slug'        => 'vysledky',
                'content1'    => 'null',
                'content2'    => null,
                'status'      => '1',
                'order'       => '4',
                'editable'    => '0',
            ]
        ]);
    }
}
