<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('dashboard.show') }}">
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
                <li class="panel panel-default dropdown">
                    <a data-toggle="collapse" href="#dropdown-charges">
                        <span class="icon fa fa-user-md"></span><span class="title">Oskrbljenci</span>
                    </a>
                    <div id="dropdown-charges" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li>
                                    {!! link_to_route('charges.index', 'Pregled oskrbljencev') !!}
                                </li>
                                <hr>
                                @foreach($user->charges as $charge)
                                    <li>
                                        {!! link_to_route('charges.show', $charge->fullName, [$charge->id]) !!}
                                    </li>
                                @endforeach
                                <li>
                                    {!! link_to_route('charges.create', 'Dodaj oskrbljenca') !!}
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="inactive">
                    <a href="{{ route('profile.show') }}">
                        <span class="icon glyphicon glyphicon-cog"></span><span class="title">Nastavitve</span>
                    </a>
                </li>
                @if($user->isAdmin())
                <li class="inactive">
                    <a href="{{ route('code.index') }}">
                        <span class="icon glyphicon glyphicon-cog"></span><span class="title">Urejanje šifrantov</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div>