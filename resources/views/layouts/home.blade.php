<!DOCTYPE html>
<html>

<head>
    <title>TPO Zdravstveni IS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    {{ Html::style('http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400') }}
    {{ Html::style('http://fonts.googleapis.com/css?family=Lato:300,400,700,900') }}
    <!-- CSS Libs -->
    {{ Html::style('lib/css/bootstrap.min.css') }}
    {{ Html::style('lib/css/font-awesome.min.css') }}
    {{ Html::style('lib/css/animate.min.css') }}
    {{ Html::style('lib/css/bootstrap-switch.min.css') }}
    {{ Html::style('lib/css/checkbox3.min.css') }}
    {{ Html::style('lib/css/jquery.dataTables.min.css') }}
    {{ Html::style('lib/css/dataTables.bootstrap.css') }}
    {{ Html::style('lib/css/select2.min.css') }}
    <!-- CSS App -->
    {{ Html::style('css/style.css') }}
    {{ Html::style('css/themes/flat-blue.css') }}
</head>

<body class="flat-blue">
<div class="app-container">
    <div class="row content-container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-expand-toggle">
                        <i class="fa fa-bars icon"></i>
                    </button>
                    <ol class="breadcrumb navbar-breadcrumb">
                        <li class="active">Dashboard</li>
                    </ol>
                    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                        <i class="fa fa-th icon"></i>
                    </button>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                        <i class="fa fa-times icon"></i>
                    </button>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-comments-o"></i></a>
                        <ul class="dropdown-menu animated fadeInDown">
                            <li class="title">
                                Notification <span class="badge pull-right">0</span>
                            </li>
                            <li class="message">
                                No new notification
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown danger">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-star-half-o"></i>
                            4</a>
                        <ul class="dropdown-menu danger  animated fadeInDown">
                            <li class="title">
                                Notification <span class="badge pull-right">4</span>
                            </li>
                            <li>
                                <ul class="list-group notifications">
                                    <a href="#">
                                        <li class="list-group-item">
                                            <span class="badge">1</span>
                                            <i class="fa fa-exclamation-circle icon"></i> new
                                            registration
                                        </li>
                                    </a>
                                    <a href="#">
                                        <li class="list-group-item">
                                            <span class="badge success">1</span>
                                            <i class="fa fa-check icon"></i> new orders
                                        </li>
                                    </a>
                                    <a href="#">
                                        <li class="list-group-item">
                                            <span class="badge danger">2</span>
                                            <i class="fa fa-comments icon"></i> customers messages
                                        </li>
                                    </a>
                                    <a href="#">
                                        <li class="list-group-item message">
                                            view all
                                        </li>
                                    </a>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Emily
                            Hart <span class="caret"></span></a>
                        <ul class="dropdown-menu animated fadeInDown">
                            <li class="profile-img">
                                <img src="" class="profile-img">
                            </li>
                            <li>
                                <div class="profile-info">
                                    <h4 class="username">Emily Hart</h4>
                                    <p>emily_hart@email.com</p>
                                    <div class="btn-group margin-bottom-2x" role="group">
                                        <button type="button" class="btn btn-default">
                                            <i class="fa fa-user"></i> Profile
                                        </button>
                                        <button type="button" class="btn btn-default">
                                            <i class="fa fa-sign-out"></i> Logout
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="side-menu sidebar-inverse">
            <nav class="navbar navbar-default" role="navigation">
                <div class="side-menu-container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <div class="icon fa fa-paper-plane"></div>
                            <div class="title">TPO Zdravstveni IS</div>
                        </a>
                        <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
                    </div>

                    @yield('menu')

                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="index.html">
                                <span class="icon fa fa-tachometer"></span><span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="panel panel-default dropdown">
                            <a data-toggle="collapse" href="#dropdown-element">
                                <span class="icon fa fa-desktop"></span><span class="title">UI Kits</span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="dropdown-element" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="ui-kits/theming.html">Theming</a>
                                        </li>
                                        <li><a href="ui-kits/grid.html">Grid</a>
                                        </li>
                                        <li><a href="ui-kits/button.html">Buttons</a>
                                        </li>
                                        <li><a href="ui-kits/card.html">Cards</a>
                                        </li>
                                        <li><a href="ui-kits/list.html">Lists</a>
                                        </li>
                                        <li><a href="ui-kits/modal.html">Modals</a>
                                        </li>
                                        <li><a href="ui-kits/alert.html">Alerts & Toasts</a>
                                        </li>
                                        <li><a href="ui-kits/panel.html">Panels</a>
                                        </li>
                                        <li><a href="ui-kits/loader.html">Loaders</a>
                                        </li>
                                        <li><a href="ui-kits/step.html">Tabs & Steps</a>
                                        </li>
                                        <li><a href="ui-kits/other.html">Other</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
        </div>
        <!-- Main Content -->
        <div class="content">

            @yield('content')

        </div>
    </div>
    <footer class="app-footer">
        <div class="wrapper">
            <p> &copy; 2016 Copyright. </p>
        </div>
    </footer>
</div>
<!-- Javascript Libs -->
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
<!-- Javascript -->
{{ Html::script('js/app.js') }}
</body>

</html>
