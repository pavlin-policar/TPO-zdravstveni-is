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