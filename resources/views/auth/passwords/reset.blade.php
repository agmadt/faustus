@extends('layouts.auth')
@section('page-title', 'Reset Password')

@section('content')
  <div class="login-box-body">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
    <form action="{{ route('password.update') }}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
          <div class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
          </div>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
          <div class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
          </div>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password Confirm" name="password_confirmation">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
    </form>
  </div>
@endsection
