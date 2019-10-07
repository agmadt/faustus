@extends('layouts.app')

@section('page-title', 'Edit Post')
@section('post', 'active')
@section('post-index', 'active')

@section('content-header')
  <h1>Edit Post</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route('post.index') }}">Posts</a></li>
    <li class="active">Edit Post: {{ $post->title }}</li>
  </ol>
@endsection

@section('content')
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        {!! Form::model($post, ['url' => route('post.update', $post->id), 'enctype' => 'multipart/form-data']) !!}
          {{ csrf_field() }}
          @include('post._form')
          <input type="submit" value="Simpan" class="btn btn-primary btn-sm">
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection