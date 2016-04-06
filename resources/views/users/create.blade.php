@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Dodajanje: {{ $type->name }}</span>
        <div class="description">Dodajanje: {{ $type->name }}</div>
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