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
                    <a href="{{ url('/dashboard') }}">
                        <span class="icon fa fa-tachometer"></span><span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="inactive">
                    <a data-toggle="collapse" href="{{ url('/profile', $user->id) }}">
                        <span class="icon glyphicon glyphicon-cog"></span><span class="title">Settings</span>
                    </a>
                </li>
                <li class="inactive">
                    <a href="{{ url('/code-types') }}">
                        <span class="icon glyphicon glyphicon-cog"></span><span class="title">Urejanje šifrantov</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div>