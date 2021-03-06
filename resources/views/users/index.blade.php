@extends('users.index-base')

@section('page-title', 'Pregled uporabnikov')
@section('page-description', 'Pregled uporabnikov, ki so registrirani v sistem.')

@section('table')
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
@endsection