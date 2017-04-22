@extends('layouts.app')
@section('content')
    <div class="col-md-8 col-md-offset-2">

        <h1>Edit User</h1>

    </div>

    <div class="row">

        <div class="col-md-8 col-md-offset-2 col-sm-2">
            {!! Form::label( 'Photo: ') !!}
            @foreach($user->photo as $photo)
                <div class="form-group">

                    {!! Form::open(['method'=>'DELETE' ,'action'=>['AdminMediaController@destroy', $photo->id]])!!}

                    <img height="100" src="{{$photo ? $photo->file :'http://placehold.it/400x400'}}" alt=" ">
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                    {!! Form::close() !!}
                </div>
            @endforeach
        </div>

        <div class="col-md-8 col-md-offset-2 col-sm-9">
            {!! Form::model($user,['method'=>'PUT' ,'action'=>['UserController@update',$user->id],'files'=>true])!!}

            <div class=" col-md-8 col-md-offset-2 form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="col-md-8 col-md-offset-2 form-group">
                {!! Form::label('email', 'Email: ') !!}
                {!! Form::email ('email', null, ['class'=>'form-control']) !!}
            </div>

            <div class="col-md-8 col-md-offset-2 form-group">
                {!! Form::label('password', 'Password: ') !!}
                {!! Form::password ('password', ['class'=>'form-control']) !!}
            </div>


            <div class="col-md-8 col-md-offset-2 form-group">
                <input name="photo_id" type="file" accept="image/*" onchange="loadFile(event)">
                {!! Form::label('photo_id', 'Photo: ') !!}
                <img height="50" id="photo_id"/>
                <script>
                    var loadFile = function(event) {
                        var output = document.getElementById('photo_id');
                        output.src = URL.createObjectURL(event.target.files[0]);
                    };
                </script>
            </div>

            <div class="col-md-8 col-md-offset-2 form-group">
                {!! Form::submit('Edit User', ['class'=>'btn btn-primary col-sm-6']) !!}
            </div>

            {!! Form::close() !!}


            {!! Form::open(['method'=>'DELETE' ,'action'=>['UserController@destroy',$user->id]])!!}

            <div class="col-md-8 col-md-offset-2 form-group">
                {!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-6']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        @include('includes.form_error')
    </div>

@endsection