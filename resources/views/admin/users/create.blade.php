@extends('layouts.admin')
@section('content')

    <h1>Create Users </h1>

    {!! Form::open(['method'=>'POST' ,'action'=>'AdminUserController@store','files'=>true])!!}

    <div class="form-group">
        {!! Form::label('name', 'Name: ') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email: ') !!}
        {!! Form::email ('email', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password: ') !!}
        {!! Form::password ('password', ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('role_id', 'Role: ') !!}
        {!! Form::select ('role_id',array(''=>'Choose Option')+$roles, null, ['class'=>'form-control']) !!}
    </div>



    <div class="form-group">
        <input name="photo_id" type="file" accept="image/*" onchange="loadFile(event)">
        {!! Form::label('photo_id', 'Photo: ') !!}
        <img height="50" id="photo_id"/>
        <script>
            var loadFile = function(event) {
                var output = document.getElementById('photo_id');
                output.src = URL.createObjectURL(event.target.files[0])
            }
        </script>
    </div>

    <div class="form-group">
        {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    @include('includes.form_error')



@endsection