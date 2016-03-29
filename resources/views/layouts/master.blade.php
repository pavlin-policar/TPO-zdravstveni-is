<!DOCTYPE html>
<html>
<head>
    <title>TPO Zdravstveni IS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Fonts --}}
    {{ Html::style('http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400') }}
    {{ Html::style('http://fonts.googleapis.com/css?family=Lato:300,400,700,900') }}
    {{-- Vendor stylesheets --}}
    {{ Html::style('lib/css/bootstrap.min.css') }}
    {{ Html::style('lib/css/font-awesome.min.css') }}
    {{ Html::style('lib/css/animate.min.css') }}
    {{ Html::style('lib/css/bootstrap-switch.min.css') }}
    {{ Html::style('lib/css/checkbox3.min.css') }}
    {{ Html::style('lib/css/jquery.dataTables.min.css') }}
    {{ Html::style('lib/css/dataTables.bootstrap.css') }}
    {{ Html::style('lib/css/select2.min.css') }}
    {{-- App stylesheets --}}
    {{ Html::style('css/style.css') }}
    {{ Html::style('css/themes/flat-blue.css') }}
</head>

<body class="flat-blue">
<div class="app-container">
    <div class="row content-container">
        {{-- Bar on top --}}
        @include('partials.navbar')
        {{-- Bar to the side --}}
        @include('partials.sidebar')
        <div class="container-fluid">
            <div class="side-body">
                @yield('content')
            </div>
        </div>
    </div>
    @include('partials.footer')
</div>
{{-- Vendor scripts --}}
{{ Html::script('lib/js/jquery.min.js') }}
{{ Html::script('lib/js/bootstrap.min.js') }}
{{ Html::script('lib/js/Chart.min.js') }}
{{ Html::script('lib/js/bootstrap-switch.min.js') }}
{{ Html::script('lib/js/jquery.matchHeight-min.js') }}
{{ Html::script('lib/js/jquery.dataTables.min.js') }}
{{ Html::script('lib/js/dataTables.bootstrap.min.js') }}
{{ Html::script('lib/js/select2.full.min.js') }}
{{ Html::script('lib/js/ace/ace.js') }}
{{ Html::script('lib/js/ace/mode-html.js') }}
{{ Html::script('lib/js/ace/theme-github.js') }}
{{-- App scripts --}}
{{ Html::script('js/app.js') }}
</body>
</html>
