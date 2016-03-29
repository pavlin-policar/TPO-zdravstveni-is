@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Kreiraj profil</span>
        <div class="description">Create a profile so you and your doctors have access to your
            personal information.
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Create profile</div>
                    </div>
                </div>
                <div class="card-body">
                    <p>Please fill out all the required fields. The required fields are denoted with
                        an asterix (*).</p>
                    <div class="sub-title">Personal information</div>
                    {!! Form::open(['route' => 'profile.postCreate', 'method' => 'post', 'class' => 'form-horizontal']) !!}
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
                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                        {!! Form::label(null, 'Gender', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <div class="radio3 radio-check radio-inline">
                                {!! Form::radio('gender', 'male', $user->isMale(), ['id' => 'gender-male']) !!}
                                {!! Form::label('gender-male', 'Male', ['class' => 'control-label']) !!}
                            </div>
                            <div class="radio3 radio-check radio-inline">
                                {!! Form::radio('gender', 'female', $user->isFemale(), ['id' => 'gender-female']) !!}
                                {!! Form::label('gender-female', 'Female', ['class' => 'control-label']) !!}
                            </div>
                            @if ($errors->has('gender'))
                                <span class="help-block">{{ $errors->first('gender') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="sub-title">Contact information</div>
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

                    <div class="sub-title">Card numbers</div>
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

                    <div class="sub-title">Doctors</div>
                    {{-- Personal doctor --}}
                    <div class="form-group{{ $errors->has('personalDoctor') ? ' has-error' : '' }}">
                        {!! Form::label('personalDoctor', 'Personal doctor', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('personalDoctor', [-1 => 'Select one', 0 => 'Branko', 1 => 'Stanka'], $user->personalDoctor, ['class' => 'form-control', 'required']) !!}
                            @if ($errors->has('personalDoctor'))
                                <span class="help-block">{{ $errors->first('personalDoctor') }}</span>
                            @endif
                        </div>
                    </div>
                    {{-- Personal dentist --}}
                    <div class="form-group{{ $errors->has('personalDentist') ? ' has-error' : '' }}">
                        {!! Form::label('personalDentist', 'Personal dentist', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('personalDentist', [-1 => 'Select one', 0 => 'Jure', 1 => 'Marija'], $user->personalDentist, ['class' => 'form-control', 'required']) !!}
                            @if ($errors->has('personalDentist'))
                                <span class="help-block">{{ $errors->first('personalDentist') }}</span>
                            @endif
                        </div>
                    </div>
                    {{-- Caretaker --}}
                    <div class="form-group{{ $errors->has('delegate') ? ' has-error' : '' }}">
                        {!! Form::label('delegate', 'Caretaker', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('delegate', [-1 => 'Select one', 0 => 'Jasmin', 1 => 'Amir'], $user->delegate, ['class' => 'form-control', 'required']) !!}
                            @if ($errors->has('delegate'))
                                <span class="help-block">{{ $errors->first('delegate') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {!! Form::submit('Kreiraj profil', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection