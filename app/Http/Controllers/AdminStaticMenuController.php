<?php

namespace App\Http\Controllers;

use App\Food;
use App\Staticmenu;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class AdminStaticMenuController extends Controller
{
    public function index()
    {
        $foods = Food::lists('name', 'id');
        $static_menus = Staticmenu::all();
        return view('admin.menus.static', compact('foods', 'static_menus'));
    }

    public function store(Request $request)
    {
        $menus = Staticmenu::where('food_id', $request->food_id)->get();
        if (count($menus) == 0) {
            Staticmenu::create($request->all());
        }
        return redirect('admin/static/menu');
    }

    public function destroy($id)
    {
        Staticmenu::findOrFail($id)->delete();
        return redirect('admin/static/menu');
    }
}
