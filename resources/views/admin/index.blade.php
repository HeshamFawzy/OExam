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
                    @foreach($online_exams as $index => $online_exam)
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
                            @if($number[$index]->num <= $online_exam->total_question - 1 && $online_exam->online_exam_status == "pending...")
                                <button style="float: right;" type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#Question" data-id="{{$online_exam->id}}">Add New
                                    Q</button>
                            @elseif($number[$index]->num > 1)
                                <a class="btn btn-warning" href="{{ url('/viewquestions' , $online_exam->id)}}">View
                                    Questions</a>
                            @endif

                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            @if($online_exam->online_exam_status == "pending...")
                            <a href="{{ url('/editexam')}}" class="btn btn-success" name="edit" data-toggle="modal"
                                data-target="#EditModel" data-id="{{$online_exam->id}}"
                                data-title="{{$online_exam->online_exam_title}}"
                                data-date="{{date('Y-m-d\TH:i:s', strtotime($online_exam->online_exam_datetime))}}"
                                data-duration="{{$online_exam->online_exam_duration}}"
                                data-total="{{$online_exam->total_question}}"
                                data-right="{{$online_exam->marks_per_right_answer}}"
                                data-wrong="{{$online_exam->marks_per_wrong_answer}}">Edit</a>
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

                    <div class="form-group" hidden>
                        <input type="number" class="form-control" name="id" required="" id="id" />
                    </div>

                    <div class="form-group">
                        <label for="title">Exam Title* :</label>
                        <input type="text" class="form-control" name="title" required="" placeholder="Enter Exam Title"
                            id="title" />
                    </div>

                    <div class="form-group">
                        <label for="date">Exam Date & Time* : </label>
                        <input type="datetime-local" class="form-control" name="date" required="" id="date" />
                    </div>

                    <div class="form-group">
                        <label for="duration">Exam Duration* :(Minutes)</label>
                        <input type="number" class="form-control" name="duration" required=""
                            placeholder="Enter Exam Duration in Minutes" id="duration" />
                    </div>

                    <div class="form-group">
                        <label for="total">Total Question* :(Number)</label>
                        <input type="number" class="form-control" name="total" required=""
                            placeholder="Enter Exam Total Questions Number" id="total" />
                    </div>


                    <div class="form-group">
                        <label for="right">Marks For Right Answer* :(Marks)</label>
                        <input type="number" class="form-control" name="right" required=""
                            placeholder="Enter Exam Marks Per Right Answer" id="right" />
                    </div>

                    <div class="form-group">
                        <label for="wrong">Marks For Wrong Answer* :(Marks)</label>
                        <input type="number" class="form-control" name="wrong" required=""
                            placeholder="Enter Exam Marks Per Wrong Answer" id="wrong" />
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

                    <div class="form-group">
                        <input type="number" class="form-control" name="id" required="" id="examid" />
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
        }, 10000);
        setInterval(function () {
            $.ajax({
                url: "/timer2",
                success: function (response) {
                    $("#view").load(" #view");
                }
            });
        }, 10000);
        $('#Question').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('#examid').val(id)
        });
        $('#EditModel').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id');
            var title = button.data('title');
            var date = button.data('date');
            var duration = button.data('duration');
            var total = button.data('total');
            var right = button.data('right');
            var wrong = button.data('wrong');
            var modal = $(this)
            modal.find('#id').val(id)
            modal.find('#title').val(title)
            modal.find('#date').val(date)
            modal.find('#duration').val(duration)
            modal.find('#total').val(total)
            modal.find('#right').val(right)
            modal.find('#wrong').val(wrong)
        })
    });
</script>
@endsection