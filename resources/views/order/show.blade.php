@extends('layouts.app')
@section('home')
    <li><a href="{{ url('/user') }}">Home</a></li>
@endsection


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
                    <th>Day</th>
                    <th>Order date</th>
                </tr>
                </thead>
                <tbody>

                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->food->name}}</td>
                            <td>{{$order->count}}</td>
                            <td>{{$order->count * $order->food->price}}</td>
                            <td>
                                @if ($order->day===0)
                                    Sunday
                                @elseif ($order->day==1)
                                    Monday
                                @elseif ($order->day==2)
                                    Tuesday
                                @elseif ($order->day==3)
                                    Wednesday
                                @elseif ($order->day==4)
                                    Thursday
                                @elseif ($order->day==5)
                                    Friday
                                @elseif ($order->day==6)
                                    Saturday
                                @endif
                            </td>
                            <td>{{$order->created_at->diffForHumans()}}</td>
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
