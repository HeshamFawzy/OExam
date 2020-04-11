@extends('layouts.app')

@section('content')
<div class="container">
    <div style="float: right;">
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" method="post"
            action="{{ url('/search/{email}')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search"
                    aria-describedby="basic-addon2" name="search" style="width: 300px;" />
                <div class="input-group-append" style="float: right;">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>Search</button>
                </div>
            </div>
        </form>
    </div>
    <hr>
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
                <td>
                    @if($user->getRoleNames()->first() == "Admin" || $user->getRoleNames()->first() == "User")
                        <label class="label label-success">{{$user->getRoleNames()->first()}}</label>
                    @else
                    <label class="label label-danger">{{$user->getRoleNames()->first()}}</label>
                    @endif
                </td>
                <td>
                    <form method="post" action="{{ route('BasicAdmin.verify')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group" hidden>
                            <input type="number" class="form-control" name="id" required="" value="{{$user->id}}" />
                        </div>

                        <select id="role" class="form-control" name="role" required="">
                            @if($options ?? '') @foreach($options as $option)
                            <option value="{{$option}}" {{$user->getRoleNames()->first() == $option  ? 'selected' : ''}}>
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
    <div style="float: right;">
        {{ $users->links() }}
    </div>
</div>
@endsection