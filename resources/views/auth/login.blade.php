@extends('layouts.auth')
@section('page-title', 'Login')

@section('content')
  <div class="login-box-body">
    <form action="{{ route('login') }}" method="post">
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
      <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
    </form>
    <div style="margin-top: 10px;">
      <a href="{{ route('password.request') }}" style="padding-top: 20px;">I forgot my password</a>
    </div>
  </div>
@endsection
