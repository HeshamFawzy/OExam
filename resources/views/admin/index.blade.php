@extends('layouts.dashboard')

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <p class="text-primary m-0 font-weight-bold h2">Exams Info</p>
        <button style="float: right;" type="button" class="btn btn-primary" data-toggle="modal"
            data-target="#exampleModal" data-whatever="@mdo">Add New Exam</button>
    </div>
    <div class="card-body table-container">
        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
            <table class="table dataTable my-0" id="dataTable">
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
                    @foreach($online_exams as $online_exam)
                    <tr>
                        <td>{{$online_exam->online_exam_title}}</td>
                        <td>{{$online_exam->online_exam_datetime}}</td>
                        <td>{{$online_exam->online_exam_duration}} Minutes</td>
                        <td>{{$online_exam->total_question}} Question</td>
                        <td>{{$online_exam->marks_per_right_answer}} Mark</td>
                        <td>{{$online_exam->marks_per_wrong_answer}} Mark</td>
                        @if($online_exam->online_exam_status == "pending...")
                            <td><label class="badge badge-warning p-1">{{$online_exam->online_exam_status}}</label></td>
                        @elseif($online_exam->online_exam_status == "started")
                            <td><label class="badge badge-primary p-1">{{$online_exam->online_exam_status}}</label></td>
                        @else
                            <td><label class="badge badge-dark p-1">{{$online_exam->online_exam_status}}</label></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form method="post" action="{{ route('Admin.create')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Exam Title* :</label>
                        <input type="text" class="form-control" name="title" required=""
                            placeholder="Enter Exam Title" />
                    </div>

                    <div class="form-group">
                        <label for="date">Exam Date & Time* :</label>
                        <input type="datetime-local" class="form-control" name="date" required="" />
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
<script>
    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        setInterval(function(){
            $.ajax({
            url: "/timer",
            success: function(response) {
                console.log(response.status);
            }
            });
        },1000);
        setInterval(function(){
            $.ajax({
            url: "/timer2",
            success: function(response) {

            }
            });
        },1000);
    }); 
</script>
@endsection