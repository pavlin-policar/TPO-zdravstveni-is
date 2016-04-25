@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Dodajanje navodil in člankov</span>
        <div class="description">dodajanje novega članka ali navodil za določeno bolezen, alergijo ali dieto</div>
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
                    @if(!isset($manual))
                        {!! Form::open(array('route' => 'manuals.postCreate')) !!}
                    @else
                        {!! Form::open(['route' => ['manuals.update', $id]]) !!}
                    @endif
                    {{ csrf_field() }}

                    <div class="form-group">
                        {!! Form::label('name', 'Ime') !!}
                        {!! Form::text('name', $manual['name'], ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Opis') !!}
                        {!! Form::textarea('description', $manual['description'], ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('url_link', 'URL') !!}
                        {!! Form::url('url_link', $manual['url_link'], ['class' => 'form-control']) !!}
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