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