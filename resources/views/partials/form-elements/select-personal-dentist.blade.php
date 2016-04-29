{{-- Personal dentist select box --}}
<div class="form-group{{ $errors->has('personal_dentist_id') ? ' has-error' : '' }}">
    {!! Form::label('personal_dentist_id', 'Osebni zobozdravnik', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('personal_dentist_id', [-1 => 'Izberite osebnega zobozdravnika...'] + $dentists, $selectedDentist, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('personal_dentist_id'))
            <span id="profileChangeDoctor" class="help-block">{{ $errors->first('personal_dentist_id') }}</span>
        @endif
    </div>
</div>