@extends('layouts.admin')
@section('content')
    <h1>Menu</h1>


    <div class="col-sm-6">

        @if($menus)
            <table class="table">
                <thead>

                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>day</th>
                </tr>
                </thead>
                <tbody>
                @foreach($menus as $menu)
                    <tr>
                        <td>{{$menu->id}}</td>
                        <td><a href="{{route('admin.menu.edit', $menu->id)}}">{{$menu->food->name}}</a></td>
                        <td>{{$menu->day}}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        @endif


    </div>


    <div class="col-sm-6">

        @if($foods)
            {!! Form::open(['method'=>'POST' ,'action'=>'AdminMenuController@store'])!!}
            <div class="form-group col-sm-3">
                {!! Form::select ('food_id',$foods, null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group col-sm-3">
                {!! Form::select ('day',array('sat'=>'sat','sun'=>'sun','mon'=>'mon'), null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-sm-3">
                {!! Form::submit('Add', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}

        @endif


    </div>



@endsection