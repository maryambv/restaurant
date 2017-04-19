@extends('layouts.admin')
@section('content')

    <h1>Foods</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Create</th>
            <th>Update</th>
        </tr>
        </thead>
        <tbody>
        @if($foods)
            @foreach($foods as $food)
                <tr>
                    <td>{{$food->id}}</td>
                    <td><img height="50" src="{{$food->photo->first() ? $food->photo->first()->file :'http://placehold.it/400x400'}}" alt=" "></td>
                    <td><a href="{{route('admin.foods.edit', $food->id)}}">{{$food->name}}</a></td>
                    <td>{{$food->category->name}}</td>
                    <td>{{$food->price}}</td>
                    <td>{{$food->created_at->diffForHumans()}}</td>
                    <td>{{$food->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop