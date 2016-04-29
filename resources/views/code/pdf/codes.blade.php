@extends('pdf.base')

@section('content')
  <h3>{{ $codeType->name }}</h3>
  <p>{{ $codeType->description }}</p>

  <table class="datatable table table-striped" cellspacing="0" width="100%">
    <thead>
    <tr>
      <th>ID</th>
      <th>Šifra</th>
      <th>Ime šifranta</th>
      <th>Opis šifrante</th>
      <th>Minimalna vrdnost</th>
      <th>Maksimalna vrdnost</th>
    </tr>
    </thead>
    <tbody>
    @foreach($codeType->codes as $code)
      <tr>
        <td>{{ $code['id'] }}</td>
        <td>{{ $code['code'] }}</td>
        <td>{{ $code['name'] }}</td>
        <td>{{ $code['description'] }}</td>
        <td>{{ $code['min_value'] }}</td>
        <td>{{ $code['max_value'] }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection