<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminMediaController extends Controller
{

    public function index()
    {

        $photos=Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $file=$request->file('file');
        $name= time().$file->getClientOriginalName();
        $file->move('images', $name);
        Photo::create(['file'=>$name]);

    }

    public function destroy($id)
    {
        $photo=Photo::find($id);
        unlink(public_path().$photo->file);
        $photo->delete();
        $user = Auth::user();
        if ($user->role->name == 'Administrator') {

             return redirect('admin/media');
        } else {
            return redirect('user');
        }
        
    }
}