@extends('layouts.master')

@section('content')
    @foreach($checks as $check)
    <div class="row  no-margin-bottom">
        <div class="col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="card card-no-padding">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="title">Vaš pregled </div>
                            </div>
                            <div class="fa fa-compress icon-arrow-right" id="glyphicon-check-old"></div>
                        </div>
                        <div class="card-body no-padding">
                            {!! Form::open(['route' => ['check.update', $check->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

                            {{-- ID --}}
                            <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }} invisible">
                                <div class="col-sm-10">
                                    {!! Form::text('id', $check->id, ['class' => 'form-control']) !!}
                                    @if ($errors->has('id'))
                                        <span class="help-block">{{ $errors->first('id') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Doctor date --}}
                            <div class="form-group{{ $errors->has('doctor_date') ? ' has-error' : '' }} hidden">
                                <div class="col-sm-10">
                                    {!! Form::text('doctor_date', $dates->id, ['class' => 'form-control']) !!}
                                    @if ($errors->has('doctor_date'))
                                        <span class="help-block">{{ $errors->first('doctor_date') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Patient id --}}
                            <div class="form-group{{ $errors->has('patient') ? ' has-error' : '' }} hidden">
                                <div class="col-sm-10">
                                    {!! Form::text('patient', $dates->patient, ['class' => 'form-control']) !!}
                                    @if ($errors->has('patient'))
                                        <span class="help-block">{{ $errors->first('patient') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Patient  --}}
                            <div class="form-group{{ $errors->has('pacient') ? ' has-error' : '' }}">
                                {!! Form::label('pacient', 'Pacient', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('pacient', $patient->fullName, ['class' => 'form-control', 'disabled']) !!}
                                    @if ($errors->has('pacient'))
                                        <span class="help-block">{{ $errors->first('pacient') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Personal doctor select box --}}
                            <div class="form-group{{ $errors->has('doctor') ? ' has-error' : '' }}">
                                {!! Form::label('doctor', 'Zdravnik', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {{--{!! Form::select('doctor',  $doctors, $check->doctor, ['class' => 'form-control', 'required']) !!}--}}
                                    <select class="form-control select2-hidden-accessible" required="required" id="doctor" name="doctor" tabindex="-1" aria-hidden="true" style="width: 100%">
                                        @foreach($doctors as $d)
                                            @if($d->id == $dates->doctor)
                                                <option value="{{ $d->id }}" selected="selected">{{ $d->fullName }}</option>
                                            @else
                                                <option value="{{ $d->id }}">{{ $d->fullName }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('doctor'))
                                        <span id="checkChangeDoctor" class="help-block">{{ $errors->first('doctor') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Time --}}
                            <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                                {!! Form::label('time', 'Datum', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::datetime('time', date("d.m.Y H:i",strtotime($dates->time)), ['class' => 'form-control', 'disabled']) !!}
                                    @if ($errors->has('time'))
                                        <span class="help-block">{{ $errors->first('time') }}</span>
                                    @endif
                                </div>
                            </div>
                            {{-- Note --}}
                            <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                {!! Form::label('note', 'Opombe', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('note', $check->note, ['class' => 'form-control', 'required']) !!}
                                    @if ($errors->has('note'))
                                        <span class="help-block">{{ $errors->first('note') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Submit button --}}
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    {!! Form::submit('Potrdi pregled', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card yellow card-header">
                            <div class="card-title">
                                <div class="title title-white">Meritve</div>
                            </div>
                            <div class="fa fa-compress icon-arrow-right" id="glyphicon-measurments"></div>
                        </div>
                        <div class="card-body no-padding" id="dash-measurments">
                            @foreach ($checkMeasurement[$check->id] as $d)
                                {!! Form::open(['route' => ['check.updateMeasurement', $d->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

                                {{-- Check ID --}}
                                <div class="form-group{{ $errors->has('check') ? ' has-error' : '' }} invisible">
                                    <div class="col-sm-10">
                                        {!! Form::text('check', $check->id, ['class' => 'form-control']) !!}
                                        @if ($errors->has('id'))
                                            <span class="help-block">{{ $errors->first('check') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Patient id --}}
                                <div class="form-group{{ $errors->has('patient') ? ' has-error' : '' }} hidden">
                                    <div class="col-sm-10">
                                        {!! Form::text('patient', $dates->patient, ['class' => 'form-control', 'required']) !!}
                                        @if ($errors->has('patient'))
                                            <span class="help-block">{{ $errors->first('patient') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Personal doctor select box --}}
                                <div class="form-group{{ $errors->has('provider') ? ' has-error' : '' }}">
                                    {!! Form::label('provider', 'Zdravnik', ['class' => 'col-sm-2 control-label']) !!}
                                    <div class="col-sm-10">
                                        {{--{!! Form::select('doctor',  $doctors, $check->doctor, ['class' => 'form-control', 'required']) !!}--}}
                                        <select class="form-control select2-hidden-accessible" required="required" id="provider" name="provider" tabindex="-1" aria-hidden="true" style="width: 100%">
                                            <option value="null">Izberite zdravnika</option>
                                            @foreach($doctors as $doc)
                                                @if($doc->id == $d->doctor)
                                                    <option value="{{ $doc->id }}" selected="selected">{{ $doc->fullName }}</option>
                                                @else
                                                    <option value="{{ $doc->id }}">{{ $doc->fullName }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('provider'))
                                            <span id="checkChangeDoctor" class="help-block">{{ $errors->first('provider') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Type --}}
                                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                    {!! Form::label('type', 'Meritev', ['class' => 'col-sm-2 control-label']) !!}
                                    <div class="col-sm-10">
                                        <select class="form-control select2-hidden-accessible measurementT" required="required" id="measurementTypeShow" name="type" tabindex="-1" aria-hidden="true" style="width: 100%">
                                            <option value="null">Izberite meritev</option>
                                            @foreach($codesMeasurement as $m)
                                                @if($d->type == $m->id)
                                                    <option selected="selected" min="{{ $m->min_value }}" max="{{ $m->max_value }}" value="{{ $m->id }}">{{ $m->name }}</option>
                                                @else
                                                    <option min="{{ $m->min_value }}" max="{{ $m->max_value }}" value="{{ $m->id }}">{{ $m->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('type'))
                                            <span id="checkMeasurementCode" class="help-block">{{ $errors->first('type') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Result --}}
                                <div class="form-group{{ $errors->has('result') ? ' has-error' : '' }}">
                                    {!! Form::label('result', 'Vrednost', ['class' => 'col-sm-2 control-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::number('result', $d->result, ['class' => 'form-control measurementR', 'required', 'id' => 'measurementResultShow', 'step' => 'any']) !!}
                                        @if ($errors->has('result'))
                                            <span class="help-block">{{ $errors->first('result') }}</span>
                                        @endif
                                        @if (Session::has('error'))
                                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Date --}}
                                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                    {!! Form::label('date', 'Datum', ['class' => 'col-sm-2 control-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::date('date', date("Y-m-d", strtotime($d->time)), ['class' => 'form-control', 'required']) !!}
                                        @if ($errors->has('date'))
                                            <span class="help-block">{{ $errors->first('date') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Time --}}
                                <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                                    {!! Form::label('time', 'Ura', ['class' => 'col-sm-2 control-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::time('time', date("H:i", strtotime($d->time)), ['class' => 'form-control', 'required']) !!}
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
                            @endforeach

                            @include('checks.addMeasurement', ['checkID' => $check->id, 'dates'=> $dates])

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="card red card-header">
                                <div class="card-title">
                                    <div class="title title-white">Zdravila</div>
                                </div>
                                <div class="fa fa-compress icon-arrow-right" id="glyphicon-medical"></div>
                            </div>
                            <div class="card-body no-padding" id="dash-medical">
                                @foreach ($checkData[$check->id] as $d)
                                    @if($d->code_type == 14)
                                        {!! Form::open(['route' => ['check.updateCode', $d->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

                                        {{-- ID --}}
                                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }} invisible">
                                            <div class="col-sm-10">
                                                {!! Form::text('id', $d->id, ['class' => 'form-control']) !!}
                                                @if ($errors->has('id'))
                                                    <span class="help-block">{{ $errors->first('id') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Check ID --}}
                                        <div class="form-group{{ $errors->has('check') ? ' has-error' : '' }} hidden">
                                            <div class="col-sm-10">
                                                {!! Form::text('check', $d->check, ['class' => 'form-control']) !!}
                                                @if ($errors->has('id'))
                                                    <span class="help-block">{{ $errors->first('check') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Code --}}
                                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                            {!! Form::label('code', 'Zdravila', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                <select class="form-control select2-hidden-accessible" required="required" id="code" name="code" tabindex="-1" aria-hidden="true" style="width: 100%">
                                                    @foreach($codesMedical as $m)
                                                        @if($m->id == $d->code)
                                                            <option value="{{ $m->id }}" selected="selected">{{ $m->name }}</option>
                                                        @else
                                                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('code'))
                                                    <span id="checkMedicalCode" class="help-block">{{ $errors->first('code') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Start taking --}}
                                        <div class="form-group{{ $errors->has('start') ? ' has-error' : '' }}">
                                            {!! Form::label('start', 'Začetek jemanja', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::date('start', date("Y-m-d",strtotime($d->start)), ['class' => 'form-control', 'required']) !!}
                                                @if ($errors->has('start'))
                                                    <span class="help-block">{{ $errors->first('start') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- End taking --}}
                                        <div class="form-group{{ $errors->has('end') ? ' has-error' : '' }}">
                                            {!! Form::label('end', 'Konec jemanja', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::date('end', date("Y-m-d",strtotime($d->end)), ['class' => 'form-control']) !!}
                                                @if ($errors->has('end'))
                                                    <span class="help-block">{{ $errors->first('end') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- Note --}}
                                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                            {!! Form::label('note', 'Opombe', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::textarea('note', $d->note, ['class' => 'form-control', 'required']) !!}
                                                @if ($errors->has('note'))
                                                    <span class="help-block">{{ $errors->first('note') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Submit button --}}
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                {!! Form::submit('Potrdi zdravila', ['class' => 'btn btn-primary']) !!}
                                            </div>
                                        </div>

                                        {!! Form::close() !!}
                                    @endif
                                @endforeach

                                    @include('checks.addMedical', ['checkID' => $check->id])

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <div class="card-title">
                                    <div class="title title-white">Bolezni in alergije</div>
                                </div>
                                <div class="fa fa-compress icon-arrow-right" id="glyphicon-allergy"></div>
                            </div>
                            <div class="card-body no-padding" id="dash-allergy">
                                @foreach ($checkData[$check->id] as $d)
                                    @if($d->code_type == 13)
                                        {!! Form::open(['route' => ['check.updateCode', $check->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

                                        {{-- ID --}}
                                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }} invisible">
                                            {!! Form::label('id', 'ID', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::text('id', $d->id, ['class' => 'form-control']) !!}
                                                @if ($errors->has('id'))
                                                    <span class="help-block">{{ $errors->first('id') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Check ID --}}
                                        <div class="form-group{{ $errors->has('check') ? ' has-error' : '' }} hidden">
                                            <div class="col-sm-10">
                                                {!! Form::text('check', $d->check, ['class' => 'form-control']) !!}
                                                @if ($errors->has('id'))
                                                    <span class="help-block">{{ $errors->first('check') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Code --}}
                                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                            {!! Form::label('code', 'Bolezen ali alergija', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                <select class="form-control select2-hidden-accessible" required="required" id="code" name="code" tabindex="-1" aria-hidden="true" style="width: 100%">
                                                    @foreach($codesDisease as $m)
                                                        @if($m->id == $d->code)
                                                            <option value="{{ $m->id }}" selected="selected">{{ $m->name }}</option>
                                                        @else
                                                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('code'))
                                                    <span id="checkDiseaseCode" class="help-block">{{ $errors->first('code') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Start --}}
                                        <div class="form-group{{ $errors->has('start') ? ' has-error' : '' }}">
                                            {!! Form::label('start', 'Pojavitev bolezni ali alergije', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::date('start', date("Y-m-d",strtotime($d->start)), ['class' => 'form-control', 'required']) !!}
                                                @if ($errors->has('start'))
                                                    <span class="help-block">{{ $errors->first('start') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- End --}}
                                        <div class="form-group{{ $errors->has('end') ? ' has-error' : '' }}">
                                            {!! Form::label('end', 'Izginotje bolezni ali alergije', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::date('end', date("Y-m-d",strtotime($d->end)), ['class' => 'form-control']) !!}
                                                @if ($errors->has('end'))
                                                    <span class="help-block">{{ $errors->first('end') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- Note --}}
                                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                            {!! Form::label('note', 'Opombe', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::textarea('note', $d->note, ['class' => 'form-control', 'required']) !!}
                                                @if ($errors->has('note'))
                                                    <span class="help-block">{{ $errors->first('note') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Submit button --}}
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                {!! Form::submit('Potrdi bolezni ali alergije', ['class' => 'btn btn-primary']) !!}
                                            </div>
                                        </div>

                                        {!! Form::close() !!}
                                    @endif
                                @endforeach

                                    @include('checks.addAllergy', ['checkID' => $check->id])

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <div class="card-title">
                                    <div class="title title-white">Diete</div>
                                </div>
                                <div class="fa fa-compress icon-arrow-right" id="glyphicon-diet"></div>
                            </div>
                            <div class="card-body no-padding" id="dash-diet">
                                @foreach ($checkData[$check->id] as $d)
                                    @if($d->code_type == 12)
                                        {!! Form::open(['route' => ['check.updateCode', $check->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

                                        {{-- ID --}}
                                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }} invisible">
                                            {!! Form::label('id', 'ID', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::text('id', $d->id, ['class' => 'form-control']) !!}
                                                @if ($errors->has('id'))
                                                    <span class="help-block">{{ $errors->first('id') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Check ID --}}
                                        <div class="form-group{{ $errors->has('check') ? ' has-error' : '' }} hidden">
                                            <div class="col-sm-10">
                                                {!! Form::text('check', $d->check, ['class' => 'form-control']) !!}
                                                @if ($errors->has('id'))
                                                    <span class="help-block">{{ $errors->first('check') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Code --}}
                                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                            {!! Form::label('code', 'Dieta', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                <select class="form-control select2-hidden-accessible" required="required" id="code" name="code" tabindex="-1" aria-hidden="true" style="width: 100%">
                                                    @foreach($codesDiet as $m)
                                                        @if($m->id == $d->code)
                                                            <option value="{{ $m->id }}" selected="selected">{{ $m->name }}</option>
                                                        @else
                                                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('code'))
                                                    <span id="checkDietCode" class="help-block">{{ $errors->first('code') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Start --}}
                                        <div class="form-group{{ $errors->has('start') ? ' has-error' : '' }}">
                                            {!! Form::label('start', 'Začetek diete', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::date('start', date("Y-m-d",strtotime($d->start)), ['class' => 'form-control', 'required']) !!}
                                                @if ($errors->has('start'))
                                                    <span class="help-block">{{ $errors->first('start') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- End --}}
                                        <div class="form-group{{ $errors->has('end') ? ' has-error' : '' }}">
                                            {!! Form::label('end', 'Konec diete', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::date('end', date("Y-m-d",strtotime($d->end)), ['class' => 'form-control']) !!}
                                                @if ($errors->has('end'))
                                                    <span class="help-block">{{ $errors->first('end') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- Note --}}
                                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                            {!! Form::label('note', 'Opombe', ['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::textarea('note', $d->note, ['class' => 'form-control', 'required']) !!}
                                                @if ($errors->has('note'))
                                                    <span class="help-block">{{ $errors->first('note') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Submit button --}}
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                {!! Form::submit('Potrdi dieto', ['class' => 'btn btn-primary']) !!}
                                            </div>
                                        </div>

                                        {!! Form::close() !!}
                                    @endif
                                @endforeach

                                    @include('checks.addDiet', ['checkID' => $check->id])

                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @endforeach

    <div class="row  no-margin-bottom">
        <div class="col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="card card-no-padding">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="title">Dodaj pregled</div>
                            </div>
                            <div class="fa fa-compress icon-arrow-right" id="glyphicon-check-old"></div>
                        </div>
                        <div class="card-body no-padding">
                             @include('checks.addCheck')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection