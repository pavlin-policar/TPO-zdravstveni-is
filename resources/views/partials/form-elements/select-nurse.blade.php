{{-- Personal nurse select box --}}
<div class="form-group{{ $errors->has('nurse_id') ? ' has-error' : '' }}">
    {!! Form::label('nurse_id', 'Medicinska sestra', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('nurse_id', [-1 => 'Izberite medicinsko sestro...'] + $nurses, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('nurse_id'))
            <span id="profileChangeDoctor" class="help-block">{{ $errors->first('nurse_id') }}</span>
        @endif
    </div>
</div>
