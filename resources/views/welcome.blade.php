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
        @endif
        <ul class="w3-ul">
            <li class="w3-green">{{$today}}</li>
        </ul>
        @if(count($nextDays)>0)
            @foreach($nextDays as $nextDay)
                <ul class="w3-ul">
                    <li class="w3-hover-blue">{{$nextDay}}</li>
                </ul>
            @endforeach
        @endif
    </div>

@stop
