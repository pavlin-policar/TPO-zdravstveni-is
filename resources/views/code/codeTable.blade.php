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
        @if(!isset($hideFoot))
            <th>Izbris</th>
        @endif
    </tr>
    </thead>
    @if(!isset($hideFoot))
    <tfoot>
    <tr>
        <th>ID</th>
        <th>Šifra</th>
        <th>Ime šifranta</th>
        <th>Opis šifrante</th>
        <th>Minimalna vrdnost</th>
        <th>Maksimalna vrdnost</th>
        <th>Nazadnje spremenjen</th>
        <th>Izbris</th>
    </tr>
    </tfoot>
    @endif
    <tbody>
    @foreach($array as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['code'] }}</td>
            <td>{!! link_to_route('code.edit', $item['name'], ['id' => $item['id']]) !!}</td>
            <td>{{ $item['description'] }}</td>
            <td>{{ $item['min_value'] }}</td>
            <td>{{ $item['max_value'] }}</td>
            <td>{{ $item['updated_at'] }}</td>
            @if(!isset($hideFoot))
                <td>
                    {{ Form::open(['route' => ['code.deleteCode', $item['id']], 'method' => 'delete']) }}
                    {!! Form::submit('Izbris', ['class' => 'btn btn-warning form-control']) !!}
                    {{ Form::close() }}
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>