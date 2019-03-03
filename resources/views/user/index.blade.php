@extends('layout.app')

@section('page-title', 'Users')
@section('user', 'active')
@section('user-index', 'active')

@section('content-header')
  <h1>Users</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Users</li>
  </ol>
@endsection

@section('content')
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <table class="table table-bordered table-responsive">
          <tr>
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th>Email</th>
            <th style="width: 200px">Action</th>
          </tr>
          @foreach ($users as $key => $user)
            <tr>
              <td>{{ $key += 1 }}</td>
              <td>{{ $user->fullName }}</td>
              <td>{{ $user->email }}</td>
              <td>
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger btn-sm delete-button">Delete</a>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
@endsection