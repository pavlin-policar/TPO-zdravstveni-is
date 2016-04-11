{!! Form::open(['route' => ['profile.changePassword', $user->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

@if (Session::has('cahangePassError'))
    <div id="profileChangePassword" class="alert alert-danger" role="alert">Sprememba gesla ni uspela! Vnesli ste napačno trenutno geslo.</div>
@endif
@if (Session::has('cahangedPass'))
    <div id="profileChangePassword" class="alert alert-success" role="alert">Geslo je spremenjeno!</div>
@endif

<div class="sub-title">Sprememba gesla</div>
{{-- Old passwd --}}
<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {!! Form::label('oldPassword', 'Trenutno geslo', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::password('oldPassword', null, $attributes = ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('password'))
            <span class="help-block">{{ $errors->first('oldPassword') }}</span>
        @endif
    </div>
</div>
{{-- New passwd --}}
<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {!! Form::label('password', 'Novo geslo', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::password('password', null, $attributes = ['class' => 'form-control', 'id' => 'password', 'required']) !!}
        @if ($errors->has('password'))
            <span id="profileChangePassword" class="help-block">{{ $errors->first('password') }}</span>
        @endif

        @include('profile.tabs.passCheck')

    </div>
</div>

{{-- Repeat passwd --}}
<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {!! Form::label('newPassword', 'Ponovite novo geslo', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::password('password_confirmation', null, $attributes = ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('password_confirmation'))
            <span id="profileChangePassword" class="help-block">{{ $errors->first('password_confirmation') }}</span>
        @endif
    </div>
</div>


@include('auth.passwords.passStrength')

{{-- Submit button --}}
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Spremeni geslo', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

{!! Form::close() !!}