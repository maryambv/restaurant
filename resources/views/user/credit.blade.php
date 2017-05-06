@extends('layouts.app')
@section('home')
    <li><a href="{{ url('/user') }}">Home</a></li>
@endsection

@section('order')
    <li> <a href="{{route("order.show")}}" class="order">Orders</a></li>
@endsection

@section('panel')
    {{$user->name}}

@endsection

@section('content')
    <div class="col-sm-6 col-lg-offset-3 row" >
        {!! Form::open(['method'=>'POST' ,'action'=>'UserController@credit'])!!}
                <div class="form-group">
                    {!! Form::label('price', 'Charge: ') !!}
                    {!! Form::number('price',null,['class' => 'form-control','step'=>'any']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add Credit', ['class'=>'btn btn-primary']) !!}
                </div>

        {!! Form::close() !!}
    </div>
    <div class="col-sm-6 col-lg-offset-3 row">
        @include('includes.form_error')
    </div>
@endsection