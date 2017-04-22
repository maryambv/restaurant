<?php

namespace App\Http\Controllers;

use App\Menu;
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
        $today = carbon::today()->dayOfWeek;
        $menus =Menu::where('day', $today)->get();
        return view('user.index',compact('user', 'menus'));
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
        return redirect('user');
    }

}
