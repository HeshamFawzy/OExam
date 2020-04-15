@extends('layouts.app')

@section('content')
<div class="container">
    <div style="background-color: white;padding: 1%;border-radius: 3%;">
        <a class="btn btn-primary" type="button" style="float: right;">Finish The Test</a>
        <div class="warning" style="float: right;">
            @if($errors->any())
            <h4 class="label label-warning">{{$errors->first()}}</h4>
            @endif
        </div>
        @if($question ?? '')
        <h1 id="timer" style="float: right;">Minute : </h1>
        <div class="card-body container">
            <h1 class="card-title">Question : {{$question['question_title']}}</h1>
        </div>
        <form method="post" action="{{ url('/question' , $question['Qid'])}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="number" value="{{$question['exam_id']}}" name="exam_id" hidden>
            <div class="row">
                @foreach($question['options'] as $key => $que)
                <div class="col-lg-3">
                    <div class="form-check"><input type="radio" id="{!! $key !!}" name="answer"
                            value="{{$que->option_number}}"
                            {{ $question['user_answer_option'] == $que->option_number ? 'checked' : ''}}><label
                            class="form-check-label" for="formCheck-1"
                            style="font-size: 30px;">{{$que->option_title}}</label></div>
                </div>
                @endforeach
                <hr>
                <div>
                    <input class="btn btn-success" type="submit" name="action" style="float: right;" value="next" />
                    <input class="btn btn-success" type="submit" name="action" value="previous" />
                </div>
            </div>
        </form>
        @else
        <a class="btn btn-warning" href="{{ route('User.viewquestions')}}">View
            Questions</a>
        @endif
    </div>
</div>
<script>
    $(document).ready(function () {
        if(sessionStorage.getItem("timer") == null){
            $.ajax({
                url: "/time",
                success: function (response) {
                    $("#timer").append(response.duration.online_exam_duration);
                }
            });
        } else {
            $("#timer").append(sessionStorage.getItem("timer"));
        }
       
        setInterval(function () {
            let x = parseInt($("#timer").html().match(/\d+/));
            sessionStorage.setItem("timer" ,  x );
            $.ajax({
                url: "/timerdecrease",
                type: "get",
                data: {
                    t: x
                },
                success: function (response) {
                    $("#timer").html(response.decrease + " Minutes");
                }
            });
        }, 60000);
    })
   /* $(window).keydown(function (event) {

        if (event.keyCode == 116) {

            event.preventDefault();

            return false;

        }*/

    });

</script>
@endsection