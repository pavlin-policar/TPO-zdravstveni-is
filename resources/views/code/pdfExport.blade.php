<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
{{ Html::style('vendor/css/animate.min.css') }}
{{ Html::style('vendor/css/bootstrap-switch.min.css') }}
{{ Html::style('vendor/css/checkbox3.min.css') }}
{{ Html::style('vendor/css/jquery.dataTables.min.css') }}
{{ Html::style('vendor/css/dataTables.bootstrap.css') }}
{{ Html::style('vendor/css/select2.min.css') }}
{{-- App stylesheets --}}
{{ Html::style('css/style.css') }}
{{ Html::style('css/themes/flat-blue.css') }}
<h1>Šifranti vrste {{ $codeType  }}</h1>
<br>
@include('code.codeTable')