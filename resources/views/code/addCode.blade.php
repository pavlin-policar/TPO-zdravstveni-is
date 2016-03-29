@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Dodajanje šifrantov k skupini {{ $codeType }}</span>
        <div class="description">dodajanje novega šifranta</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Izpolnite naslednje podatke</div>
                        <a href="../{{ $id }}" type="button" class="btn btn-success">Vrnite se nazaj</a>
                    </div>
                </div>
                <div class="card-body">

                    {!! Form::open(['url' => 'addCode']) !!}
                    {{ csrf_field() }}

                    <div class="form-group">
                        {!! Form::label('codeName', 'Ime šifranta') !!}
                        {!! Form::text('codeName', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('codeDescription', 'Opis šifranta') !!}
                        {!! Form::textarea('codeDescription', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('minValue', 'Minimalna vrednost') !!}
                        {!! Form::number('minValue', null, ['class' => 'form-control','step'=>'any']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('maxValue', 'Maksimalna vrednost') !!}
                        {!! Form::number('maxValue', null, ['class' => 'form-control','step'=>'any']) !!}
                    </div>

                    {{ Form::hidden('codeType', $id) }}
                    <div class="form-group">
                        {!! Form::submit('Potrdi', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection