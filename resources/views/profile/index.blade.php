@extends('layouts.app')
@section('content')
<div class="register-box">
  <div class="register-logo">
    <p href=""><b>Welcome {{Auth::user()->gender==1 ? 'Mr.' : 'Mrs.'}} {{Auth::user()->name}}</p>
  </div>

  <div class="register-box-body">

    <form id="user_form" enctype="multipart/form-data">
      @csrf
      <div class="form-group has-feedback">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" placeholder="Full name" autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>

      <div class="form-group has-feedback">
        <label for="email">Email</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email" placeholder="Email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>

      <div class="form-group has-feedback">
        <label for="email">Gender</label>
        <select class="form-control" id="gender">
          <option value="" selected disabled hidden>--Select--</option>
          <option value="1" {{Auth::user()->gender=='1' ? 'selected' : ''}}>Male</option>
          <option value="2" {{Auth::user()->gender=='2' ? 'selected' : ''}}>Female</option>
        </select>
      </div>

      <div class="form-group has-feedback">
        <label for="phone_number">Phone Number</label>
        <input class="form-control" type="text" name="phone_number" id="phone_number" placeholder="Enter Number" value="{{Auth::user()->phone_number}}">
      </div>

      <div class="form-group has-feedback">
        <label for="c_password">Current Password</label>
        <div>
          <input id="c_password" type="password" class="form-control" name="c_password" placeholder="Password">
          <span id="c_success"></span>
        </div>
      </div>

      <div class="form-group has-feedback">
        <label for="password">New Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"  placeholder="New Password" disabled>
        <p id="pass"></p>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>

      <div class="form-group has-feedback">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Retype password" disabled>
        <span id="con_success"></span>
      </div>

      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary submit">
              {{ __('Save') }}
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('script')
<script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#c_password").keyup(function() {
    var c_password = $(this).val();

    $.ajax({
      url   : "{{route('password')}}",
      data  : {c_password : c_password},
      type  : "get",
      success: function(data) {
          if(data=="matched")
          {
            $("#c_success").html('<i class="glyphicon form-control-feedback glyphicon-ok"></i>');
            $(".submit").attr("disabled", true);
            $("#password").removeAttr("disabled", 'disabled');
            $("#password-confirm").removeAttr("disabled", 'disabled');

            $("#password-confirm").keyup(function() {
              var password = $("#password").val();
              var conpass  = $(this).val();
              if(conpass != '' && password == conpass) {
                $("#con_success").html('<span class="glyphicon form-control-feedback glyphicon-ok"></span>');
                $(".submit").attr("disabled", false);
              }
              else {
                $("#con_success").html('<i class="glyphicon form-control-feedback glyphicon-remove"></i>');
                $(".submit").attr("disabled", true);
              }
            });
          }
          else
          {
            $("#c_success").html('<i class="glyphicon form-control-feedback glyphicon-remove"></i>');
            $(".submit").attr("disabled", false);
            $("#password").attr("disabled", 'disabled');
            $("#password-confirm").attr("disabled", 'disabled');
          }
      }
    });
  });

  $("#user_form").submit(function(e) {
    e.preventDefault();
    var name   = $("#name").val();
    var gender = $("#gender").val();
    var number = $("#phone_number").val();
    var password = $("#password").val();
    var conpass  = $("#password-confirm").val();
    if(conpass!='' && password!='' && conpass==password)
    {
        $.ajax({
          url      : "{{route('profile.store')}}",
          type     : "post",
          data     : {
            "_token":"{{ csrf_token() }}",
            name          : name,
            gender        : gender,
            phone_number  : number,
            password      : conpass,
          },
          dataType : "json",
          success: function(data) {
            if(data.msgType=="success") {
              toastr["success"](data.message);
              location.reload();
            }
          }
        });
    }
    else {
      $.ajax({
        url    : "{{route('profile.store')}}",
        type   : "post",
        data   : {
          "_token":"{{ csrf_token() }}",
          name         : name,
          gender       : gender,
          phone_number : number
        },
        dataType: "json",
        success: function(data) {
          if(data.msgType=="success") {
            toastr["success"](data.message);
            location.reload();
          }
        }
      });
    }
  });

  $('#email').click(function(){
       $("#email").prop("readonly", true);
   });
});
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
@endsection
