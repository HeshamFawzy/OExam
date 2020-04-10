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
            data-duration="{{$option->online_exam_duration}}"
            data-total="{{$option->total_question}}"
            data-right="{{$option->marks_per_right_answer}}"
            data-wrong="{{$option->marks_per_wrong_answer}}"
            >{{$option->online_exam_title}}
        </option>
        @endforeach
        @endif
    </select>
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
                                    placeholder="Enter Exam Title" id="title" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Exam Date & Time</th>
                            <td><input type="datetime-local" class="form-control" name="date" required="" id="date" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Exam Duration</th>
                            <td> <input type="number" class="form-control" name="duration" required=""
                                    placeholder="Enter Exam Duration in Minutes" id="duration" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Total Questions</th>
                            <td><input type="number" class="form-control" name="total" required=""
                                    placeholder="Enter Exam Total Questions Number" id="total" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Marks/Right Answer</th>
                            <td> <input type="number" class="form-control" name="right" required=""
                                    placeholder="Enter Exam Marks Per Right Answer" id="right" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Marks/Wrong Answer</th>
                            <td><input type="number" class="form-control" name="wrong" required=""
                                    placeholder="Enter Exam Marks Per Wrong Answer" id="wrong" /></td>
                        </tr>
                    </tbody>
                </table>
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