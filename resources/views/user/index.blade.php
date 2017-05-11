@extends('layouts.app')
@section('home')
    <li><a href="{{ url('/user') }}">Home</a></li>
@endsection

@section('order')
    <li> <a href="{{route("order.show")}}">Paid Orders</a></li>
@endsection

@section('panel')
    {{$user->name}}

@endsection

@section('content')
    <div class= 'row'>
        @if($user)
            <div class="col-md-offset-2 form-group">
                @foreach($user->photo as $photo)
                    <div class="form-group">

                        <img height="100" src="{{$photo ? $photo->file :'http://placehold.it/400x400'}}" alt=" ">

                    </div>
                @endforeach

                Credit: {{$user->credit}}
                 <div class="form-group">
                     <a href="{{route('user.charge.credit')}}" class="form-group btn btn-primary">Charge Credit</a>
                 </div>
            </div>
        @endif

        <div class="col-sm-4 col-md-offset-4 form-group row">
            @if(Session::has("welcome_user"))
                <p class="bg-success">{{Session('welcome_user')}}</p>
            @endif
            @if(count($menus)>0)
                @if ($day==0)
                    <h1>Sunday</h1>
                @elseif ($day==1)
                    <h1>Monday</h1>
                @elseif ($day==2)
                    <h1>Tuesday</h1>
                @elseif ($day==3)
                    <h1>Wednesday</h1>
                @elseif ($day==4)
                    <h1>Thursday</h1>
                @elseif ($day==5)
                    <h1>Friday</h1>
                @elseif ($day==6)
                    <h1>Saturday</h1>
                @endif

                {{--{!! Form::open(['method'=>'POST' ,'action'=>'OrderController@storeStatic'])!!}--}}
                    {{--<table class="table">--}}
                        {{--<thead>--}}
                        {{--<th>All Day</th>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--@foreach($stmenus as $menu)--}}
                            {{--<td><img height="40" src="{{$menu->food->photo->first() ? $menu->food->photo->first()->file :'http://placehold.it/200x200'}}" alt=" "></td>--}}
                            {{--<td class="price">{{$menu->food->price}}$</td>--}}
                            {{--<td >{!! Form::select($menu->food->id,range(0,20),null,array('class'=>'static_menu','price'=>$menu->food->price))!!}</td>--}}

                        {{--@endforeach--}}
                        {{--</tbody>--}}
                    {{--</table>--}}
                    {{--<div class="form-group row">--}}
                        {{--{!! Form::submit('All Day', ['class'=>'btn btn-primary col-sm-2',]) !!}--}}
                    {{--</div>--}}
                {{--{!! Form::close() !!}--}}


                {!! Form::open(['method'=>'POST' ,'action'=>'OrderController@store'])!!}
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Food</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Photo</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td>{{$menu->food->name}}</td>
                                    <td>{{$menu->food->category->name}}</td>
                                    <td class="price">{{$menu->food->price}}$</td>
                                    <td><img height="70" src="{{$menu->food->photo->first() ? $menu->food->photo->first()->file :'http://placehold.it/200x200'}}" alt=" "></td>
                                    @if($can_order)
                                         <td >{!! Form::select($menu->food->id,range(0,20),null,array('class'=>'select_item','price'=>$menu->food->price))!!}</td>
                                    @endif
                                    {{ Form::hidden('day', $day) }}

                                </tr>
                            @endforeach

                            @foreach($stmenus as $menu)
                                <td><img height="40" src="{{$menu->food->photo->first() ? $menu->food->photo->first()->file :'http://placehold.it/200x200'}}" alt=" "></td>
                                <td class="price">{{$menu->food->price}}$</td>
                                @if($can_order)
                                <td >{!! Form::select($menu->food->id,range(0,20),null,array('class'=>'extraF','price'=>$menu->food->price))!!}</td>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group row">
                            {!! Form::submit('Next Day', ['class'=>'btn btn-based col-sm-6 ', 'name' => 'submitbutton']) !!}


                    </div>
                    <div class="form-group row">
                        {!! Form::submit('Pay or Edit',['class'=>'btn btn-primary col-sm-6', 'name' => 'submitbutton']) !!}
                        {!! Form::label("",null,array('class'=>'cost col-sm-6')) !!}
                    </div>
                    <a  class="orderList form-group row">Order List</a>

                {!! Form::close() !!}
             @endif
            <table  class="table" id="table_show"></table>
            <h1 class="order_status"></h1>
        </div>

    </div>

    <div class="row">
         @include('includes.form_error')
    </div>


@endsection

@section('script')
    <script src='/js/main.js'></script>
@endsection