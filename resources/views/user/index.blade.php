@extends('layouts.app')

@section('content')
<div class="form-group container" style="background-color: white;padding: 10px;">
    <label for="exams" class="h4">Choose Exam :</label>
    <select id="exams" class="form-control" name="exams" required="" id="myselect" onchange="openPopup()">
        <option value="" disabled="disabled" selected="true">Select Exam</option>
        @if($options ?? '')
        @foreach($options as $option)
        <option data-toggle="modal" data-target="#Details" data-id="{{$option->id}}"
            data-title="{{$option->online_exam_title}}"
            data-date="{{date('Y-m-d\TH:i:s', strtotime($option->online_exam_datetime))}}"
            data-duration="{{$option->online_exam_duration}}" data-total="{{$option->total_question}}"
            data-right="{{$option->marks_per_right_answer}}" data-wrong="{{$option->marks_per_wrong_answer}}">
            {{$option->online_exam_title}}
        </option>
        @endforeach
        @endif
    </select>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-primary font-weight-bold m-0 h1" style="text-align: center;">Enrolled Exams</h6>
        </div>
        <div class="card-body">
            <div class="card">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Exam Title</th>
                            <th>Exam Date & Time</th>
                            <th>Exam Duration</th>
                            <th>Exam No. of Total Questions</th>
                            <th>Exam Marks/Right Answer</th>
                            <th>Exam Marks/Wrong Answer</th>
                            <th>Exam Status</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                        @foreach($Enrolled as $Enroll)
                        <tr>
                            <td>{{$Enroll->online_exam_title}}</td>
                            <td>{{$Enroll->online_exam_datetime}}</td>
                            <td>{{$Enroll->online_exam_duration}} Minutes</td>
                            <td>{{$Enroll->total_question}}</td>
                            <td><span class="badge badge-pill badge-success">{{$Enroll->marks_per_right_answer}}
                                    Mark</span></td>
                            <td><span class="badge badge-pill badge-danger">- {{$Enroll->marks_per_wrong_answer}}
                                    Mark</span></td>
                            <td> @if($Enroll->online_exam_status == "pending...")
                                <label class="badge badge-warning p-1">{{$Enroll->online_exam_status}}</label>
                                @elseif($Enroll->online_exam_status == "started")
                                <a href="{{ url('/start' , $Enroll->id)}}" class="btn btn-success">Start</a>
                                @else
                                <label class="badge badge-dark p-1">{{$Enroll->online_exam_status}}</label>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">Exam Title</th>
                            <td>
                                <input type="text" class="form-control" name="title" required=""
                                    placeholder="Enter Exam Title" id="title" disabled />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Exam Date & Time</th>
                            <td><input type="datetime-local" class="form-control" name="date" required="" id="date"
                                    disabled />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Exam Duration</th>
                            <td> <input type="number" class="form-control" name="duration" required=""
                                    placeholder="Enter Exam Duration in Minutes" id="duration" disabled /></td>
                        </tr>
                        <tr>
                            <th scope="row">Total Questions</th>
                            <td><input type="number" class="form-control" name="total" required=""
                                    placeholder="Enter Exam Total Questions Number" id="total" disabled /></td>
                        </tr>
                        <tr>
                            <th scope="row">Marks/Right Answer</th>
                            <td> <input type="number" class="form-control" name="right" required=""
                                    placeholder="Enter Exam Marks Per Right Answer" id="right" disabled /></td>
                        </tr>
                        <tr>
                            <th scope="row">Marks/Wrong Answer</th>
                            <td><input type="number" class="form-control" name="wrong" required=""
                                    placeholder="Enter Exam Marks Per Wrong Answer" id="wrong" disabled /></td>
                        </tr>
                    </tbody>
                </table>
                <form method="post" action="{{ route('User.enroll')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group" hidden>
                        <input type="number" class="form-control" name="id" required="" id="id" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success float-right" value="Enroll" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function openPopup() {
        $("#Details").modal();
    }
    $(document).ready(function () {
        $('#Details').on('show.bs.modal', function (event) {
            var button = $(event.target)
            var id = $('#exams').find(":selected").data('id');
            var title = $('#exams').find(":selected").data('title');
            var date = $('#exams').find(":selected").data('date');
            var duration = $('#exams').find(":selected").data('duration');
            var total = $('#exams').find(":selected").data('total');
            var right = $('#exams').find(":selected").data('right');
            var wrong = $('#exams').find(":selected").data('wrong');
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