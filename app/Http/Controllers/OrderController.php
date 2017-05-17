<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Staticmenu;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where(
            [
                ['status', 'not_pay'],
                ['user_id', $user->id]
            ]
        )->orderBy('day')->get();
        $user_credit = $user->credit;
        $totalCost = $this->getTotalCost();
        if ($totalCost > 0) {
            return view('order.index', compact('orders', 'totalCost', 'user_credit'));
        }
        return $this->show();
    }

    public function store(Request $request)
    {
        $status = $request->submitbutton;
        $input = $request->all();
        $user_id = Auth::id();
        $menus = Menu::where('day', $input['day'])->get();
        $staticMenus = Staticmenu::all();
        $order = Order::where(
            [
                ['day', $input['day']],
                ['user_id', $user_id]
            ]
        )->get();

        if (count($order) == 0) {
            foreach ($menus as $menu) {
                $food = $menu->food;
                if ($input[$food->id]) {
                    Order::where(
                        [
                            ['user_id', $user_id],
                            ['day', $input['day']]
                        ]
                    )->delete();
                    $order = [
                        'food_id' => $food->id,
                        'user_id' => $user_id,
                        'status' => "not_pay",
                        'count' => (int)$input[$food->id],
                        'day' => $input['day']
                    ];
                    Order::create($order);
                }
            }
            foreach ($staticMenus as $menu) {
                $food = $menu->food;
                if ($input[$food->id]) {
                    Order::where(
                        [
                            ['user_id', $user_id],
                            ['food_id', $food->id],
                            ['day', $input['day']]
                        ]
                    )->delete();
                    $order = [
                        'food_id' => $food->id,
                        'user_id' => $user_id,
                        'status' => "not_pay",
                        'count' => (int)$input[$food->id],
                        'day' => $input['day']
                    ];
                    Order::create($order);
                }
            }
        }
        if ($status == 'Next Day') {
            $day = ($input['day'] + 1) % 7;
            return redirect('/user/menu/' . $day);
        }
        return redirect('/order');
    }

    public function pay()
    {
        $orders = Order::where('status', 'not_pay')->get();
        $cost = 0;
        foreach ($orders as $order) {
            $order->status = 'pay';
            $cost = $cost + ($order->food->price * (float)$order->count);
            $order->save();
        }
        $user = Auth::user();
        $user->credit = $user->credit - $cost;
        $user->save();
        return redirect('/user');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect('/order');
    }

    public function showOrder()
    {
        $user_id = Auth::user()->id;
        $orders = Order::where(
            [
                ['user_id', $user_id],
                ['status', 'not_pay']
            ]
        )->with(["food"])->orderBy('day')->get();
        return $orders;
    }

    public function getTotalCost()
    {
        $user_id = Auth::user()->id;
        $not_pay_orders = Order::where(
            [
                ['status', 'not_pay'],
                ['user_id', $user_id]
            ]
        )->get();
        $total = 0;
        foreach ($not_pay_orders as $order) {
            $total += ($order->count * $order->food->price);
        }
        return $total;
    }

    public function show()
    {
        $user_id = Auth::user()->id;
        $orders = Order::where(
            [
                ['status', 'pay'],
                ['user_id', $user_id]
            ]
        )->orderBy('day')->get();
        return view('order.show', compact('orders'));
    }
}
