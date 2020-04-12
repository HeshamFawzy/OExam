@extends('layouts.app')

@section('content')
@foreach($questions as $key => $question)
<div class="container card-body" style="background-color: white;">
    @if($key%4 == 0)
    <h1 class="card-title">Question : {{$question->question_title}}</h1>
    <p class="card-text">{{$questions[$key]->option_title}}</p>
    <p class="card-text">{{$questions[$key + 1]->option_title}}</p>
    <p class="card-text">{{$questions[$key + 2]->option_title}}</p>
    <p class="card-text">{{$questions[$key + 3]->option_title}}</p>
    @endif
    @if(($key+1)%4 == 0)
    <button class="btn btn-primary" type="button" style="float: right;">Button</button>
    @endif
</div>
@endforeach

@endsection