@extends('pdf.base')

@section('content')
    <h3>Izbrisani uporabniki</h3>
    <p>Seznam izbrisanih uporabnikov.</p>

    <table class="datatable table table-striped" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Ime</th>
            <th>Priimek</th>
            <th>Mail</th>
            <th>Type</th>
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
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection