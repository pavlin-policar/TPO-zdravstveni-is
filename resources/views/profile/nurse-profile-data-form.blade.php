
<div class="sub-title">Osebni podatki</div>
{{-- Doctor number --}}
<div class="form-group{{ $errors->has('doctor_number') ? ' has-error' : '' }}">
    {!! Form::label('doctor_number', 'Šifra medicinske sestre', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('doctor_number', $user->doctorProfile->doctorNumber, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('doctor_number'))
            <span class="help-block">{{ $errors->first('doctor_number') }}</span>
        @endif
    </div>
</div>
{{-- First name --}}
<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
    {!! Form::label('first_name', 'Ime', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('first_name', $user->first_name, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('first_name'))
            <span class="help-block">{{ $errors->first('first_name') }}</span>
        @endif
    </div>
</div>
{{-- Last name --}}
<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
    {!! Form::label('last_name', 'Priimek', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('last_name', $user->last_name, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('last_name'))
            <span class="help-block">{{ $errors->first('last_name') }}</span>
        @endif
    </div>
</div>
{{-- Birthday --}}
<div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
    {!! Form::label('birth_date', 'Datum rojstva', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::date('birth_date', $user->birth_date, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('birth_date'))
            <span class="help-block">{{ $errors->first('birth_date') }}</span>
        @endif
    </div>
</div>
{{-- Gender --}}
@include('partials.form-elements.radio-gender-buttons-hz')

<div class="sub-title">Kontaktni podatki</div>
{{-- Email --}}
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {!! Form::label('email', 'Elektronska pošta', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('email', $user->email, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('email'))
            <span class="help-block">{{ $errors->first('email') }}</span>
        @endif
    </div>
</div>
{{-- Telephone number --}}
<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
    {!! Form::label('phone_number', 'Telefonska številka', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('phone_number', $user->phone_number, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('phone_number'))
            <span class="help-block">{{ $errors->first('phone_number') }}</span>
        @endif
    </div>
</div>

{{-- Institution --}}
@include('partials.form-elements.select-institutions', ['selectedInstitution' => $user->doctorProfile->institution_id])