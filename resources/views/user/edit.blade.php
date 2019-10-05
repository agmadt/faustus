@extends('layouts.app')

@section('page-title', 'Edit User')
@section('user', 'active')
@section('user-index', 'active')

@section('content-header')
  <h1>Edit User</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route('user.index') }}">Users</a></li>
    <li class="active">Edit User: {{ $user->fullName }}</li>
  </ol>
@endsection

@section('content')
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        {!! Form::model($user, ['url' => route('user.update', $user->id)]) !!}
          {{ csrf_field() }}
          @include('user._form')
          <input type="submit" value="Simpan" class="btn btn-primary btn-sm">
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection