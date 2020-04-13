@extends('layouts.app')

@section('content')
<div class="container">
    <div style="background-color: white;padding: 1%;">
        <button class="btn btn-primary" type="button" style="float: right;">Finish The Test</button>
        <div class="card-body container">
            <h1 class="card-title">Question : {{$question['question_title']}}</h1>
        </div>
        <div class="row">
            @foreach($question['options'] as $que)
            <div class="col-lg-3">
                <div class="form-check"><input type="radio" id="male" name="gender" value="male"><label class="form-check-label" for="formCheck-1">{{$que->option_title}}</label></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection