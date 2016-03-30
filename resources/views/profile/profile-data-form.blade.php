
<div class="sub-title">Osebni podatki</div>
{{-- First name --}}
<div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
    {!! Form::label('firstName', 'First name', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('firstName', $user->firstName, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('firstName'))
            <span class="help-block">{{ $errors->first('firstName') }}</span>
        @endif
    </div>
</div>
{{-- Last name --}}
<div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
    {!! Form::label('lastName', 'Last name', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('lastName', $user->lastName, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('lastName'))
            <span class="help-block">{{ $errors->first('lastName') }}</span>
        @endif
    </div>
</div>
{{-- Birthday --}}
<div class="form-group{{ $errors->has('birthDate') ? ' has-error' : '' }}">
    {!! Form::label('birthDate', 'Birthday', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::date('birthDate', $user->birthDate, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('birthDate'))
            <span class="help-block">{{ $errors->first('birthDate') }}</span>
        @endif
    </div>
</div>
{{-- Gender --}}
@include('partials.form-elements.radio-gender-buttons-hz')

<div class="sub-title">Kontaktni podatki</div>
{{-- Email --}}
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('email', $user->email, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('email'))
            <span class="help-block">{{ $errors->first('email') }}</span>
        @endif
    </div>
</div>
{{-- Telephone number --}}
<div class="form-group{{ $errors->has('phoneNumber') ? ' has-error' : '' }}">
    {!! Form::label('phoneNumber', 'Telephone number', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('phoneNumber', $user->phoneNumber, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('phoneNumber'))
            <span class="help-block">{{ $errors->first('phoneNumber') }}</span>
        @endif
    </div>
</div>
{{-- Postal code --}}
@include('partials.form-elements.select-postal-codes')
{{-- Address --}}
<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
    {!! Form::label('address', 'Address', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('address', $user->address, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('address'))
            <span class="help-block">{{ $errors->first('address') }}</span>
        @endif
    </div>
</div>

<div class="sub-title">Kartica zdravstvenega zavarovanja</div>
{{-- ZZ Card Number --}}
<div class="form-group{{ $errors->has('ZZCardNumber') ? ' has-error' : '' }}">
    {!! Form::label('ZZCardNumber', 'ZZ Card Number', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('ZZCardNumber', $user->ZZCardNumber, ['class' => 'form-control', 'required']) !!}
        <span class="help-block">Please enter the card id that can be found on the backside of your ZZ card.</span>
        @if ($errors->has('ZZCardNumber'))
            <span class="help-block">{{ $errors->first('ZZCardNumber') }}</span>
        @endif
    </div>
</div>