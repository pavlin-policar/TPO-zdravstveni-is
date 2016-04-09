{{-- Institution select box --}}
<div class="form-group{{ $errors->has('institution_id') ? ' has-error' : '' }}">
    {!! Form::label('institution_id', 'Institution', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('institution_id', [-1 => 'Select one'] + $institutions, $selectedInstitution, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('institution_id'))
            <span class="help-block">{{ $errors->first('institution_id') }}</span>
        @endif
    </div>
</div>