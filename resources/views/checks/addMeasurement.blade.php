{!! Form::open(['route' => ['check.doctor', $dates->id], 'method' => 'get', 'class' => 'form-horizontal']) !!}
{{-- Type --}}
<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
    {!! Form::label('type', 'Meritev', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <select class="form-control select2-hidden-accessible measurementT" required="required" id="measurementType" name="type" tabindex="-1" aria-hidden="true" style="width: 100%">
            <option value="0">Izberite meritev</option>
            @foreach($codesMeasurement as $m)
                @if($typeID == $m->id)
                    <option selected="selected" min="{{ $m->min_value }}" max="{{ $m->max_value }}" value="{{ $m->id }}">{{ $m->name }}</option>
                @else
                    <option min="{{ $m->min_value }}" max="{{ $m->max_value }}" value="{{ $m->id }}">{{ $m->name }}</option>
                @endif
            @endforeach
            @foreach($bigMeasurement as $bigM)
                @if($typeID == $bigM->id)
                    <option selected="selected" min="{{ $bigM->min_value }}" max="{{ $bigM->max_value }}" value="{{ $bigM->id }}">{{ $bigM->name }}</option>
                @else
                    <option min="{{ $bigM->min_value }}" max="{{ $bigM->max_value }}" value="{{ $bigM->id }}">{{ $bigM->name }}</option>
                @endif
            @endforeach
        </select>
        @if ($errors->has('type'))
            <span id="checkMeasurementCode" class="help-block">{{ $errors->first('type') }}</span>
        @endif
    </div>
</div>
{{-- Submit button --}}
<div class="form-group hidden">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Izberi meritev', ['class' => 'btn btn-primary', 'id' => 'showMeasurement']) !!}
    </div>
</div>

{!! Form::close() !!}

@if($selected)
    {!! Form::open(['route' => ['check.createMeasurement'], 'method' => 'post', 'class' => 'form-horizontal']) !!}


    {{-- Check ID --}}
    <div class="form-group{{ $errors->has('check') ? ' has-error' : '' }} hidden">
        <div class="col-sm-10">
            {!! Form::text('check', $checkID, ['class' => 'form-control']) !!}
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

    {{-- Type --}}
    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }} hidden">
        <div class="col-sm-10">
            {!! Form::number('type', $typeID, ['class' => 'form-control', 'required']) !!}
            @if ($errors->has('type'))
                <span class="help-block">{{ $errors->first('type') }}</span>
            @endif
        </div>
    </div>

    {{-- Personal doctor select box --}}
    <div class="form-group{{ $errors->has('provider') ? ' has-error' : '' }}">
        {!! Form::label('provider', 'Zdravnik', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {{--{!! Form::select('doctor',  $doctors, $check->doctor, ['class' => 'form-control', 'required']) !!}--}}
            <select class="form-control select2-hidden-accessible" required="required" id="provider" name="provider" tabindex="-1" aria-hidden="true" style="width: 100%">
                <option value="">Izberite zdravnika</option>
                @foreach($doctors as $d)
                    @if($d->id == $dates->doctor)
                        <option value="{{ $d->id }}" selected="selected">{{ $d->fullName }}</option>
                    @else
                        <option value="{{ $d->id }}">{{ $d->fullName }}</option>
                    @endif
                @endforeach
            </select>
            @if ($errors->has('provider'))
                <span id="checkChangeDoctor" class="help-block">{{ $errors->first('provider') }}</span>
            @endif
        </div>
    </div>

    @if($big)
        <?php $x=0 ?>
        @foreach($measurement->small as $m)
            {{-- Result --}}
            <div class="form-group{{ $errors->has('result') ? ' has-error' : '' }}">
                {!! Form::label("result$x", $m->name, ['class' => 'col-sm-2 control-label', 'id' => 'labelWeight']) !!}
                <div class="col-sm-10">
                    {!! Form::number("result$x", null, ['class' => 'form-control', 'min' => $m->min_value, 'max' => $m->max_value, 'step' => 'any', 'required']) !!}
                    @if ($errors->has('result'))
                        <span class="help-block">{{ $errors->first('result') }}</span>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                </div>
            </div>
            <?php $x++; ?>
        @endforeach
    @else
        {{-- Result --}}
        <div class="form-group{{ $errors->has('result') ? ' has-error' : '' }}">
            {!! Form::label('result', 'Vrednost', ['class' => 'col-sm-2 control-label', 'id' => 'labelWeight']) !!}
            <div class="col-sm-10">
                {!! Form::number("result", null, ['class' => 'form-control', 'min' => $measurement->min_value, 'max' => $measurement->max_value, 'step' => 'any', 'required']) !!}
                @if ($errors->has('result'))
                    <span class="help-block">{{ $errors->first('result') }}</span>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
            </div>
        </div>
    @endif

    {{-- Weight --}}
    <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }} hidden" id="measurementWeight">
        {!! Form::label('weight', 'Teža', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::number('weight', null, ['class' => 'form-control', 'min' => '1', 'max' => '250', 'id' => 'measurementWeightResult', 'step' => 'any']) !!}
            @if ($errors->has('weight'))
                <span class="help-block">{{ $errors->first('weight') }}</span>
            @endif
        </div>
    </div>

    {{-- Date --}}
    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
        {!! Form::label('date', 'Datum', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::date('date', date("Y-m-d", strtotime(Carbon\Carbon::now())), ['class' => 'form-control', 'max' => date("Y-m-d", strtotime(Carbon\Carbon::now())), 'required']) !!}
            @if ($errors->has('date'))
                <span class="help-block">{{ $errors->first('date') }}</span>
            @endif
        </div>
    </div>

    {{-- Time --}}
    <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
        {!! Form::label('time', 'Ura', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::time('time', date("H:i", strtotime(Carbon\Carbon::now('Europe/Ljubljana'))), ['class' => 'form-control', 'required']) !!}
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
@endif