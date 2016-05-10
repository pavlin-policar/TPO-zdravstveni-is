@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">{{ $codeType->description }}</span>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-body">
                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Šifra</th>
                            <th>Ime</th>
                            <th>Opis</th>
                            <th>Podrobnosti</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Šifra</th>
                            <th>Ime</th>
                            <th>Opis</th>
                            <th>Podrobnosti</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($codeType->codes as $item)
                            <tr>
                                <td>{{ $item['code'] }}</td>
                                <td>{!! link_to_route('code.publicDetail', $item['name'], ['id' => $item['id']]) !!}</td>
                                <td>{{ $item['description'] }}</td>
                                <td>{!! link_to_route('code.publicDetail', "Podrobnosti", ['id' => $item['id']], ['class' => 'btn btn-primary form-control']) !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection