@extends('layouts.app')
@section('content')
    <div class="col-md-offset-2 form-group">
        <h1>Order</h1>
        @if(count($orders)>0)
            <table class="table">
                <thead>
                <tr>
                    <th>Food</th>
                    <th>Count</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>

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
                </tbody>
            </table>
        @else
            <p>Not ordered</p>
        @endif
    </div>
    <div class="row">
        @include('includes.form_error')
    </div>
@stop
