<div class="form-group">
    {!! Form::label('profile[first_name]', 'First name') !!}
    {!! Form::text('profile[first_name]', null, ['class' => 'form-control', 'required', 'name' => 'first_name']) !!}
    @if ($errors->has('profile[first_name]'))
    <span class="help-block text-danger">
        <strong>{{ $errors->first('profile[first_name]') }}</strong>
    </span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('profile[last_name]', 'Last name') !!}
    {!! Form::text('profile[last_name]', null, ['class' => 'form-control', 'required', 'name' => 'last_name']) !!}
    @if ($errors->has('profile[last_name]'))
    <span class="help-block text-danger">
        <strong>{{ $errors->first('profile[last_name]') }}</strong>
    </span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}
    @if ($errors->has('email'))
    <span class="help-block text-danger">
        <strong>{{ $errors->first('email') }}</strong>
    </span>
    @endif
</div>
<div class="form-group">
    <label for="user-password">Password</label>
    <input type="password" class="form-control" id="user-password" name="password">
    @if ($errors->has('password'))
    <span class="help-block text-danger">
        <strong>{{ $errors->first('password') }}</strong>
    </span>
    @endif
</div>
<div class="form-group">
    <label for="re-user-password">Repeat Password</label>
    <input type="password" class="form-control" id="re-user-password" name="password_confirmed">
    @if ($errors->has('password_confirmed'))
    <span class="help-block text-danger">
        <strong>{{ $errors->first('password_confirmed') }}</strong>
    </span>
    @endif
</div>