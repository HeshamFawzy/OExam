@extends('layouts.app')

@section('content')
<div class="container" style="background-color: white;padding: 1%;">
    <button class="btn btn-primary" type="button" style="float: right;">Button</button>
    @foreach($questions as $key => $question)
    <div>
        <div class="card-body container">
            <h1 class="card-title">Question : {{$question->question_title}}</h1>
            <hr>
            <div class="row" style="padding: 5%;">

            </div>
        </div>
    </div>
    @endforeach
    <div style="float: right;" style="background-color: white;">
        {{ $questions->links() }}
    </div>
</div>
</div>
@endsection