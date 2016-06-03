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
                <?php // forgive me Lord, for this atrocity ?>
                <?php
                    $route = Route::current()->getName();
                    $routeGroup = explode('.', $route)[0];
                ?>
                <li class="{{ $routeGroup == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.show') }}">
                        <span class="icon fa fa-tachometer"></span><span class="title">Nadzorna plošča</span>
                    </a>
                </li>
                <li class="panel panel-default dropdown {{ $routeGroup == 'check' || $routeGroup == 'calendar' ? 'active' : '' }}">
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
                                    {!! link_to_route('check.measurement', 'Meritve') !!}
                                </li>
                                <li>
                                    {!! link_to_route('check.disease', 'Bolezni in alergije') !!}
                                </li>
                                <li>
                                    {!! link_to_route('check.diet', 'Diete') !!}
                                </li>
                                <li>
                                    {!! link_to_route('calendar.user', 'Naročanje na preglede') !!}
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="{{ $routeGroup == 'measurement' ? 'active' : '' }}">
                    <a href="{{ route('measurement.add') }}">
                        <span class="icon fa fa-stethoscope"></span><span class="title">Dodaj meritev</span>
                    </a>
                </li>
                @can('can-see-delegates', App\Models\User::class)
                <li class="panel panel-default dropdown {{ $routeGroup == 'charges' ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#dropdown-charges">
                        <span class="icon fa fa-user-md"></span><span class="title">Oskrbovanci</span>
                    </a>
                    <div id="dropdown-charges" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li>
                                    {!! link_to_route('charges.index', 'Pregled oskrbovancev') !!}
                                </li>
                                <hr>
                                @foreach($user->charges as $charge)
                                    <li>
                                        {!! link_to_route('charges.show', $charge->fullName, [$charge->id]) !!}
                                    </li>
                                @endforeach
                                <li>
                                    {!! link_to_route('charges.create', 'Dodaj oskrbovanca') !!}
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                @endcan
                @can('can-do-admin-stuff', App\Models\User::class)
                <li class="{{ $routeGroup == 'code' && strpos($route, 'specialList') === false && strpos($route, 'publicDetail') === false ? 'active' : '' }}">
                    <a href="{{ route('code.index') }}">
                        <span class="icon fa fa-database"></span><span class="title">Urejanje šifrantov</span>
                    </a>
                </li>
                <li class="{{ $routeGroup == 'users' ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}">
                        <span class="icon fa fa-users"></span><span class="title">Urejanje uporabnikov</span>
                    </a>
                </li>
                <li class="{{ $routeGroup == 'measurementMeasurement' ? 'active' : '' }}">
                    <a href="{{ route('measurementMeasurement.list') }}">
                        <span class="icon fa fa-wrench"></span><span class="title">Urejanje pod meritev</span>
                    </a>
                </li>
                <li class="{{ $routeGroup == 'medicalDiseases' ? 'active' : '' }}">
                    <a href="{{ route('medicalDiseases.list') }}">
                        <span class="icon fa fa-medkit"></span><span class="title">Urejanje zdravil za bolezni</span>
                    </a>
                </li>
                <li class="{{ $routeGroup == 'manuals' ? 'active' : '' }}">
                    <a href="{{ route('manuals.list') }}">
                        <span class="icon fa fa-book"></span><span class="title">Urejanje člankov in navodil</span>
                    </a>
                </li>
                @endcan
                <li class="{{ $routeGroup == 'profile' ? 'active' : '' }}">
                    <a href="{{ route('profile.show', session('showUser') === null ? $user->id : session('showUser')) }}">
                        <span class="icon glyphicon glyphicon-cog"></span><span class="title">Nastavitve</span>
                    </a>
                </li>
                <li class="panel panel-default dropdown {{ strpos($route, 'specialList') !== false || strpos($route, 'publicDetail') !== false ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#dropdown-info">
                        <span class="icon fa fa-info-circle"></span><span class="title">Informacije</span>
                    </a>
                    <div id="dropdown-info" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li>
                                    {!! link_to_route('code.specialList', 'Informacije o boleznih',13) !!}
                                </li>
                                <li>
                                    {!! link_to_route('code.specialList', 'Informacije o zdravilih',14) !!}
                                </li>
                                <li>
                                    {!! link_to_route('code.specialList', 'Informacije o dietah',12) !!}
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