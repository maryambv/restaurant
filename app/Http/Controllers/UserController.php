<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Order;
use App\Photo;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function store(Request $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        unset($input['photo_id']);
        $input['role_id'] = 2;
        $user = User::create($input);

        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            Photo::create(['file' => $name, 'imageable_id' => $user->id, 'imageable_type' => 'App\User']);
        }

        if (Auth::attempt(["email" => $user->email, 'password' => $request->password])) {
            return redirect('user');
        }
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role->name == 'Administrator') {

            $users=User::all();
            return view('admin.users.index',compact('users'));
        }
        else{
           $today = carbon::today()->dayOfWeek;
           return $this->show_menu($today);
        }
    }

    public function show_menu($day)
    {
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

    public function create()
    {
        return view('user.profile.register');
    }


    public function edit()
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        return view('user.profile.edit', compact('user'));
    }


    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
        }
        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            Photo::create(['file' => $name, 'imageable_id' => $user_id, 'imageable_type' => 'App\User']);
        }
        $user->update($input);
        $user->save();
        return redirect('user');
    }


    public function destroy()
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $user->delete();
        return redirect('');
    }
    public function credit()
    {
        $user = Auth::user();
        $user->credit = $user->credit +100;
        $user->save();
        return redirect('user');

    }
}
