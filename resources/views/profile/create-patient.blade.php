@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Kreiraj profil</span>
        <div class="description">Opis</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Kreiraj profil</div>
                    </div>
                </div>
                <div class="card-body">
                    <p>Prosim izpolnite zahtevana polja, ki so označena z zvezdico (*).</p>
                    {!! Form::open(['route' => 'profile.postCreatePatient', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                    @include('profile.profile-data-form')

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