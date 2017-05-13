<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Menu;
use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        Session::flash('welcome_user', $user->name ." welcome.");
        return redirect('/user');

    }

}
