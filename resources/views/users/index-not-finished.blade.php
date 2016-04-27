@extends('users.index-base')

@section('page-title', 'Nedokončane registracije')
@section('page-description', 'Pregled uporabnikov, ki so še niso dokončali postopka registracije.')

@section('table')
    <table class="datatable table table-striped" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Elektronska pošta</th>
            <th>Tip</th>
            <th>Datum registracije</th>
            <th>Uredi</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Elektronska pošta</th>
            <th>Tip</th>
            <th>Datum registracije</th>
            <th>Uredi</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->type->name }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{!! link_to_route('profile.show', 'Uredi profil', [$user->id]) !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection