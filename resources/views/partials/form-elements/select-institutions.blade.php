{{-- Institution select box --}}
<div class="form-group{{ $errors->has('institution') ? ' has-error' : '' }}">
    {!! Form::label('institution', 'Institution', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('institution', [-1 => 'Select one'] + $institutions, $selectedInstitution, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('institution'))
            <span class="help-block">{{ $errors->first('institution') }}</span>
        @endif
    </div>
</div>