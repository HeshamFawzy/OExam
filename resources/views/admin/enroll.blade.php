@extends('layouts.dashboard')

@section('content')
<table class="table table-hover">
    <thead>
        <tr>
            <th>Image</th>
            <th>User Name</th>
            <th>Email Address</th>
            <th>Mobile No.</th>
            <th>Result</th>
        </tr>
    </thead>
    <tbody id="table">
        @foreach($Enrolls as $Enroll)
        <tr>
            <td> <img src="{{url('uploads/'.$Enroll->filename)}}" class="rounded-circle mr-5" style="width: 60px;"></td>
            <td>{{$Enroll->name}}</td>
            <td>{{$Enroll->email}}</td>
            <td>{{$Enroll->mobile_no}}</td>
            <td>
                <form method="post" action="{{url('/result')}}" enctype="multipart/form-data">
                    @csrf
                    <input hidden type="text" class="form-control" name="exam_id" value="{{$Enroll->exam_id}}" />
                    <input hidden type="text" class="form-control" name="examiner_id" value="{{$Enroll->id}}" />
                    <input type="submit" class="btn btn-primary float-right" value="Result" />
                </form>
                @if($errors->any())
                <h4 class="label label-warning">{{$errors->first()}}</h4>
                @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endsection