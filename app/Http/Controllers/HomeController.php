<?php

namespace App\Http\Controllers;


use App\Utils\Calendar\Day;
use App\Utils\Calendar\MyCalendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        Session::flash('welcome_user', $user->name . " welcome.");
        return redirect('/user');
    }

    public function showDate()
    {
        $day =new Day('w');
        return $day->today();
//        $myCalendar = new MyCalendar;
//        $passDays = $myCalendar->weekDays();
//        $today = $myCalendar->today();
//        return view('welcome', compact('passDays', 'today'));
    }

}
