@extends('layouts.dashboard')

@section('content')
<div class="card shadow" id="view">
    <div class="card-header py-3">
        <p class="text-primary m-0 font-weight-bold h2">Exam Questions Info</p>
    </div>
    <div class="card-body">
        <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
            <table class="table dataTable my-0">
                <thead>
                    <tr>
                        <th>Question Titile</th>
                        <th>Right Option</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                    <tr>
                        <td>{{$question->question_title}}</td>
                        <td>{{$question->answer_option}} Option</td>
                        <td>
                            <a href="{{ url('/editquestion' , $question->id)}}" class="btn btn-success" name="edit"
                                >Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="EditModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($question ?? '')
                <form method="post" action="{{ route('Admin.editquestionp', $question->id)}}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Question Title* :</label>
                        <input type="text" class="form-control" name="title" required="" placeholder="Enter Exam Title"
                        />
                    </div>
                        <div class="form-group">
                            <label for="O1">Option 1* :</label>
                        <input type="text" class="form-control" name="O1" required="" />
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success float-right" name="Add" value="Edit Question" />
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection