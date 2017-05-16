<?php

namespace App\Http\Controllers;

use App\Category;
use App\Food;
use App\Photo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminFoodController extends Controller
{
    /**
     * Display a foods list.
     *
     * @return view(admin.foods.create)
     */
    public function index()
    {
        $foods = Food::all();
        return view('admin.foods.index', compact('foods'));
    }

    public function create()
    {
        $category = Category::lists('name', 'id')->all();
        return view('admin.foods.create', compact('category'));
    }

    /**
     * Create a food .
     *
     * @param  Request $request
     * @return redirect('admin/foods')
     */
    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['photo_id']);
        $food = Food::create($input);
        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            Photo::create(
                ['file' => $name,
                    'imageable_id' => $food->id,
                    'imageable_type' => 'App\Food']
            );
        }
        return redirect('admin/foods');
    }

    /**
     * Edit a food .
     *
     * @param  int $id
     * @return view(admin.foods.edit)
     */
    public function edit($id)
    {
        $food = Food::findOrFail($id);
        $category = Category::lists('name', 'id')->all();
        return view('admin.foods.edit', compact('food', 'category'));
    }

    /**
     * Update a food
     *
     * @param  Request $request
     * @param  int $id
     * @return redirect('admin/foods')
     */
    public function update(Request $request, $id)
    {
        $food = Food::find($id);
        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            Photo::create(
                ['file' => $name,
                    'imageable_id' => $id,
                    'imageable_type' => 'App\Food']
            );
        }
        $food->update($request->all());
        $food->save();
        return redirect('admin/foods');
    }

    /**
     * Destroy a food .
     *
     * @param  int $id
     * @return redirect('admin/foods')
     */
    public function destroy($id)
    {
        try {
            $food = Food::findOrFail($id);
            $food->delete();
            Session::flash('delete_food', $food->name . " has been deleted.");

        } catch (QueryException $e) {
            //
            if ($e->getCode() == "23000") {
                Session::flash(
                    'delete_food',
                    $food->name . " has not been deleted."
                );
            }
        }
        return redirect('admin/foods');
    }
}