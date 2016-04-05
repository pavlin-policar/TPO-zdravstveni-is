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
                    <a href="{{ route('dashboard.show') }}">
                        <span class="icon fa fa-tachometer"></span><span class="title">Nadzorna plošča</span>
                    </a>
                </li>
                <li class="inactive">
                    <a href="{{ route('charges.index') }}">
                        <span class="icon fa-user-md"></span><span class="title">Oskrbljenci</span>
                    </a>
                </li>
                <li class="inactive">
                    <a href="{{ route('profile.show') }}">
                        <span class="icon glyphicon glyphicon-cog"></span><span class="title">Nastavitve</span>
                    </a>
                </li>
                <li class="inactive">
                    <a href="{{ route('code.index') }}">
                        <span class="icon glyphicon glyphicon-cog"></span><span class="title">Urejanje šifrantov</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div>