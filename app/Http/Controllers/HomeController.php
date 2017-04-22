<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $today = carbon::today()->dayOfWeek;
        $menus = Menu::where('day', $today)->get();
        return view('user.index', compact('user', 'menus'));
    }
}
