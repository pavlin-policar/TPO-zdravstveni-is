{!! Form::open(['route' => ['check.create'], 'method' => 'post', 'class' => 'form-horizontal']) !!}

{{-- Doctor date --}}
<div class="form-group{{ $errors->has('doctor_date') ? ' has-error' : '' }} invisible">
    <div class="col-sm-10">
        {!! Form::text('doctor_date', $dates->id, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('doctor_date'))
            <span class="help-block">{{ $errors->first('doctor_date') }}</span>
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
            <option value="null">Izberite zdravnika</option>
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
        {!! Form::textarea('note', null, ['class' => 'form-control', 'required']) !!}
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