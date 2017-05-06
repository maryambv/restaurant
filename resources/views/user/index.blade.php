@extends('layouts.app')
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
                     <a href="{{route('user.credit')}}" class="form-group btn btn-primary">Charge Credit</a>
                 </div>


            </div>
        @endif

        <div class="col-sm-4 col-md-offset-4 form-group row">
            @if(count($menus)>0)
                <h1 class="form-group row">Today</h1>
                 {!! Form::open(['method'=>'POST' ,'action'=>'OrderController@store'])!!}
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Food</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Photo</th>
                            <th>select</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td>{{$menu->food->name}}</td>
                                    <td>{{$menu->food->category->name}}</td>
                                    <td class="price">{{$menu->food->price}}</td>
                                    <td><img height="70" src="{{$menu->food->photo->first() ? $menu->food->photo->first()->file :'http://placehold.it/200x200'}}" alt=" "></td>
                                    <td >{!! Form::select($menu->food->id,range(0,20),null,array('class'=>'select_item','price'=>$menu->food->price))!!}</td>
                                    {{ Form::hidden('day', $day) }}

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($can_order)
                        <div class="form-group row">
                            {!! Form::submit('Next Day', ['class'=>'btn btn-based col-sm-6 ', 'name' => 'submitbutton']) !!}

                            {!! Form::label("",null,array('class'=>'cost')) !!}
                         </div>
                        <div class="form-group row">
                            {!! Form::submit('Buy', ['class'=>'btn btn-primary col-sm-6', 'name' => 'submitbutton']) !!}
                        </div>
                    <a  class="order btn btn-default form-group row">Order List</a>
                    @endif
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