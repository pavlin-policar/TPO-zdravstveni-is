<table class="datatable table table-striped" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Šifra</th>
        <th>Meritev</th>
        <th>Opis meritve</th>
    </tr>
    </thead>
    @if(!isset($hideFoot))
    <tfoot>
    <tr>
        <th>ID</th>
        <th>Šifra</th>
        <th>Meritev</th>
        <th>Opis meritve</th>
    </tr>
    </tfoot>
    @endif
    <tbody>
    @foreach($array as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['code'] }}</td>
            <td>{!! link_to_route('measurementMeasurement.editList', $item['name'], ['code' => $item]) !!}</td>
            <td>{{ $item['description'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>