@extends('layouts.app')
@section('panel')
    {{$user->name}}

    @stop
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
                {!! Form::open(['method'=>'GET' ,'action'=>'UserController@credit'])!!}
                    <div class="form-group">
                        {!! Form::submit('Charge Credit', ['class'=>'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}

            </div>
        @endif
        <div class="col-sm-4 col-md-offset-4 form-group row">
            @if(count($menus)>0)
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
                                <tr >
                                    <td >{{$menu->food->name}}</td>
                                    <td>{{$menu->food->category->name}}</td>
                                    <td>{{$menu->food->price}}</td>
                                    <td><img height="70" src="{{$menu->food->photo->first() ? $menu->food->photo->first()->file :'http://placehold.it/200x200'}}" alt=" "></td>
                                    <td>

                                        {!! Form::select($menu->food->id,range(0,20))!!}

                                        {{--{!! Form::select($menu->food->name ,range(0,100),1)!!}--}}

                                        {{--{!! Form::checkbox('foods[]',$menu->food->id)!!}--}}

                                    </td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>

                    <div class="form-group">
                        {!! Form::submit('Buy', ['class'=>'btn btn-primary col-sm-6']) !!}
                    </div>
                {!! Form::close() !!}</td>
            @endif
        </div>
    </div>
    <div class="row">
        @include('includes.form_error')
    </div>
@endsection