@extends('layouts.admin')
@section('content')
    <h1>Static Menu</h1>


    <div class="col-sm-2">

        @if($static_menus)
            <table class="table">
                <thead>

                <tr>
                    <th>Id</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($static_menus as $menu)
                    <tr>
                        <td>{{$menu->id}}</td>
                        <td>{{$menu->food->name}}</td>
                        <td>
                            {!! Form::open(['method'=>'DELETE' ,'action'=>['AdminStaticMenuController@destroy', $menu->id]])!!}
                            <div class="form-group">
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                            </div>
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif


    </div>


    <div class="col-sm-6">

        @if($foods)
            {!! Form::open(['method'=>'POST' ,'action'=>'AdminStaticMenuController@store'])!!}
            <div class="form-group col-sm-3">
                {!! Form::select ('food_id',$foods, null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-sm-3">
                {!! Form::submit('Add', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}

        @endif


    </div>



@endsection