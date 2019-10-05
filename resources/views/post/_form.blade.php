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