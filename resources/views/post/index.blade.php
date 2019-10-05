@extends('layouts.app')

@section('page-title', 'Posts')
@section('post', 'active')
@section('post-index', 'active')

@section('content-header')
  <h1>Posts</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Posts</li>
  </ol>
@endsection

@section('content')
  <div class="col-md-12">
    @include('partial.messages')
    <div style="overflow: hidden; margin-bottom: 10px;">
      <div class="pull-right">
        <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm">Create</a>
      </div>
    </div>
    <div class="box">
      <div class="box-body">
        <table class="table table-bordered table-responsive">
          <tr>
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th style="width: 200px">Action</th>
          </tr>
          @foreach ($posts as $post)
            <tr>
              <td>{{ $no += 1 }}</td>
              <td>{{ $post->title }}</td>
              <td>
                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('post.delete', $post->id) }}" method="POST" style="display: inline-block;">
                  {{ csrf_field() }}
                  <input type="submit" value="Delete" class="btn btn-danger btn-sm delete-button">
                </form>
              </td>
            </tr>
          @endforeach
        </table>
        {{ $posts->links() }}
      </div>
    </div>
  </div>
@endsection