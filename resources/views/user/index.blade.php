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

    <table class="table col-md-offset-2">
        <thead>
        <tr>

            <th>Name</th>
            <th>Photo</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        @if($menus)
            @foreach($menus as $menu)
                <tr >
                    <td class="col-sm-1">{{$menu->food->name}}</td>
                    <td class="col-sm-1"><img height="150" src="{{$menu->food->photo->first() ? $menu->food->photo->first()->file :'http://placehold.it/400x400'}}" alt=" "></td>
                    <td class="col-sm-1">{{$menu->food->price}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection