@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Dodaj oskrbovanca</span>
        <div class="description">Dodajte novega oskrbovanca, za katerega boste skrbeli.</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <span class="title">Dodaj oskrbovanca</span>
                    </div>
                </div>
                <div class="card-body">
                    <p>Prosimo, izpolnite vsa zahtevana polja. Zahtevana polja so označena s zvezdico (*).</p>
                    {!! Form::open(['route' => 'charges.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                    @include('charges.charge-form')

                    {{-- Submit button --}}
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {!! Form::submit('Dodaj oskrbovanca', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection