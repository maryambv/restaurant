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

    public function store(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::user()->id;
        $old_orders = Order::where('user_id',$user_id)->where('status','not_pay')->get();
        foreach ($old_orders as $order){
            $order->delete();
        }
        $menus = Menu::where('day', $input['day'])->get();
        foreach ($menus as $menu) {
            $food = $menu->food;
            if ($input[$food->id]){
                $order = ['food_id'=> $food->id , 'user_id'=>$user_id , 'status'=>"not_pay", 'count'=>(int)$input[$food->id] ,'day'=>$input['day']];
                Order::create($order);
            }

        }
         return redirect('/order');
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

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect ('/order');
    }

    public function menu(){

        $user=Auth::user()->name;
        $tomorrow = carbon::tomorrow()->dayOfWeek;
        $menus = Menu::where('day', $tomorrow)->get();
        return view('user.menu.index',compact('user','menus'));
    }


    public function showOrder(){
        $user_id=Auth::user()->id;
        $orders= Order::where('user_id',$user_id)->with(["food"])->get();
        return $orders;
    }
}
