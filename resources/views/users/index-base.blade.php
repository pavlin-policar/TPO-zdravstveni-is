@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">@yield('page-title')</span>
        <div class="description">@yield('page-description')</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">
                            @yield('page-title')
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! link_to_route('users.index', 'Vsi uporabniki', [], ['class' => 'btn btn-default']) !!}
                    {!! link_to_route('users.index', 'Nedokončane registracije', ['extension' => null, 'filter' => 'not-finished'], ['class' => 'btn btn-default']) !!}

                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Izvozi... <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li>{!! link_to_route('users.index', 'JSON', ['extension' => '.json', 'filter' => $filter]) !!}</li>
                            <li>{!! link_to_route('users.index', 'PDF', ['extension' => '.pdf', 'filter' => $filter]) !!}</li>
                        </ul>
                    </div>
                    <br>
                    {!! link_to_route('users.create', 'Dodaj zdravnika/medicinsko sestro', ['type' => 'doctor'], ['class' => 'btn btn-primary']) !!}
                    @yield('table')
                    {!! link_to_route('users.create', 'Dodaj zdravnika/medicinsko sestro', ['type' => 'doctor'], ['class' => 'btn btn-primary']) !!}
                        <!-- {!! link_to_route('users.create', 'Dodaj pacienta', ['type' => 'patient'], ['class' => 'btn btn-default']) !!} -->
                </div>
            </div>
        </div>
    </div>
@endsection