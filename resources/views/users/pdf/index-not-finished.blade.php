@extends('pdf.base')

@section('content')
    <h3>Nedokončane registracije</h3>
    <p>Seznam nedokončanih registracij.</p>

    <table class="datatable table table-striped" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Elektronska pošta</th>
            <th>Tip</th>
            <th>Datum registracije</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->type->name }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection