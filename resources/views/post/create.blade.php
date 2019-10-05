@extends('layouts.app')

@section('page-title', 'Create Post')
@section('post', 'active')
@section('post-create', 'active')

@section('content-header')
  <h1>Create Post</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route('post.index') }}">Posts</a></li>
    <li class="active">Create Post</li>
  </ol>
@endsection

@section('content')
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        {!! Form::model($post, ['url' => route('post.store')]) !!}
          {{ csrf_field() }}
          @include('post._form')
          <input type="submit" value="Tambah" class="btn btn-primary btn-sm">
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection