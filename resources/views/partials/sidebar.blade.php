<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('dashboard.show') }}">
                    <div class="icon fa fa-heartbeat"></div>
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
                    <a data-toggle="collapse" href="#dropdown-check">
                        <span class="icon fa fa-hospital-o"></span><span class="title">Pregledi</span>
                    </a>
                    <div id="dropdown-check" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li>
                                    {!! link_to_route('check.medical', 'Zdravila') !!}
                                </li>
                                <li>
                                    {!! link_to_route('dashboard.show', 'Meritve') !!}
                                </li>
                                <li>
                                    {!! link_to_route('check.disease', 'Bolezni in alergije') !!}
                                </li>
                                <li>
                                    {!! link_to_route('check.diet', 'Diete') !!}
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                @can('can-see-delegates', App\Models\User::class)
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
                @endcan
                @can('can-do-admin-stuff', App\Models\User::class)
                <li class="inactive">
                    <a href="{{ route('code.index') }}">
                        <span class="icon fa fa-database"></span><span class="title">Urejanje šifrantov</span>
                    </a>
                </li>
                <li class="inactive">
                    <a href="{{ route('users.index') }}">
                        <span class="icon fa fa-users"></span><span class="title">Urejanje uporabnikov</span>
                    </a>
                </li>
                <li class="inactive">
                    <a href="{{ route('medicalDiseases.list') }}">
                        <span class="icon fa fa-medkit"></span><span class="title">Urejanje zdravil za bolezni</span>
                    </a>
                </li>
                @endcan
                <li class="inactive">
                    <a href="{{ route('profile.show') }}">
                        <span class="icon glyphicon glyphicon-cog"></span><span class="title">Nastavitve</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div>