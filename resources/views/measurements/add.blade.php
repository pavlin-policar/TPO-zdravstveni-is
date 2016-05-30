@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card yellow card-header">
                    <div class="card-title">
                        <div class="title title-white">Nova meritev</div>
                    </div>
                    <div class="fa fa-compress icon-arrow-right" id="glyphicon-measurments"></div>
                </div>
                <div class="card-body no-padding" id="dash-measurments">

                    @if (Session::has('msg'))
                        <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('msg') }}
                        </div>
                    @endif

                {!! Form::open(['route' => ['measurement.add'], 'method' => 'post', 'class' => 'form-horizontal']) !!}

                {{-- Patient id --}}
                <div class="form-group{{ $errors->has('patient') ? ' has-error' : '' }} invisible">
                    <div class="col-sm-10">
                        {!! Form::text('patient', $patient->id, ['class' => 'form-control', 'required']) !!}
                        @if ($errors->has('patient'))
                            <span class="help-block">{{ $errors->first('patient') }}</span>
                        @endif
                    </div>
                </div>

                {{-- Provider id --}}
                <div class="form-group{{ $errors->has('provider') ? ' has-error' : '' }} hidden">
                    <div class="col-sm-10">
                        {!! Form::text('provider', $patient->id, ['class' => 'form-control', 'required']) !!}
                        @if ($errors->has('provider'))
                            <span class="help-block">{{ $errors->first('provider') }}</span>
                        @endif
                    </div>
                </div>

                {{-- Type --}}
                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                    {!! Form::label('type', 'Meritev', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        <select class="form-control select2-hidden-accessible measurementT" required="required" id="measurementType" name="type" tabindex="-1" aria-hidden="true" style="width: 100%">
                            <option value="">Izberite meritev</option>
                            @foreach($codesMeasurement as $m)
                                <option min="{{ $m->min_value }}" max="{{ $m->max_value }}" value="{{ $m->id }}">{{ $m->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('type'))
                            <span id="checkMeasurementCode" class="help-block">{{ $errors->first('type') }}</span>
                        @endif
                    </div>
                </div>

                {{-- Result --}}
                <div class="form-group{{ $errors->has('result') ? ' has-error' : '' }}">
                    {!! Form::label('result', 'Vrednost', ['class' => 'col-sm-2 control-label', 'id' => 'labelWeight']) !!}
                    <div class="col-sm-10">
                        {!! Form::number('result', null, ['class' => 'form-control measurementR', 'required', 'id' => 'measurementResult', 'step' => 'any']) !!}
                        @if ($errors->has('result'))
                            <span class="help-block">{{ $errors->first('result') }}</span>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                    </div>
                </div>
                {{-- Weight --}}
                <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }} hidden" id="measurementWeight">
                    {!! Form::label('weight', 'Teža', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::number('weight', null, ['class' => 'form-control', 'min' => '1', 'max' => '250', 'id' => 'measurementWeightResult', 'step' => 'any']) !!}
                        @if ($errors->has('weight'))
                            <span class="help-block">{{ $errors->first('weight') }}</span>
                        @endif
                    </div>
                </div>

                {{-- Date --}}
                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                    {!! Form::label('date', 'Datum', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::date('date', date("Y-m-d", strtotime(Carbon\Carbon::now())), ['class' => 'form-control', 'required']) !!}
                        @if ($errors->has('date'))
                            <span class="help-block">{{ $errors->first('date') }}</span>
                        @endif
                    </div>
                </div>

                {{-- Time --}}
                <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                    {!! Form::label('time', 'Ura', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::time('time', date("H:i", strtotime(Carbon\Carbon::now('Europe/Ljubljana'))), ['class' => 'form-control', 'required']) !!}
                        @if ($errors->has('time'))
                            <span class="help-block">{{ $errors->first('time') }}</span>
                        @endif
                    </div>
                </div>

                {{-- Submit button --}}
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {!! Form::submit('Potrdi meritev', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>

                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection