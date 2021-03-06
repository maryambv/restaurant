@extends('layouts.app')

@section('home')
    <li><a href="{{ url('/user') }}">Home</a></li>
@endsection
@section('order')
    <li><a href="{{route("order.show")}}">Paid Orders</a></li>
@endsection
@section('content')
    <div class="col-md-offset-2 form-group">
        <h1>Not Paid Order</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Food</th>
                <th>Count</th>
                <th>Day</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            @if($orders)
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->food->name}}</td>
                        <td>{{$order->count}}</td>
                        <td> @if ($order->day==0)
                                یکشنبه
                            @elseif ($order->day==1)
                                دوشنبه
                            @elseif ($order->day==2)
                                سه شنبه
                            @elseif ($order->day==3)
                                چهاشنبه
                            @elseif ($order->day==4)
                                پنجشنبه
                            @elseif ($order->day==5)
                                جمعه
                            @elseif ($order->day==6)
                                شنبه
                            @endif</td>
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
        <h2> Total: {{$totalCost}}</h2>
        <h2> Your credit: {{$user_credit}}</h2>
        @if($user_credit - $totalCost>0)

            {!! Form::open(['method'=>'POST' ,'action'=>'OrderController@pay' , 'class'=>'order_add'])!!}
            <div class="form-group">
                {!! Form::submit('Pay', ['class'=>'btn btn-primary col-sm-6']) !!}
            </div>
            {!! Form::close() !!}
        @else
            <div class="form-group">
                <a href="{{route('user.charge.credit')}}" class="form-group btn btn-primary">Charge Credit</a>
            </div>
        @endif
    </div>




    <div class="row">
        @include('includes.form_error')
    </div>
@stop
@section('script')
    <script src='js/main.js'></script>
@endsection