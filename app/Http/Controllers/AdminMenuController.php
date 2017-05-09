<?php

namespace App\Http\Controllers;

use App\Food;
use App\Menu;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class AdminMenuController extends Controller
{
    public function index()
    {
        $foods=Food::lists('name','id');
        $menus=Menu::orderBy('day')->get();


        return view('admin.menus.index',compact('foods','menus'));
    }

    public function store(Request $request)
    {
        $menus = DB::select('select * from menus where food_id = ? and day =?', [$request->food_id ,$request->day ]);
        if (count($menus) ==0){
            Menu::create($request->all());
        }
        return redirect('admin/menu');
    }

    public function edit($id)
    {
        $menu=Menu::findOrFail($id);
        $foods=Food::lists('name','id')->all();
        return view('admin.menus.edit',compact('menu','foods'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menus = DB::select('select * from menus where food_id = ? and day =?', [$request->food_id ,$request->day ]);
        if (count($menus) ==0) {
            $menu->update($request->all());
            $menu->save();
        }else{
            $menu->delete();
        }
        return redirect('admin/menu');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect('admin/menu');
    }
}
