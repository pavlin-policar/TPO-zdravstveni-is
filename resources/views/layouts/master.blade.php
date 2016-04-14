@extends('layouts.base')

@section('body')
    <body class="flat-blue">
    <div class="app-container">
        <div class="row content-container">
            {{-- Bar on top --}}
            @include('partials.navbar')
            {{-- Bar to the side --}}
            @include('partials.sidebar')
            <div class="container-fluid">
                <div class="side-body">
                    @if(session('isMyProfile') === false && !empty(session('simpleUserData')))
                        <div class="list-group-item list-group-item-warning">
                            <div class="row">
                                <div class="col-md-8 col-sm-12">
                                    <h3>Nahajate se na profilu osebe
                                        <b>{{ session('simpleUserData')  }}</b></h3>
                                    <div class="description">
                                        Trenutno pregledujete profil svojega oskrbovanca!
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    {!! link_to_route('charges.activate', 'Vrnite se na svoj profil', ['id' => session('user') ], ['class' => 'btn btn-primary pull-right']) !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>
    </body>
@endsection