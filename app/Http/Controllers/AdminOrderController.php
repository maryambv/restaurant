<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\Calendar\MyCalendar;

use App\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $FmyFunctions1 = new MyCalendar;
        return $FmyFunctions1->today();
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }
}
