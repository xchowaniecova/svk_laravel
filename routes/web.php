<?php

use Illuminate\Support\Facades\Route;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FacultiesImport;

use App\Models\Conference;
use \Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $id = Conference::max('id');
    $name = Conference::where('id',$id)->value('name');
    $order = Conference::where('id',$id)->value('order');
    $reg_start = Conference::where('id',$id)->value('reg_start');
    $reg_start = \Carbon\Carbon::createFromFormat('Y-m-d', $reg_start)->format('d.m.Y');
    $reg_end = Conference::where('id',$id)->value('reg_end');
    $reg_end = \Carbon\Carbon::createFromFormat('Y-m-d', $reg_end)->format('d.m.Y');
    return view('welcome',compact('name','order','reg_start','reg_end'));
});

Route::group(['middleware' => ['role:editor|admin|student']], function () {
    Route::get('/osobne-udaje', 'App\Http\Controllers\UserController@edit_user')->name('users.edit_user');
    Route::put('/osobne-udaje-uprava', 'App\Http\Controllers\UserController@update_user')->name('users.update_user');
});

Route::group(['middleware' => ['role:editor|admin']], function () {
    Route::get('/registracia_edit_all', 'App\Http\Controllers\RegistrationController@indexEdit')->name('registration.indexEdit');
    Route::put('/recenzie/{id}', 'App\Http\Controllers\RegistrationController@review')->name('registration.review');
    Route::get('/sekcie_zaradenie', 'App\Http\Controllers\SectionFinalController@classification')->name('section_final.classification');
    Route::get('/finalne_sekcie', 'App\Http\Controllers\SectionFinalController@indexEditor')->name('section_final.indexEditor');
    Route::get('/change-password', 'App\Http\Controllers\ChangePasswordController@index')->name('change-password');
    Route::post('/change-password', 'App\Http\Controllers\ChangePasswordController@changePassword')->name('change.password');
    Route::post('/classificate', 'App\Http\Controllers\SectionStartController@classificate')->name('section_start.classificate');
    Route::post('/zoradenie_prispevkov', 'App\Http\Controllers\ProgramController@sort')->name('program.sort');
    Route::post('/tvorba_komisie', 'App\Http\Controllers\ProgramController@committee')->name('program.committee');

    Route::get('/program-sort/{id}', 'App\Http\Controllers\ProgramController@sortForm')->name('program.sortForm');
    Route::get('/program-committee/{id}', 'App\Http\Controllers\ProgramController@committeeForm')->name('program.committeeForm'); 
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('users/export/', 'App\Http\Controllers\UserController@export')->name('users.export');
    Route::get('admins/export/', 'App\Http\Controllers\SectionFinalController@export')->name('admins.export');
    Route::get('presenters/export/', 'App\Http\Controllers\AuthorController@export')->name('presenters.export');
    Route::get('rooms/export/', 'App\Http\Controllers\SectionFinalController@export2')->name('rooms.export');
    Route::get('banks/export/', 'App\Http\Controllers\RegistrationController@export')->name('banks.export');
    Route::get('statistics/export/', 'App\Http\Controllers\RegistrationController@statistics')->name('statistics.export');

    Route::resource('/cms-pages', App\Http\Controllers\CmsController::class);
    Route::post('cms-sort', 'App\Http\Controllers\CmsController@sort')->name('cms-pages.sort');

    Route::post('/keep', 'App\Http\Controllers\SectionStartController@keep')->name('section_start.keep');
    Route::post('/split', 'App\Http\Controllers\SectionStartController@split')->name('section_start.split');
    Route::post('/combine', 'App\Http\Controllers\SectionStartController@combine')->name('section_start.combine');

    Route::get('/emails', 'App\Http\Controllers\UserController@emails')->name('users.emails');
    Route::get('/section-keep/{id}', 'App\Http\Controllers\SectionStartController@keepForm')->name('section_start.keepForm');
    Route::get('/section-split/{id}', 'App\Http\Controllers\SectionStartController@splitForm')->name('section_start.splitForm');
    Route::get('/section-combine/{id}', 'App\Http\Controllers\SectionStartController@combineForm')->name('section_start.combineForm');    
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
   
    Route::resource('/registration', App\Http\Controllers\RegistrationController::class);
    Route::resource('/accommodation', App\Http\Controllers\AccommodationController::class);

    Route::group(['middleware' => ['role:editor|admin']], function () {
        Route::resource('/universities', App\Http\Controllers\UniversityController::class);
        Route::resource('/faculties', App\Http\Controllers\FacultyController::class);
        Route::resource('/conference', App\Http\Controllers\ConferenceController::class);
        Route::resource('/users', App\Http\Controllers\UserController::class);
        Route::resource('/section_start', App\Http\Controllers\SectionStartController::class);
        Route::resource('/section_final', App\Http\Controllers\SectionFinalController::class);
        Route::resource('/program', App\Http\Controllers\ProgramController::class);
        Route::resource('/results', App\Http\Controllers\ResultController::class);
        Route::resource('/doc',App\Http\Controllers\DocumentController::class);
        Route::get('/doc.store1/{id}','App\Http\Controllers\DocumentController@store1')->name('doc.store1');
        Route::get('/doc.store2/{id}','App\Http\Controllers\DocumentController@store2')->name('doc.store2');
    });

});

Route::get('vysledky/report', [App\Http\Controllers\PDF\ResultsController::class, 'simplePDF'])->name('results.report.simplePDF');
Route::get('hodnotiaci_harok', [App\Http\Controllers\PDF\EvaluationSheetController::class, 'simplePDF'])->name('evaluation.simplePDF');


Route::get('download/{id}/{file}','App\Http\Controllers\FileController@download'); 
Route::get('download/doc_admin','App\Http\Controllers\FileController@admin')->name('download.doc_admin');
Route::get('download/doc_editor','App\Http\Controllers\FileController@editor')->name('download.doc_editor');
Route::get('download/doc_student','App\Http\Controllers\FileController@student')->name('download.doc_student');

Route::get('/program','App\Http\Controllers\ProgramController@index')->name('program.index');
Route::get('/vysledky','App\Http\Controllers\ResultController@index')->name('results.index');
Route::get('/{slug}',  'App\Http\Controllers\CmsController@page')->name('cms.page');
