@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-hover" style="background-color: white;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>
                    <form method="post" action="{{ route('BasicAdmin.verify')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group" hidden>
                            <input type="number" class="form-control" name="id" required="" value="{{$user->id}}" />
                        </div>

                        <select id="role" class="form-control" name="role" required="">
                            @if($options ?? '') @foreach($options as $option)
                            <option value="{{$option}}" {{$user->role == $option  ? 'selected' : ''}}>
                                {{$option}} </option>
                            @endforeach @endif
                        </select>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-sm" type="submit" style="float: right;width: 100px;">
                                Edit
                            </button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection