{{-- Gender --}}
<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
    {!! Form::label(null, 'Spol', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <div class="radio3 radio-check radio-inline">
            {!! Form::radio('gender', $male->id, $user->isMale(), ['id' => 'gender-male']) !!}
            {!! Form::label('gender-male', 'Moški', ['class' => 'control-label']) !!}
        </div>
        <div class="radio3 radio-check radio-inline">
            {!! Form::radio('gender', $female->id, $user->isFemale(), ['id' => 'gender-female']) !!}
            {!! Form::label('gender-female', 'Ženski', ['class' => 'control-label']) !!}
        </div>
        @if ($errors->has('gender'))
            <span class="help-block">{{ $errors->first('gender') }}</span>
        @endif
    </div>
</div>