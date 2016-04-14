{{-- Personal doctor select box --}}
<div class="form-group{{ $errors->has('personal_doctor_id') ? ' has-error' : '' }}">
    {!! Form::label('personal_doctor_id', 'Personal doctor', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('personal_doctor_id', [-1 => 'Select one'] + $doctors, $selectedDoctor, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('personal_doctor_id'))
            <span id="profileChangeDoctor" class="help-block">{{ $errors->first('personal_doctor_id') }}</span>
        @endif
    </div>
</div>