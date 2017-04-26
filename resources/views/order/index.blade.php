@extends('layouts.user')
@section('content')

    @if(Session::has("delete_user"))


        <p class="bg-danger">{{Session('delete_user')}}</p>

    @endif
    <h1>Users</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Food</th>
            <th>Price</th>
            <th>Count</th>
        </tr>
        </thead>
        <tbody>
        @if($orders)
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->food->name}}</td>
                    <td>{{$order->food->price}}</td>
                    <td>{{$order->count}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop