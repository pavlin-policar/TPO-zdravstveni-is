@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Dodajanje šifrantov</span>
        <div class="description">dodajanje novega tipa šifrant</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Izpolnite naslednje podatke</div>
                    </div>
                </div>
                <div class="card-body">

                    {!! Form::open(array('route' => 'codeTypes.postCreate')) !!}
                    {{ csrf_field() }}

                    <div class="form-group">
                        {!! Form::label('name', 'Ime vrste šifranta') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Opis vrste šifranta') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Potrdi', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection