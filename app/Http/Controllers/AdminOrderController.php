<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;

class AdminOrderController extends Controller
{
  public function index(){
  	$orders = Order::all();
  	return view('admin.orders.index',compact('orders'));
  }
}
