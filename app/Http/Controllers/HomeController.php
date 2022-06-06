<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conference;

use \Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Conference::max('id');
        $name = Conference::where('id',$id)->value('name');
        $order = Conference::where('id',$id)->value('order');
        $reg_start = Conference::where('id',$id)->value('reg_start');
        $reg_start = \Carbon\Carbon::createFromFormat('Y-m-d', $reg_start)->format('d.m.Y');
        $reg_end = Conference::where('id',$id)->value('reg_end');
        $reg_end = \Carbon\Carbon::createFromFormat('Y-m-d', $reg_end)->format('d.m.Y');
        return view('home',['users'=>User::all()])
        ->with('name',$name)
        ->with('order',$order)
        ->with('reg_start',$reg_start)
        ->with('reg_end',$reg_end);
    }
}
