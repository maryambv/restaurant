<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Menu;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role->name == 'Administrator') {
            $users=User::all();
            return view('admin.users.index',compact('users'));

        }else{

            $today = carbon::today()->dayOfWeek;
            $menus = Menu::where('day', $today)->get();
            return view('user.index', compact('user', 'menus'));

        }

    }
}
