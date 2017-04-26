@extends('layouts.app')
@section('content')

    @if($user)
        <div class="col-md-offset-2 form-group ">

            <h1><a href="{{route('user.edit', $user->id)}}">{{$user->name}}</a></h1>

        </div>

        <div class="col-md-offset-2 form-group">
            @foreach($user->photo as $photo)
                <div class="form-group">

                    <img height="100" src="{{$photo ? $photo->file :'http://placehold.it/400x400'}}" alt=" ">

                </div>
            @endforeach
        </div>
    @endif
    <div class="col-sm-4 col-md-offset-2 form-group">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Photo</th>
                <th>select</th>
            </tr>
            </thead>
            <tbody>
            @if($menus)
                {!! Form::open(['method'=>'POST' ,'action'=>'OrderController@store'])!!}
                    @foreach($menus as $menu)
                        <tr >
                            <td >{{$menu->food->name}}</td>
                            <td>{{$menu->food->price}}</td>
                            <td><img height="70" src="{{$menu->food->photo->first() ? $menu->food->photo->first()->file :'http://placehold.it/200x200'}}" alt=" "></td>
                            <td>

                                {!! Form::select($menu->food->name ,range(0,100))!!}

                                {!! Form::checkbox('foods[]',$menu->food->id)!!}
                                    
                            </td>    
                        </tr>
                    @endforeach
                    <div class="form-group">
                        {!! Form::submit('Buy', ['class'=>'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}</td>              
            @endif
            </tbody>
        </table>
    </div>

@endsection