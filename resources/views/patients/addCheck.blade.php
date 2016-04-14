{!! Form::open(['route' => ['patient.addDate'], 'method' => 'post', 'class' => 'form-horizontal']) !!}

@if (Session::has('CheckAdded'))
    <div class="alert alert-success" role="alert">Prijavljeni ste na pregled</div>
@endif

<?php $d=strtotime("tomorrow");?>
{{-- Date --}}
<div class="form-group">
    {!! Form::label('date', 'Datum', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::date('date', date("Y-m-d", $d), ['class' => 'form-control', 'required']) !!}
    </div>
</div>

{{-- Time --}}
<div class="form-group">
    {!! Form::label('time', 'Ura', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::time('time', date("H:i:s", strtotime("12:00")), ['class' => 'form-control', 'required']) !!}
    </div>
</div>

{{-- Time --}}
<div class="form-group hidden">
    {!! Form::label('time2', 'Ura', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <div class="input-group bootstrap-timepicker timepicker">
            <input id="timepicker2" name="time2" type="text" value="{!! date("H:i:s", strtotime("12:00")) !!}" class="form-control input-small">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-time"></i>
                                                </span>
        </div>
    </div>
</div>

{{-- Note --}}
<div class="form-group">
    {!! Form::label('note', 'Opombe', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('note', null, ['class' => 'form-control', 'required']) !!}
    </div>
</div>

{{-- Patient --}}
<div class="form-group hidden {{ $errors->has('patient_id') ? ' has-error' : '' }}">
    <div class="col-sm-10">
        {!! Form::text('patient', $user->id, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('patient_id'))
            <span class="help-block">{{ $errors->first('patient_id') }}</span>
        @endif
    </div>
</div>

{{-- Doctor --}}
<div class="form-group hidden {{ $errors->has('personal_doctor_id') ? ' has-error' : '' }}">
    <div class="col-sm-10">
        {!! Form::text('doctor', $user->personal_doctor_id, ['class' => 'form-control', 'required', 'oninvalid' => "setCustomValidity('Nimate osebnega zdravnika!')"]) !!}
        @if ($errors->has('personal_doctor_id'))
            <span class="help-block">{{ $errors->first('personal_doctor_id') }}</span>
        @endif
    </div>
</div>

{{-- Submit button --}}
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Prijavite se na pregled', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

{!! Form::close() !!}