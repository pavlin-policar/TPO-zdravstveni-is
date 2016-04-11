@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Dodajanje: {{ $type->name }}</span>
        <div class="description">Dodajte zdravnika</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <span class="title">Dodajanje: {{ $type->name }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <p>Prosimo, izpolnite vsa zahtevana polja. Zahtevana polja so označena s zvezdico (*).</p>
                    {!! Form::open(['route' => 'users.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('person_type', $type->id) !!}


                    {{-- Email --}}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label('email', 'Email*', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::email('email', '', ['class' => 'form-control', 'required']) !!}
                        @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Job title --}}
                    <div class="form-group{{ $errors->has('person_type') ? ' has-error' : '' }}">
                        {!! Form::label('person_type', 'Poklic*', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::select('person_type', array(0 => 'zdravnik', 1 => 'medicinska sestra'), ['class' => 'form-control', 'required']) !!}

                            @if ($errors->has('person_type'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('person_type') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        {!! Form::label('password', 'Geslo*', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::password('password', ['class' => 'form-control', 'required']) !!}

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    {{-- Password Confirmation --}}
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        {!! Form::label('password_confirmation', 'Ponovitev gesla*', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'required']) !!}

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {!! Form::submit('Dodaj', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection