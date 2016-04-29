<table class="datatable table table-striped" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Šifra</th>
        <th>Ime šifranta</th>
        <th>Opis šifrante</th>
        <th>Minimalna vrdnost</th>
        <th>Maksimalna vrdnost</th>
        <th>Nazadnje spremenjen</th>
        <th>Dodajanje navodil</th>
        <th>Izbris</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>ID</th>
        <th>Šifra</th>
        <th>Ime šifranta</th>
        <th>Opis šifrante</th>
        <th>Minimalna vrdnost</th>
        <th>Maksimalna vrdnost</th>
        <th>Nazadnje spremenjen</th>
        <th>Dodajanje navodil</th>
        <th>Izbris</th>
    </tr>
    </tfoot>
    <tbody>
    @foreach($codeType->codes as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['code'] }}</td>
            <td>{!! link_to_route('code.edit', $item['name'], ['id' => $item['id']]) !!}</td>
            <td>{{ $item['description'] }}</td>
            <td>{{ $item['min_value'] }}</td>
            <td>{{ $item['max_value'] }}</td>
            <td>{{ date('d.m.Y H:i', strtotime($item['updated_at'])) }}</td>
            <td>{!! link_to_route('code.addManuals', "Uredi navodila", ['code' => $item], ['class' => 'btn btn-primary form-control']) !!}</td>
            <td>
                {{ Form::open(['route' => ['code.deleteCode', $item['id'], 'extension' => null], 'method' => 'delete']) }}
                {!! Form::submit('Izbris', ['class' => 'btn btn-warning form-control']) !!}
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>