@extends('layouts.master')
@section('content')

    <div class="page-title">
        <span class="title">Naročanje - termini</span>
        <div class="description">Ustvari urnik prostih terminov</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <span class="title">Termini</span>
                    </div>
                </div>
                <div class="card-body">
                    <p>Prosimo, izpolnite vsa zahtevana polja. Zahtevana polja so označena s zvezdico (*).</p>
                    {!! Form::open(['route' => 'calendar.schedule', 'method' => 'post', 'class' => 'form-horizontal']) !!}


                        <div class="form-group{{ $errors->has('days') ? ' has-error' : '' }}">
                            {!! Form::label('days', 'Ponovite termine za vse:', ['class' => 'col-sm-2 control-label']) !!}

                            <div class="col-sm-10">
                                <?php $labelDays = ['PON', 'TOR', 'SRE', 'ČET', 'PET']; ?>
                                @foreach (range(1,5) as $i)
                                    {!! Form::checkbox('days[]', $i, null, ['id' => 'days-' . $i]) !!}
                                    {!! Form::label('days-' . $i, $labelDays[$i-1]) !!}
                                @endforeach
                                @if ($errors->has('days'))
                                    <span class="help-block">{{ $errors->first('days') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('hourStart') ? ' has-error' : '' }}">
                            {!! Form::label('days[]', 'Začetek in konec pregledov:', ['class' => 'col-sm-2 control-label']) !!}

                            <div class="col-sm-10">
                                {!! Form::label('hourStart', 'OD ure:', ['class' => 'control-label']) !!}
                                {!! Form::time('hourStart', '') !!} <br />

                                @if ($errors->has('hourStart'))
                                    <span class="help-block">{{ $errors->first('hourStart') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('hourEnd') ? ' has-error' : '' }}">

                            <div class="col-lg-offset-2 col-sm-10">
                                {!! Form::label('hourEnd', 'DO ure:', ['class' => 'control-label']) !!}
                                {!! Form::time('hourEnd', '') !!} <br />

                                @if ($errors->has('hourEnd'))
                                    <span class="help-block">{{ $errors->first('hourEnd') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dayStart') ? ' has-error' : '' }}">
                            {!! Form::label('dayStart', 'Prvi delovni dan:', ['class' => 'col-sm-2 control-label']) !!}

                            <div class="col-sm-10">
                                {!! Form::date('dayStart', '') !!} <br />

                                @if ($errors->has('dayStart'))
                                    <span class="help-block">{{ $errors->first('dayStart') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dayEnd') ? ' has-error' : '' }}">
                            {!! Form::label('dayEnd', 'Zadnji delovni dan:', ['class' => 'col-sm-2 control-label']) !!}

                            <div class="col-sm-10">
                                {!! Form::date('dayEnd', '') !!} <br />

                                @if ($errors->has('dayEnd'))
                                    <span class="help-block">{{ $errors->first('dayEnd') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('interval') ? ' has-error' : '' }}">
                            {!! Form::label('intervalLabel', 'Interval terminov (min):', ['class' => 'col-sm-2 control-label']) !!}

                            <div class="col-sm-10">
                                {!! Form::select('interval', ['00:15' => '15', '00:20' => '20', '00:30' => '30'], ['class' => 'control-label']) !!}<br />

                                @if ($errors->has('interval'))
                                    <span class="help-block">{{ $errors->first('interval') }}</span>
                                @endif
                            </div>
                        </div>

                        {{-- Submit button --}}
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                {!! Form::submit('Ustvari urnik pregledov', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection