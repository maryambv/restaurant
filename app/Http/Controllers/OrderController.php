<?php

namespace App\Http\Controllers;

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
        $total=0;
        foreach ($orders as $order) {
            $total= $total+($order->count * $order->food->price);
        }
        if ($total>0){
             return view ('order.index' , compact('orders','total'));
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
    public function store(PayRequest $request)
    {
        $input = $request->all();
        $user_id = Auth::user()->id;
        foreach ($input['foods'] as $key) {
            $food = food::findOrFail( $key );
            $order = ['food_id'=> $key , 'user_id'=>$user_id , 'status'=>"not_pay", 'count'=>(int)$input[$food->name] ];
            Order::create($order);
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
        $orders = Order::all();
        foreach ($orders as $order) {
            $order->status = 'pay';
            $order->save();
        }
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
