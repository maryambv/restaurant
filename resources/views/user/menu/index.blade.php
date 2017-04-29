@extends('layouts.app')
@section('panel')
    {{$user}}
@stop

@section('content')
    @if(count($menus)>0)
        <div class="col-sm-4 col-md-offset-4 form-group row">
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
                            <td>{{$menu->food->price}}</td>
                            <td><img height="70" src="{{$menu->food->photo->first() ? $menu->food->photo->first()->file :'http://placehold.it/200x200'}}" alt=" "></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @endif

@stop