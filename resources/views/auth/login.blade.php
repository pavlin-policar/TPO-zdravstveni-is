@extends('layouts.showcase')

@section('content')
    <div class="login-box">
        <div>
            <div class="login-form row">
                <div class="col-sm-12 text-center login-header">
                    <i class="login-logo fa fa-heartbeat fa-5x"></i>
                    <h4 class="login-title">Zdravstveni informacijski sistem</h4>
                </div>
                <div class="col-sm-12">
                    <div class="login-body">
                        <div class="progress hidden" id="login-progress">
                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                Prijava
                            </div>
                        </div>
                        <form action="{{ url('/login') }}" method="post">
                            {!! csrf_field() !!}
                            <div class="control">
                                <input type="email" name="email" class="form-control" placeholder="Elektronski naslov" value="{{ old('email') }}"/>
                            </div>
                            <div class="control">
                                <input type="password" name="password" class="form-control" placeholder="Geslo"/>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        {{ $errors->first('email') }}
                                    </span>
                            @endif
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        {{ $errors->first('password') }}
                                    </span>
                            @endif
                            <div class="checkbox text-left">
                                <label>
                                    <input type="checkbox" name="remember">Zapomni si me
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 text-center" style="margin-bottom: 0">
                                    <button type="submit" class="btn btn-primary">Prijavi se</button>
                                    <a href="{{ url('/register') }}" class="btn btn-default">Registracija</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="login-footer">
                        <span class="text-right"><a href="{{ url('/password/reset') }}" class="color-white">Pozabljeno
                                geslo?</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
