<div class="sub-title">Izbris računa</div>
<p>Če si izbrišete račun ne boste mogli več uporabljati informacijskega sistema. Podatke, ki ste jih vnesli v sistem bodo ohranjeni in na voljo vašim nadaljnim zdravnikom.</p>
<p>V primeru, da se premislite in boste želeli spet aktivirati račun, pišite administratorju na elektronsko pošto.</p>

{!! Form::open(['route' => ['profile.delete-account', $user->id], 'method' => 'delete', 'class' => 'form-horizontal']) !!}

{{-- Last name --}}
<div class="form-group{{ $errors->has('rm-password') ? ' has-error' : '' }}">
    {!! Form::label('rm-password', 'Geslo', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::password('rm-password', ['class' => 'form-control', 'required']) !!}
        <span class="help-block">Vnesite svoje geslo za izbris računa.</span>
        @if ($errors->has('rm-password'))
            <span class="help-block">{{ $errors->first('rm-password') }}</span>
        @endif
    </div>
</div>

{{-- Submit button --}}
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Izbriši moj račun', ['class' => 'btn btn-danger']) !!}
    </div>
</div>

{!! Form::close() !!}
