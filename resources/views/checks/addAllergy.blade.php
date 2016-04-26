{!! Form::open(['route' => ['check.createCode'], 'method' => 'post', 'class' => 'form-horizontal']) !!}

{{-- Check ID --}}
<div class="form-group{{ $errors->has('check') ? ' has-error' : '' }} invisible">
    <div class="col-sm-10">
        {!! Form::text('check', $checkID, ['class' => 'form-control']) !!}
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
            <option value="null">Izberite bolezen ali alergijo</option>
            @foreach($codesDisease as $m)
                <option value="{{ $m->id }}">{{ $m->name }}</option>
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
        {!! Form::date('start', null, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('start'))
            <span class="help-block">{{ $errors->first('start') }}</span>
        @endif
    </div>
</div>
{{-- End --}}
<div class="form-group{{ $errors->has('end') ? ' has-error' : '' }}">
    {!! Form::label('end', 'Izginotje bolezni ali alergije', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::date('end', null, ['class' => 'form-control']) !!}
        @if ($errors->has('end'))
            <span class="help-block">{{ $errors->first('end') }}</span>
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
        {!! Form::submit('Potrdi bolezni ali alergije', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

{!! Form::close() !!}