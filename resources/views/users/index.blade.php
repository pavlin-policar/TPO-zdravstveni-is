@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Pregled uporabnikov</span>
        <div class="description">Pregled uporabnikov, ki so registrirani v sistem.</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">
                            Pregled uporabnikov
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! link_to_route('users.create', 'Dodaj zdravnika/medicinsko sestro', ['type' => 'doctor'], ['class' => 'btn btn-primary']) !!}
                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Ime</th>
                            <th>Priimek</th>
                            <th>Mail</th>
                            <th>Type</th>
                            <th>Uredi</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Ime</th>
                            <th>Priimek</th>
                            <th>Mail</th>
                            <th>Type</th>
                            <th>Uredi</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->type->name }}</td>
                                <td>{!! link_to_route('profile.show', 'Uredi profil', [$user->id]) !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! link_to_route('users.create', 'Dodaj zdravnika/medicinsko sestro', ['type' => 'doctor'], ['class' => 'btn btn-primary']) !!}
                    <!-- {!! link_to_route('users.create', 'Dodaj pacienta', ['type' => 'patient'], ['class' => 'btn btn-default']) !!} -->
                </div>
            </div>
        </div>
    </div>
@endsection