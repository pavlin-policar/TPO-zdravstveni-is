@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Šifranti vrste {{ $codeType  }}</span>
        <div class="description">seznam vseh šifrantov željene vrste</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">

                    <div class="card-title">
                        <div class="title">Table</div>
                        {!! link_to_route('code.getCreate', 'Dodaj šifrant', ['id' => $id ], ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('codeType.exportToPDF', 'Izvozi šifrante v PDF', ['id' => $id ], ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('code.index', 'Vrnite se nazaj', [], ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                <div class="card-body">
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
                </div>
            </div>
        </div>
    </div>
@endsection