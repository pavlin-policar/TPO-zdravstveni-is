<table class="datatable table table-striped" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Ime šifranta</th>
        <th>Opis šifrante</th>
        <th>Minimalna vrdnost</th>
        <th>Maksimalna vrdnost</th>
        <th>Nazadnje spremenjen</th>
    </tr>
    </thead>
    @if(!isset($hideFoot))
    <tfoot>
    <tr>
        <th>ID</th>
        <th>Ime šifranta</th>
        <th>Opis šifrante</th>
        <th>Minimalna vrdnost</th>
        <th>Maksimalna vrdnost</th>
        <th>Nazadnje spremenjen</th>
    </tr>
    </tfoot>
    @endif
    <tbody>
    @foreach($array as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{!! link_to_route('code.edit', $item['name'], ['id' => $item['id']]) !!}</td>
            <td>{{ $item['description'] }}</td>
            <td>{{ $item['min_value'] }}</td>
            <td>{{ $item['max_value'] }}</td>
            <td>{{ $item['updated_at'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>