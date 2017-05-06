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
        if ($user->role->name == 'Administrator') {

            $users=User::all();
            return view('admin.users.index',compact('users'));

        }else{
            $today = carbon::today()->dayOfWeek;
            Session::flash('welcome_user',$user->name ." welcome.");
            return $this->show_menu($today);

        }
    }
    public function show_menu($day){
        $user = Auth::user();
        $date= carbon::now();
        $orders  = Order::where('status','pay')->where('user_id',$user->id)->get();
        $can_order= true;
        foreach ($orders as $order) {
            if ($order->created_at->toDateString() == $date->toDateString()) {
                $can_order = false;
            }
        }
        $menus = Menu::where('day', $day)->get();

        return view('user.index', compact('user', 'menus','can_order','day'));
    }
}
