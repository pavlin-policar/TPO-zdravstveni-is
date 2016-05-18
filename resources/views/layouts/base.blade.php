<!DOCTYPE html>
<html>
<head>
    <title>TPO Zdravstveni IS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/favicon-heartbeat.ico') }}">
    {{-- Fonts --}}
    {{ Html::style('http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400') }}
    {{ Html::style('http://fonts.googleapis.com/css?family=Lato:300,400,700,900') }}
    {{-- Vendor stylesheets --}}
    {{ Html::style('vendor/css/dragdrop.css') }}
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
    {{ Html::script('https://fb.me/react-15.0.2.min.js') }}
    {{ Html::script('https://fb.me/react-dom-15.0.2.min.js') }}

    {{-- App scripts --}}
    {{ Html::script('js/app-compiled.js') }}
    {{ Html::script('js/zis-compiled.js') }}
</head>
@yield('body')
</html>
