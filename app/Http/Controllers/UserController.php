<?php

namespace App\Http\Controllers;

use App\Http\Requests\chargeCredit;
use App\Menu;
use App\Order;
use App\Photo;
use App\Staticmenu;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            Photo::create(
                [
                    'file' => $name,
                    'imageable_id' => $user->id,
                    'imageable_type' => 'App\User'
                ]
            );
        }

        if (Auth::attempt(["email" => $user->email, 'password' => $request->password])) {
            return redirect('user');
        }
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role->name == 'Administrator') {
            $users = User::all();
            return view('admin.users.index', compact('users'));
        } else {
            $today = carbon::today()->dayOfWeek;
            return $this->showMenu($today);
        }
    }

    public function showMenu($day)
    {
        if ($day>6) {
            return $this->index();
        }
        $user = Auth::user();
        $date= carbon::now();
        $orders  = Order::where('user_id', $user->id)->get();
        $can_order= true;
        foreach ($orders as $order) {
            if ($order->created_at->toDateString() == $date->toDateString() and $order->day== $day) {
                $can_order = false;
            }
        }
        $menus = Menu::where('day', $day)->get();
        $stMenus= Staticmenu::all();
        return view(
            'user.index',
            compact('user', 'menus', 'can_order', 'day', 'stMenus')
        );
    }

    public function create()
    {
        return view('user.profile.register');
    }

    public function edit()
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
        }
        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            Photo::create(
                [
                    'file' => $name,
                    'imageable_id' => $user_id,
                    'imageable_type' => 'App\User'
                ]
            );
        }
        $user->update($input);
        $user->save();
        return redirect('user');
    }

    public function destroy()
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $user->delete();
        return redirect('');
    }

    public function credit(ChargeCredit $request)
    {
        $user = Auth::user();
        $user->credit = $user->credit +$request->price;
        $user->save();
        return redirect('user');
    }
    public function editCredit()
    {
        $user = Auth::user();
        return view('user.credit', compact('user'));
    }
}
