@extends('layouts.showcase-split-logo')

@section('panel-title')
    <span class="title">Ponovno pošlji aktivacijsko kodo</span>
@endsection

@section('panel-content')
    <p>Prosimo, vnesite elektronski naslov, ki ste ga uporabili ob registraciji vašega računa.</p>

    <div class="form-group{{ Session::has('resend_success') ? ' has-error' : '' }}">
        @if (Session::has('resend_success'))
            <span class="help-block">
                        <strong>{!! session('resend_success') !!}</strong>
                    </span>
        @endif
    </div>

    <form class="form-inline" role="form" method="POST" action="{{ route('registration.resend-email') }}">
        {!! csrf_field() !!}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" class="form-control" name="email" id="email" placeholder="Elektronski naslov" size="30">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-sign-in"></i>&nbsp;Pošlji aktivacijsko kodo
        </button>
    </form>
@endsection