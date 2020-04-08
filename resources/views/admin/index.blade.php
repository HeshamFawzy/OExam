@extends('layouts.dashboard')

@section('content')
<div class="card shadow" id="view">
    <div class="card-header py-3">
        <p class="text-primary m-0 font-weight-bold h2">Exams Info</p>
        <button style="float: right;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#Model"
            data-whatever="@mdo">Add New Exam</button>
    </div>
    <div class="card-body">
        <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
            <table class="table dataTable my-0">
                <thead>
                    <tr>
                        <th>Exam Title</th>
                        <th>Date & Time</th>
                        <th>Duration</th>
                        <th>Total Question</th>
                        <th>Right Answer Mark</th>
                        <th>Wrong Answer Mark</th>
                        <th>Status</th>
                        <th>Question</th>
                        <th>Enroll</th>
                        <th>Result</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($online_exams as $key => $online_exam)
                    <tr>
                        <td>{{$online_exam->online_exam_title}}</td>
                        <td>{{$online_exam->online_exam_datetime}}</td>
                        <td>{{$online_exam->online_exam_duration}} Minutes</td>
                        <td>{{$online_exam->total_question}} Question</td>
                        <td>{{$online_exam->marks_per_right_answer}} Mark</td>
                        <td>{{$online_exam->marks_per_wrong_answer}} Mark</td>
                        <td>
                            @if($online_exam->online_exam_status == "pending...")
                            <label class="badge badge-warning p-1">{{$online_exam->online_exam_status}}</label>
                            @elseif($online_exam->online_exam_status == "started")
                            <label class="badge badge-primary p-1">{{$online_exam->online_exam_status}}</label>
                            @else
                            <label class="badge badge-dark p-1">{{$online_exam->online_exam_status}}</label>
                            @endif
                        </td>
                        <td>
                            @if($number[1]->num < $online_exam->total_question) <button style="float: right;"
                                    type="button" class="btn btn-primary" data-toggle="modal" data-target="#Question"
                                    data-whatever="{{$online_exam->id}}">Add New
                                    Q</button>
                                @endif
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            @if($online_exam->online_exam_status == "pending...")
                            <a href="{{ url('/editexam' , $online_exam->id)}}" class="btn btn-success" name="edit"
                                data-toggle="modal" data-target="#EditModel" data-whatever="@mdo">Edit</a>
                            <a href="{{ url('/deleteexam' , $online_exam->id)}}" class="btn btn-danger"
                                name="delete">Delete</a>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="float: right;">
            {{ $online_exams->links("pagination::bootstrap-4") }}
        </div>
    </div>
</div>

<div class="modal fade" id="Model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('Admin.create')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Exam Title* :</label>
                        <input type="text" class="form-control" name="title" required=""
                            placeholder="Enter Exam Title" />
                    </div>

                    <div class="form-group">
                        <label for="date">Exam Date & Time* : </label>
                        <input type="datetime-local" class="form-control" name="date" required="" value="" />
                    </div>

                    <div class="form-group">
                        <label for="duration">Exam Duration* :(Minutes)</label>
                        <input type="number" class="form-control" name="duration" required=""
                            placeholder="Enter Exam Duration in Minutes" />
                    </div>

                    <div class="form-group">
                        <label for="total">Total Question* :(Number)</label>
                        <input type="number" class="form-control" name="total" required=""
                            placeholder="Enter Exam Total Questions Number" />
                    </div>


                    <div class="form-group">
                        <label for="right">Marks For Right Answer* :(Marks)</label>
                        <input type="number" class="form-control" name="right" required=""
                            placeholder="Enter Exam Marks Per Right Answer" />
                    </div>

                    <div class="form-group">
                        <label for="wrong">Marks For Wrong Answer* :(Marks)</label>
                        <input type="number" class="form-control" name="wrong" required=""
                            placeholder="Enter Exam Marks Per Wrong Answer" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success float-right" name="Add" value="Add Exam" />
                    </div>
                </form>
            </div>
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
                @if($online_exam ?? '')
                <form method="post" action="{{ route('Admin.editexamp', $online_exam->id)}}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Exam Title* :</label>
                        <input type="text" class="form-control" name="title" required="" placeholder="Enter Exam Title"
                            value="{{$online_exam->online_exam_title}}" />
                    </div>

                    <div class="form-group">
                        <label for="date">Exam Date & Time* : </label>
                        <input type="datetime-local" class="form-control" name="date" required=""
                            value="{{date("Y-m-d\TH:i:s", strtotime($online_exam->online_exam_datetime))}}" />
                    </div>

                    <div class="form-group">
                        <label for="duration">Exam Duration* :(Minutes)</label>
                        <input type="number" class="form-control" name="duration" required=""
                            placeholder="Enter Exam Duration in Minutes"
                            value="{{$online_exam->online_exam_duration}}" />
                    </div>

                    <div class="form-group">
                        <label for="total">Total Question* :(Number)</label>
                        <input type="number" class="form-control" name="total" required=""
                            placeholder="Enter Exam Total Questions Number" value="{{$online_exam->total_question}}" />
                    </div>


                    <div class="form-group">
                        <label for="right">Marks For Right Answer* :(Marks)</label>
                        <input type="number" class="form-control" name="right" required=""
                            placeholder="Enter Exam Marks Per Right Answer"
                            value="{{$online_exam->marks_per_right_answer}}" />
                    </div>

                    <div class="form-group">
                        <label for="wrong">Marks For Wrong Answer* :(Marks)</label>
                        <input type="number" class="form-control" name="wrong" required=""
                            placeholder="Enter Exam Marks Per Wrong Answer"
                            value="{{$online_exam->marks_per_wrong_answer}}" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success float-right" name="Add" value="Edit Exam" />
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($online_exam ?? '')
                <form method="post" action="{{ route('Admin.createquestion')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group" hidden>
                        <input type="number" class="form-control" name="id" required="" id="id" />
                    </div>

                    <div class="form-group">
                        <label for="title">Question Title* :</label>
                        <input type="text" class="form-control" name="title" required=""
                            placeholder="Enter Question Title" />
                    </div>

                    <div class="form-group">
                        <label for="O1">Option 1* :</label>
                        <input type="text" class="form-control" name="O1" required="" placeholder="Enter Option" />
                    </div>

                    <div class="form-group">
                        <label for="O2">Option 2* :</label>
                        <input type="text" class="form-control" name="O2" required="" placeholder="Enter Option" />
                    </div>

                    <div class="form-group">
                        <label for="O3">Option 3* :</label>
                        <input type="text" class="form-control" name="O3" required="" placeholder="Enter Option" />
                    </div>

                    <div class="form-group">
                        <label for="O4">Option 4* :</label>
                        <input type="text" class="form-control" name="O4" required="" placeholder="Enter Option" />
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
                        <input type="submit" class="btn btn-success float-right" name="Add" value="Add Question" />
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        setInterval(function () {
            $.ajax({
                url: "/timer",
                success: function (response) {
                    $("#view").load(" #view");
                }
            });
        }, 1000);
        setInterval(function () {
            $.ajax({
                url: "/timer2",
                success: function (response) {
                    $("#view").load(" #view");
                }
            });
        }, 1000);
        $('#Question').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('#id').val(recipient)
        })
    });
</script>
@endsection