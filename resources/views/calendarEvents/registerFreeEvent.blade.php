@extends('layouts.master')
@section('content')

    <div class="page-title">
        <span class="title">Naročanje</span>
        <div class="description">Naročite se na prost termin</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <span class="title">Termin: <strong>{!! $time !!}</strong></span>
                    </div>
                </div>
                <div class="card-body">
                    <p>Prosimo, potrdite rezervacijo termina za pregled.</p>
                    {!! Form::open(['route' => array('calendar.registerEvent', 'time' => $time, 'user' => $user), 'method' => 'post', 'class' => 'form-horizontal']) !!}


                    <div class="form-group{{ $errors->has('days') ? ' has-error' : '' }}">
                        {!! Form::label('note', 'Opombe pacienta:', ['class' => 'col-sm-2 control-label']) !!}

                        <div class="col-sm-10">
                            {!! Form::textarea('note', '', ['class' => 'control-label']) !!}
                            @if ($errors->has('note'))
                                <span class="help-block">{{ $errors->first('note') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {!! Form::submit('Rezerviraj termin', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection