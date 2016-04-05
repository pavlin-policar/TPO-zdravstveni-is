@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Dodajanje in urejanje šifrantov v skupini {{ $codeType }}</span>
        <div class="description">dodajanje novega oziroma urejnje obstoječega šifranta</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Izpolnite naslednje podatke</div>
                        {!! link_to_route('codeTypes.show', 'Vrnite se nazaj', ['id' => $back ], ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                <div class="card-body">

                    @if(!isset($code))
                        {!! Form::open(array('route' => 'code.postCreate')) !!}
                    @else
                        {!! Form::open(['route' => ['code.update', $id]]) !!}
                    @endif
                    {{ csrf_field() }}

                    @include('code.codeItems')

                    <div class="form-group">
                        {!! Form::submit('Potrdi', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection