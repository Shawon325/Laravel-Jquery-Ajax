<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('/bower_components/Ionicons/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('/plugins/iCheck/square/blue.css')}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="form-group has-feedback">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Full name" autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>

      <div class="form-group has-feedback">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>

      <div class="form-group has-feedback">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"  placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <p id="pass"></p>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>

      <div class="form-group has-feedback">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Retype password">
        <span id="con_success"></span>
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary submit">
              {{ __('Register') }}
          </button>
        </div>
      </div>
    </form>

    <a href="login.html" class="text-center">I already have a membership</a>
  </div>
</div>
<script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
<script>
$(document).ready(function() {
  $("#password-confirm").keyup(function() {
    var password = $("#password").val();
    var conpass  = $("#password-confirm").val();
    if(password == conpass) {
      $("#con_success").html('<span class="glyphicon form-control-feedback glyphicon-ok"></span>');
      $(".submit").attr("disabled", false);
    } else {
      $("#con_success").html('<span class="glyphicon form-control-feedback glyphicon-remove"></span>');
      $(".submit").attr("disabled", true);
    }
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
</body>
</html>
