@extends('layouts.showcase-split-logo')

@section('panel-title')
    <span class="title">Aktiviraj račun</span>
@endsection

@section('panel-content')
    <p>Prosim vnesite aktivacijsko kodo, ki ste jo prejeli na elektronski naslov, ki
        ste ga vnesli ob registraciji.</p>
    <p>Če niste prejeli elektronskega naslova se obrnite na skrbnika informacijskega
        sistema.</p>

    <form class="form-inline" role="form" method="POST" action="{{ route('registration.do-confirm-email') }}">
        {!! csrf_field() !!}
        <div class="form-group{{ $errors->has('confirmationCode') ? ' has-error' : '' }}">
            <input type="confirmationCode" class="form-control" name="confirmationCode" id="confirmationCode" placeholder="Aktivacijska koda" size="30">
            @if ($errors->has('confirmationCode'))
                <span class="help-block">
                    <strong>{{ $errors->first('confirmationCode') }}</strong>
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-sign-in"></i>&nbsp;Aktiviraj račun
        </button>
        {!! link_to('/logout', 'Odjava', ['class' => 'btn btn-default']) !!}
    </form>
@endsection
