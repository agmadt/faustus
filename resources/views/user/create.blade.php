@extends('layouts.app')

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
        {!! Form::model($user, ['url' => route('user.store'), 'enctype' => 'multipart/form-data']) !!}
          {{ csrf_field() }}
          @include('user._form')
          <input type="submit" value="Tambah" class="btn btn-primary btn-sm">
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection