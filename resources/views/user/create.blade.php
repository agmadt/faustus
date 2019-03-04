@extends('layout.app')

@section('page-title', 'Create User')
@section('user', 'active')
@section('user-create', 'active')

@section('content-header')
  <h1>Create User</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route('user.index') }}">Users</a></li>
    <li class="active">Create User</li>
  </ol>
@endsection

@section('content')
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <form action="{{ route('user.store') }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="user-first-name">First Name</label>
            <input type="text" class="form-control" id="user-first-name" name="first_name"
              value="{{ old('first_name') }}">
            @if ($errors->has('first_name'))
              <span class="help-block text-danger">
                <strong>{{ $errors->first('first_name') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="user-last-name">Last Name</label>
            <input type="text" class="form-control" id="user-last-name" name="last_name"
              value="{{ old('last_name') }}">
            @if ($errors->has('last_name'))
              <span class="help-block text-danger">
                <strong>{{ $errors->first('last_name') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="user-email">Email</label>
            <input type="email" class="form-control" id="user-email" name="email"
              value="{{ old('email') }}">
            @if ($errors->has('email'))
              <span class="help-block text-danger">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="user-password">Password</label>
            <input type="password" class="form-control" id="user-password" name="password"
              value="{{ old('password') }}">
            @if ($errors->has('password'))
              <span class="help-block text-danger">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="re-user-password">Repeat Password</label>
            <input type="password" class="form-control" id="re-user-password" name="password_confirmed"
              value="{{ old('password_confirmed') }}">
            @if ($errors->has('password_confirmed'))
              <span class="help-block text-danger">
                <strong>{{ $errors->first('password_confirmed') }}</strong>
              </span>
            @endif
          </div>
          <input type="submit" value="Tambah" class="btn btn-primary btn-sm">
        </form>
      </div>
    </div>
  </div>
@endsection