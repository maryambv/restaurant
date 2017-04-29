<?php

namespace App\Http\Controllers;

use App\Category;
use App\Food;
use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods=Food::all();
        return view('admin.foods.index',compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::lists('name','id')->all();
        return view('admin.foods.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $input=$request->all();
            unset($input['photo_id']);
            $food=Food::create($input);
            if($file=$request->file('photo_id')){
                $name=time().$file->getClientOriginalName();
                $file->move('images',$name);
                Photo::create(['file'=>$name,'imageable_id'=>$food->id ,'imageable_type'=>'App\Food']);
            }
            return redirect('admin/foods');
   }


    public function edit($id)
    {
        $food=Food::findOrFail($id);
        $category=Category::lists('name','id')->all();
        return view('admin.foods.edit',compact('food','category'));
    }

    public function update(Request $request, $id)
    {
        $food = Food::find($id);
        if ($file =$request->file('photo_id')) {
            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            Photo::create(['file'=>$name,'imageable_id'=>$id ,'imageable_type'=>'App\Food']);
        }
        $food->update($request->all());
        $food->save();
        return redirect('admin/foods');
    }

    public function destroy($id)
    {
        $food= Food::findOrFail($id);
        $food->delete();
        return redirect('admin/foods');
    }
}
