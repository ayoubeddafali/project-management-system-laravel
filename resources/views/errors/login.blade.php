@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
    <style>
      
    </style>
    @stop

@section('content')

<div class="login-box" style="width:60%;margin: auto;">
    <div class="login-logo">
        <b>Bienv</b>enue
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body" style="border: 2px solid #000000; border-radius: 3px; ">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ url('/login') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
            <div class="checkbox">
            <label>
            <input type="checkbox" name="remember"> Remember Me
            </label>

            </div>
            </div>

            <div class="form-group">

            <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-sign-in"></i> Login
            </button>

            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
            </div>
        </form>






    </div>
    <!-- /.login-box-body -->
</div>
@endsection
