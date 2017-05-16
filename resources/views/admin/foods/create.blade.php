@extends('layouts.admin')
@section('content')

    <h1>Create Foods </h1>

    {!! Form::open(['method'=>'POST' ,'action'=>'AdminFoodController@store','files'=>true])!!}

    <div class="form-group">
        {!! Form::label('name', 'Name: ') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('price', 'Price: ') !!}
        {!! Form::number('price',null,['class' => 'form-control','step'=>'any']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('category_id', 'Category: ') !!}
        {!! Form::select ('category_id',$category, null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <input name="photo_id" type="file" accept="image/*" onchange="loadFile(event)">
        {!! Form::label('photo_id', 'Photo: ') !!}
        <img height="50" id="photo_id"/>
        <script>
            var loadFile = function (event) {
                var output = document.getElementById('photo_id');
                output.src = URL.createObjectURL(event.target.files[0]);
            };
        </script>
    </div>

    <div class="form-group">
        {!! Form::submit('Create Food', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    @include('includes.form_error')



@endsection