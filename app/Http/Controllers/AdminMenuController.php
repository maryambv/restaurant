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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods=Food::lists('name','id');
        $menus=Menu::orderBy('day')->get();

        return view('admin.menus.index',compact('foods','menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menus = DB::select('select * from menus where food_id = ? and day =?', [$request->food_id ,$request->day ]);
        if (count($menus) ==0){
            Menu::create($request->all());
        }
        return redirect('admin/menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu=Menu::findOrFail($id);
        $foods=Food::lists('name','id')->all();
        return view('admin.menus.edit',compact('menu','foods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect('admin/menu');
    }
}
