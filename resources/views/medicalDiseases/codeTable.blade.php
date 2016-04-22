<table class="datatable table table-striped" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Šifra</th>
        <th>Bolezen</th>
        <th>Opis bolezni</th>
    </tr>
    </thead>
    @if(!isset($hideFoot))
    <tfoot>
    <tr>
        <th>ID</th>
        <th>Šifra</th>
        <th>Bolezen</th>
        <th>Opis bolezni</th>
    </tr>
    </tfoot>
    @endif
    <tbody>
    @foreach($array as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['code'] }}</td>
            <td>{!! link_to_route('diseases.editList', $item['name'], ['code' => $item]) !!}</td>
            <td><a href="{{ $item['description'] }}" target="_blank">{{ $item['description'] }}</a></td>
        </tr>
    @endforeach
    </tbody>
</table>