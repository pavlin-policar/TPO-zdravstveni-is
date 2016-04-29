@extends('users.index-base')

@section('page-title', 'Pregled uporabnikov')
@section('page-description', 'Pregled uporabnikov, ki so registrirani v sistem.')

@section('table')
    <div class="sub-title">Filtriraj po datumih registracije.</div>
    {!! Form::open(['route' => 'users.index', 'method' => 'get', 'class' => 'form-inline']) !!}
    <div class="form-group">
        {!! Form::hidden('filter', 'new-users') !!}
        {!! Form::label('start-date', 'Od', []) !!}
        {!! Form::date('start-date', Request::query('start-date', ''), ['class' => 'form-control']) !!}
        {!! Form::label('end-date', 'do', []) !!}
        {!! Form::date('end-date', Request::query('end-date', ''), ['class' => 'form-control']) !!}
        {!! Form::submit('Išči', ['class' => 'btn btn-default']) !!}
    </div>
    {!! Form::close() !!}

    <br>
    <div class="sub-title">Rezultati</div>

    <table class="datatable table table-striped" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Ime</th>
            <th>Priimek</th>
            <th>Elektronski naslov</th>
            <th>Tip uporabnika</th>
            <th>Registriran</th>
            <th>Uredi</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Ime</th>
            <th>Priimek</th>
            <th>Elektronski naslov</th>
            <th>Tip uporabnika</th>
            <th>Registriran</th>
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
                <td>{{ $user->created_at }}</td>
                <td>{!! link_to_route('profile.show', 'Uredi profil', [$user->id]) !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection