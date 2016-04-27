<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{ Html::style('vendor/css/bootstrap.min.css') }}
    <style>
        html {
            font-family: DejaVu Sans, sans-serif;
        }
        thead {
            border-bottom: 2px solid #ccc;
        }
        tbody {

        }
        tr {
        }
        th {}
        th, td {
            text-align: left;
            padding: .75rem .5rem;
            border-bottom: 1px solid #ebebeb;
        }
    </style>
</head>
<body>
<div id="title">
    <h1>
        Zdravstveni informacijski sistem
    </h1>
</div>
@yield('content')
</body>
</html>