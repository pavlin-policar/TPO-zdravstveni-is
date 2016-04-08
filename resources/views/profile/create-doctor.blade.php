@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Kreiraj profil</span>
        <div class="description">Prosim, kreirajte profil.</div>
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
                    <p>Please fill out all the required fields. The required fields are denoted with
                        an asterix (*).</p>
                    {!! Form::open(['route' => 'profile.postCreateDoctor', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                    @include('profile.doctor-profile-data-form')

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