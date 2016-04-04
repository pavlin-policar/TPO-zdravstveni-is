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
                        @if(!empty($array))
                            @foreach($array as $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{!! link_to_route('code.edit', $item['codeName'], ['id' => $item['id']]) !!}</td>
                                    <td>{{ $item['codeDescription'] }}</td>
                                    <td>{{ $item['minValue'] }}</td>
                                    <td>{{ $item['maxValue'] }}</td>
                                    <td>{{ $item['updated_at'] }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection