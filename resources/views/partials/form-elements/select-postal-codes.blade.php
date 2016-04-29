{{-- Postcode select box --}}
<div class="form-group{{ $errors->has('post') ? ' has-error' : '' }}">
    {!! Form::label('post', 'Poštna številka', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('post', [-1 => 'Izberite poštno številko...'] + $postcodes, $user->post, ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('post'))
            <span class="help-block">{{ $errors->first('post') }}</span>
        @endif
    </div>
</div>