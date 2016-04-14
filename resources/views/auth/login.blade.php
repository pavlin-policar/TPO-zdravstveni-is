<!DOCTYPE html>
<html>

<head>
    <title>Zdravstveni informacijski sistem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Fonts --}}
    {{ Html::style('http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400') }}
    {{ Html::style('http://fonts.googleapis.com/css?family=Lato:300,400,700,900') }}
    {{-- Vendor stylesheets --}}
    {{ Html::style('vendor/css/bootstrap.min.css') }}
    {{ Html::style('vendor/css/font-awesome.min.css') }}
    {{ Html::style('vendor/css/animate.min.css') }}
    {{ Html::style('vendor/css/bootstrap-switch.min.css') }}
    {{ Html::style('vendor/css/checkbox3.min.css') }}
    {{ Html::style('vendor/css/jquery.dataTables.min.css') }}
    {{ Html::style('vendor/css/dataTables.bootstrap.css') }}
    {{ Html::style('vendor/css/select2.min.css') }}
    {{-- App stylesheets --}}
    {{ Html::style('css/style.css') }}
    {{ Html::style('css/themes/flat-blue.css') }}
</head>

<body class="flat-blue login-page">
<div class="container">
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
                                Log In...
                            </div>
                        </div>
                        <form action="{{ url('/login') }}" method="post">
                            {!! csrf_field() !!}
                            <div class="control">
                                <input type="email" name="email" class="form-control" placeholder="Elektronski naslov" value="{{ old('email') }}" />
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
                                    <input type="checkbox" name="remember">Zapomni se me
                                </label>
                            </div>
                            <div class="login-button text-center">
                                <input type="submit" class="btn btn-primary" value="Prijava">
                            </div>
                        </form>
                    </div>
                    <div class="login-footer">
                        <span class="text-right"><a href="{{ url('/password/reset') }}" class="color-white">Pozabljeno geslo?</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Vendor scripts --}}
{{ Html::script('vendor/js/jquery.min.js') }}
{{ Html::script('vendor/js/bootstrap.min.js') }}
{{ Html::script('vendor/js/Chart.min.js') }}
{{ Html::script('vendor/js/bootstrap-switch.min.js') }}
{{ Html::script('vendor/js/jquery.matchHeight-min.js') }}
{{ Html::script('vendor/js/jquery.dataTables.min.js') }}
{{ Html::script('vendor/js/dataTables.bootstrap.min.js') }}
{{ Html::script('vendor/js/select2.full.min.js') }}
{{ Html::script('vendor/js/ace/ace.js') }}
{{ Html::script('vendor/js/ace/mode-html.js') }}
{{ Html::script('vendor/js/ace/theme-github.js') }}
{{ Html::script('vendor/js/bootstrap-timepicker.min.js') }}

{{-- App scripts --}}
{{ Html::script('js/app.js') }}
{{ Html::script('js/zis-compiled.js') }}
</body>

</html>
