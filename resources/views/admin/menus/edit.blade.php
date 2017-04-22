@extends('layouts.admin')
@section('content')
    <h1>Menus</h1>

    <div class="col-sm-6">
        {!! Form::model($menu,['method'=>'PATCH' ,'action'=>['AdminMenuController@update',$menu->id]])!!}
        <div class="form-group">
            {!! Form::label('food_id', 'Name: ') !!}
            {!! Form::select('food_id',$foods, null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::select ('day',array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'), null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Edit Menu', ['class'=>'btn btn-primary col-sm-6']) !!}
        </div>

        {!! Form::close() !!}


        {!! Form::open(['method'=>'DELETE' ,'action'=>['AdminMenuController@destroy', $menu->id]])!!}

        <div class="form-group">
            {!! Form::submit('Delete Menu', ['class'=>'btn btn-danger col-sm-6']) !!}
        </div>

        {!! Form::close() !!}
    </div>


@endsection