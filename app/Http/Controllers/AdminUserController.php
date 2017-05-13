<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminUserController extends Controller
{
    public function index()
    {
        $users=User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles=Role::lists('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(AdminUserRequest $request)
    {
        $input=$request->all();
        $input['password']=bcrypt($request->password);
        unset($input['photo_id']);
        $user=User::create($input);

        if ($file=$request->file('photo_id')) {
            $name=time().$file->getClientOriginalName();
            $file->move('images', $name);
            Photo::create(
                [
                    'file'=>$name,
                    'imageable_id'=>$user->id,
                    'imageable_type'=>'App\User'
                ]
            );
        }

        return redirect('admin/users');
    }

    public function edit($id)
    {
        $user=User::findOrFail($id);
        $roles=Role::lists('name', 'id')->all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (trim($request->password)=='') {
            $input=$request->except('password');
        } else {
            $input = $request->all();
        }

        if ($file =$request->file('photo_id')) {

            $name=time().$file->getClientOriginalName();
            $file->move('images', $name);
            Photo::create(
                [
                    'file'=>$name,
                    'imageable_id'=>$id,
                    'imageable_type'=>'App\User'
                ]
            );
        }
        $user->update($input);
        $user->save();
        return redirect('admin/users');
    }

    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return redirect('admin/users');    
    }
}
