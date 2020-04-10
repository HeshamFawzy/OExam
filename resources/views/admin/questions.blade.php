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
                        <th>op1</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $key => $question)
                    <tr>
                        <td>{{$question->question_title}}</td>
                        <td>{{$question->answer_option}} Option</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#EditModel"
                                data-id="{{$question->id}}" data-title="{{$question->question_title}}"

                                >Edit</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($question ?? '')
                <form method="post" action="{{ route('Admin.editquestionp', $question->id)}}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group" hidden>
                        <input type="number" class="form-control" name="id" required="" id="id" />
                    </div>

                    <div class="form-group">
                        <label for="title">Question Title* :</label>
                        <input type="text" class="form-control" name="title" required="" id="title" />
                    </div>

                    <div class="form-group">
                        <label for="O1">Option 1* :</label>
                        <input type="text" class="form-control" name="O1" required="" id="O1" />
                    </div>

                    <div class="form-group">
                        <label for="O2">Option 2* :</label>
                        <input type="text" class="form-control" name="O2" required="" id="O2" />
                    </div>

                    <div class="form-group">
                        <label for="O3">Option 3* :</label>
                        <input type="text" class="form-control" name="O3" required="" id="O3" />
                    </div>

                    <div class="form-group">
                        <label for="O4">Option 4* :</label>
                        <input type="text" class="form-control" name="O4" required="" id="O4" />
                    </div>

                    <div class="form-group">
                        <label for="Answer">Answer* :</label>
                        <select id="Answer" class="form-control" name="Answer" required="">
                            <option value="" disabled="disabled" selected="true">Select group</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                            <option value="4">Option 4</option>
                        </select>
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
<script>
    $(document).ready(function () {
        $('#EditModel').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id');
            var title = button.data('title');
            var modal = $(this)
            modal.find('#id').val(id)
            modal.find('#title').val(title)
        })
    });
</script>
@endsection