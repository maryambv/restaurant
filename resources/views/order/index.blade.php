@extends('layouts.app')
@section('content')
    <div class="col-md-offset-2 form-group">
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
                        <td>
                            {!! Form::open(['method'=>'DELETE' ,'action'=>['OrderController@destroy',$order->id]])!!}
                                <div class="form-group">
                                    {!! Form::submit('Delete', ['class'=>'btn btn-danger col-sm-6']) !!}
                                </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <h2> Total: {{$total}}</h2>
        <h2> Your credit: {{$user_credit}}</h2>
       @if($user_credit - $total>0)

            {!! Form::open(['method'=>'POST' ,'action'=>'OrderController@pay'])!!}
                <div class="form-group">
                    {!! Form::submit('Pay', ['class'=>'btn btn-primary col-sm-6']) !!}
                </div>
            {!! Form::close() !!}
        @else
            {!! Form::open(['method'=>'GET' ,'action'=>'UserController@credit'])!!}
            <div class="form-group">
                {!! Form::submit('Charge', ['class'=>'btn btn-danger col-sm-2']) !!}
            </div>
            {!! Form::close() !!}
        @endif
    </div>
    <div class="row">
        @include('includes.form_error')
    </div>
@stop