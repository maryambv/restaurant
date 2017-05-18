@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <div class="col-md-offset-2 form-group w3-container">
        @if(count($passDays)>0)
            @foreach($passDays as $passDay)
                <ul class="w3-ul">
                    <li class="w3-hover-red">{{$passDay}}</li>
                </ul>
            @endforeach
            <p class="w3-hover-blue">{{$today}}</p>
        @endif
    </div>

@stop
