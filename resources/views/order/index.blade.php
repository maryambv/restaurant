@extends('layouts.user')
@section('content')

    <h1>Order</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Food</th>
            <th>Count</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        @if($orders)
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->food->name}}</td>
                    <td>{{$order->count}}</td>
                    <td>{{$order->count * $order->food->price}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <h2>Total: {{$total}}</h2>

@stop