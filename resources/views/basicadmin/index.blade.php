@extends('layouts.app')

@section('content')
<div class="container">
<table class="table table-hover" style="background-color: white;">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Verify Role</th>
      </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                <select id="role" class="form-control" name="role" required="">
                    <option value="" disabled="disabled" selected="true">Select Role</option>
                    @if($options ?? '') @foreach($options as $option)
                    <option value="{{$option}}" {{$user->role == $option  ? 'selected' : ''}}>
                        {{$option}} </option>
                    @endforeach @endif
                </select>
            </td>
            <td>
                <button href="" class="btn btn-success" id="Auth" value="{{$user->id}}">Verify</button>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>
<script>
    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          $("#Auth").click(function(){
            $.ajax({
                /* the route pointing to the post function */
                url: '/verify',
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: {_token: CSRF_TOKEN, id:$(this).val()},
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                  $('#Auth').html('UnVerify');
                  $('#Auth').css('background-color','red');
                },
                error: function(xhr, status, error) {
                  console.log(xhr);
                  if (xhr == 'undefined' || xhr == undefined) {
                      alert('undefined');
                  } else {
                      alert('object is there');
                  }
                  alert(status);
                  alert(error);
                }
            });
          });
          $("#Auth").dblclick(function(){
            $.ajax({
                /* the route pointing to the post function */
                url: '/unverify',
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: {_token: CSRF_TOKEN, id:$(this).val()},
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                  $('#Auth').html('Verify');
                  $('#Auth').css('background-color','green');
                },
                error: function(xhr, status, error) {
                  console.log(xhr);
                  if (xhr == 'undefined' || xhr == undefined) {
                      alert('undefined');
                  } else {
                      alert('object is there');
                  }
                  alert(status);
                  alert(error);
                }
            }); 
          });
    });    
</script>
@endsection