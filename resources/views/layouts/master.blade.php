<!DOCTYPE html>
<html>
<head>
    <title>TPO Zdravstveni IS</title>
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

<body class="flat-blue">
<div class="app-container">
    <div class="row content-container">
        {{-- Bar on top --}}
        @include('partials.navbar')
        {{-- Bar to the side --}}
        @include('partials.sidebar')
        <div class="container-fluid">
            <div class="side-body">
                @if(!session('isMyProfile'))
                    <div class="list-group-item list-group-item-warning">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <h3>Nahajate se na profilu osebe <b>{{ session('simpleUserData')  }}</b></h3>
                                <div class="description">
                                    Trenutno pregledujete profil svojega oskrbovanca!
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                {!! link_to_route('charges.activate', 'Vrnite se na svoj profil', ['id' => session('user') ], ['class' => 'btn btn-primary pull-right']) !!}
                            </div>
                        </div>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    @include('partials.footer')
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
</body>
</html>
