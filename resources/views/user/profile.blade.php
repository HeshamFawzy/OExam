@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="background-color: white;">
            <form method="post" action="{{ route('User.updateprofile', $user->user_id)}}" enctype="multipart/form-data">
                @csrf
                <h1 class="text-center">Edit Profile</h1>
                <div style="text-align: center;">
                    <img src="{{url('uploads/'.$user->filename)}}" class="rounded-circle mr-5" style="width: 150px;">
                </div>
                <div class="form-group">
                    <label for="name" class="h4">Name :</label>
                    <input type="text" class="form-control" name="name" required="" value="{{$user->name}}" />
                </div>

                <div class="form-group">
                    <label for="name" class="h4">Email :</label>
                    <input type="email" class="form-control" name="email" required="" value="{{$user->email}}"
                        disabled="" />
                </div>

                <div class="form-group">
                    <label for="address" class="h4">Address :</label>
                    <input type="text" class="form-control" name="address" required="" value="{{$user->address}}" />
                </div>

                <div class="form-group">
                    <label for="phone" class="h4">Phone :</label>
                    <input type="number" class="form-control" name="mobile_no" required=""
                        value="{{$user->mobile_no}}" />
                </div>

                <div class="form-group">
                    <label for="image" class="h4">Image :</label>
                    <input type="file" class="form-control" name="image" accept="image/gif, image/jpeg, image/png"
                        required="" />
                </div>
                <div class="form-group " style="float: right;">
                    <input type="submit" class="btn btn-primary" value="Update" />
                </div>
            </form>
        </div>
    </div>
</div>
@endsection