@extends('pdf.base')

@section('content')
    <h3>Uporabniki</h3>
    <p>Seznam registriranih uporabnikov v sistemu.</p>

    <table class="datatable table table-striped" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Ime</th>
            <th>Priimek</th>
            <th>Elektronski naslov</th>
            <th>Tip uporabnika</th>
            <th>Registriran</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->type->name }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection