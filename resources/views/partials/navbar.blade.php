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
            {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-comments-o"></i></a>--}}
                {{--<ul class="dropdown-menu animated fadeInDown">--}}
                    {{--<li class="title">--}}
                        {{--Notification <span class="badge pull-right">0</span>--}}
                    {{--</li>--}}
                    {{--<li class="message">--}}
                        {{--No new notification--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="dropdown danger">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-star-half-o"></i>--}}
                    {{--4</a>--}}
                {{--<ul class="dropdown-menu danger  animated fadeInDown">--}}
                    {{--<li class="title">--}}
                        {{--Notification <span class="badge pull-right">4</span>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<ul class="list-group notifications">--}}
                            {{--<a href="#">--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<span class="badge">1</span>--}}
                                    {{--<i class="fa fa-exclamation-circle icon"></i> new--}}
                                    {{--registration--}}
                                {{--</li>--}}
                            {{--</a>--}}
                            {{--<a href="#">--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<span class="badge success">1</span>--}}
                                    {{--<i class="fa fa-check icon"></i> new orders--}}
                                {{--</li>--}}
                            {{--</a>--}}
                            {{--<a href="#">--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<span class="badge danger">2</span>--}}
                                    {{--<i class="fa fa-comments icon"></i> customers messages--}}
                                {{--</li>--}}
                            {{--</a>--}}
                            {{--<a href="#">--}}
                                {{--<li class="list-group-item message">--}}
                                    {{--view all--}}
                                {{--</li>--}}
                            {{--</a>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ $user->firstName }} <span class="caret"></span></a>
                <ul class="dropdown-menu animated fadeInDown">
                    <li class="profile-img">
                        <img src="http://funnne.com/w-img/user.jpg" class="profile-img">
                    </li>
                    <li>
                        <div class="profile-info">
                            <h4 class="username">{{ $user->fullName }}</h4>
                            <p>{{  $user->email }}</p>
                            <p>Zadnja prijava {{ $user->last_login->format('d.m.Y H:i:s') }}</p>
                            <div class="btn-group margin-bottom-2x" role="group">
                                <a type="button" class="btn btn-info" href="{{ route('profile.show', $user->id) }}">
                                    <i class="fa fa-user"></i> Profile
                                </a>
                                <a type="button" href="{{ url('/logout') }}" class="btn btn-danger">
                                    <i class="fa fa-sign-out"></i> Logout
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>