@extends('layouts.app')

@section('content')
<div class="container">
    <div style="background-color: white;padding: 1%;border-radius: 3%;">
        <button class="btn btn-primary" type="button" style="float: right;">Finish The Test</button>
        <div class="card-body container">
            <h1 class="card-title">Question : {{$question['question_title']}}</h1>
        </div>
        <div class="row">
            @foreach($question['options'] as $que)
            <div class="col-lg-3">
                <div class="form-check"><input type="radio" id="male" name="gender" value="male"><label class="form-check-label" for="formCheck-1" style="font-size: 30px;">{{$que->option_title}}</label></div>
            </div>
            @endforeach
            <hr>
            <div>
                <a class="btn btn-success" style="float: right;">Next</a>
                <a class="btn btn-success" style="float: left;">Previous</a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection