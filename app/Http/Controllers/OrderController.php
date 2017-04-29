<?php

namespace App\Http\Controllers;

use App\Http\Middleware\User;
use App\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\PayRequest;
use App\Order;
use App\Food;
use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::where('status','not_pay')->get();
        $user_credit= Auth::user()->credit;
        $total=0;
        foreach ($orders as $order) {
            $total= $total+($order->count * $order->food->price);
        }
        if ($total>0){
             return view ('order.index' , compact('orders','total','user_credit'));
         }else{
            return redirect('user');
         }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::user()->id;
        $old_orders = Order::where('user_id',$user_id)->where('status','not_pay')->get();
        foreach ($old_orders as $order){
            $order->delete();
        }
        $today = carbon::today()->dayOfWeek;
        $menus = Menu::where('day', $today)->get();
        foreach ($menus as $menu) {
            $food = $menu->food;
            if ($input[$food->id]){
              $order = ['food_id'=> $food->id , 'user_id'=>$user_id , 'status'=>"not_pay", 'count'=>(int)$input[$food->id] ];
              Order::create($order);
            }

        }
         return redirect('/order');
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
        //
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
        //
    }


    public function pay()
    {
        $orders = Order::where('status','not_pay')->get();
        $cost=0;
        foreach ($orders as $order) {
            $order->status = 'pay';
            $cost=$cost+($order->food->price * (float)$order->count);
            $order->save();
        }
        $user = Auth::user();
        $user->credit= $user->credit - $cost;
        $user->save();
        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect ('/order');
    }
}
