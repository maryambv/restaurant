@extends('layouts.admin')
@section('content')

    <h1>Orders</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Count</th>
            <th>Food</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        @if($orders)
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->count}}</td>
                    <td>{{$order->food->name}}</td>
                    <td>{{$order->created_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop