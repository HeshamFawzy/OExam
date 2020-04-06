@extends('layouts.app')

@section('content')
<div class="container">
<table class="table table-hover" style="background-color: white;">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Verify as Admin</th>
      </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role}}</td>
            <td>
                <a href="" class="btn btn-success">Verify</a>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection