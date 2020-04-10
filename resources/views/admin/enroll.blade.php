@extends('layouts.dashboard')

@section('content')
<table class="table table-hover">
    <thead>
        <tr>
            <th>Image</th>
            <th>User Name</th>
            <th>Email Address</th>
            <th>Gender</th>
            <th>Mobile No.</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="table">
        @foreach($Enrolls as $Enroll)
        <tr>
            <td><img src="{{url('uploads/'.$Enroll->filename)}}" class="rounded-circle mr-5" style="width: 150px;"></td>
            <td>{{$Enroll->name}}</td>
            <td>{{$Enroll->email}}</td>
            <td>{{$Enroll->gender}}</td>
            <td>{{$Enroll->mobile_no}}</td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection