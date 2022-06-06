<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\University;
use App\Models\Section_start;
use App\Models\Section_final;
use App\Models\FirstTitle;
use App\Models\SecondTitle;
use App\Models\Faculty;
use App\Models\User;
use App\Models\Conference;
use App\Models\Country;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function defaultPassword(){
        return 'password';
    }

    protected function listUniversities(){
        $universities = University::orderBy('name', 'asc')->get();
        $listUniversities = [];
        foreach($universities as $u){
          $listUniversities[$u->id] = $u->name;
        }
        return $listUniversities;
    }

    protected function listSectionStart(){
        $actual = Conference::max('id');
        $sectionStart = Section_start::where('conf_id',$actual)->orderBy('name', 'asc')->get();
        $listSectionStart = [];
        foreach($sectionStart as $s){
          $listSectionStart[$s->id] = $s->name;
        }
        return $listSectionStart;
    }

    protected function listSectionFinal(){
      $actual = Conference::max('id');
      $sectionFinal = Section_final::where('conf_id',$actual)->orderBy('name', 'asc')->get();
      $listSectionFinal = [];
      foreach($sectionFinal as $s){
        $listSectionFinal[$s->id] = $s->name;
      }
      return $listSectionFinal;
    }

    protected function listCountries(){
      $Countries = Country::orderBy('country', 'asc')->get();
      $listCountries = [];
      foreach($Countries as $s){
        $listCountries[$s->id] = $s->country;
      }
      return $listCountries;
    }

    protected function listTitles(){
        $title = FirstTitle::orderBy('title', 'asc')->get();
        $listTitles = [null];
        foreach($title as $t){
          $listTitles[$t->id] = $t->title;
        }
        return $listTitles;
    }

    protected function listTitles2(){
        $title = SecondTitle::orderBy('title', 'asc')->get();
        $listTitles2 = [null];
        foreach($title as $t){
          $listTitles2[$t->id] = $t->title;
        }
        return $listTitles2;
  }

    protected function listSchools(){
        $school = Faculty::orderBy('name', 'asc')->get();
        $listSchools = [];
        foreach($school as $s){
          $listSchools[$s->id] = $s->name;
        }
        return $listSchools;
    }
  
    protected function listEditors(){
        $editors = User::whereIn('role', [1, 2])->orderBy('surname','asc')->get();
        $listEditors = [];
        foreach($editors as $e){
          $listEditors[$e->id] = $e->name .' '. $e->surname;
        }
        return $listEditors;
    }

  public function startLectures() {
    $time[] = '09:00 &ndash; 09:15';
    $time[] = '09:15 &ndash; 09:30';
    $time[] = '09:30 &ndash; 09:45';
    $time[] = '09:45 &ndash; 10:00';
    $time[] = '10:00 &ndash; 10:15';
    $time[] = '10:15 &ndash; 10:30';
    $time[] = '10:30 &ndash; 10:45';
    $time[] = '10:45 &ndash; 11:00';
    $time[] = '11:00 &ndash; 11:15';
    $time[] = '11:15 &ndash; 11:30';
    $time[] = '11:30 &ndash; 11:45';
    $time[] = '11:45 &ndash; 12:00';
    $time[] = '12:00 &ndash; 12:15';
    $time[] = '12:15 &ndash; 12:30';
    $time[] = '12:30 &ndash; 12:45';
    $time[] = '12:45 &ndash; 13:00';
    $time[] = '13:00 &ndash; 13:15';
    $time[] = '13:15 &ndash; 13:30';
    $time[] = '13:30 &ndash; 13:45';
    $time[] = '13:45 &ndash; 14:00';
    $time[] = '14:00 &ndash; 14:15';
    $time[] = '14:15 &ndash; 14:30';
    $time[] = '14:30 &ndash; 14:45';
    $time[] = '14:45 &ndash; 15:00';
    $time[] = '15:00 &ndash; 15:15';
    $time[] = '15:15 &ndash; 15:30';
    $time[] = '15:30 &ndash; 15:45';
    $time[] = '15:45 &ndash; 16:00';

    return $time;
  }

}
