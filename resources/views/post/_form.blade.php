<div class="form-group">
    {!! Form::label('file', 'Image') !!}
    {!! Form::file('file', null, ['class' => 'form-control', 'required']) !!}
    @if ($errors->has('file'))
    <span class="help-block text-danger">
        <strong>{{ $errors->first('file') }}</strong>
    </span>
    @endif
</div>
@if (!empty($post->image))
<div class="form-group">
    <img src="{{ Storage::url($post->image) }}" alt="">
</div>
@endif
<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
    @if ($errors->has('title'))
    <span class="help-block text-danger">
        <strong>{{ $errors->first('title') }}</strong>
    </span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}
    @if ($errors->has('description'))
    <span class="help-block text-danger">
        <strong>{{ $errors->first('description') }}</strong>
    </span>
    @endif
</div>