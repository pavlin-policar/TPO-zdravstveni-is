@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Vrste šifrantov</span>
        <div class="description">seznam vseh vrst šifrantov, ki nato vsebujejo šifrante</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">

                    <div class="card-title">
                        <div class="title">Table</div>
                        {!! link_to_route('codeTypes.getCreate', 'Dodaj vrsto šifranta', [], ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                <div class="card-body">
                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ime vrste šifranta</th>
                            <th>Opis vrste šifrante</th>
                            <th>Nazadnje spremenjen</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Ime vrste šifranta</th>
                            <th>Opis vrste šifrante</th>
                            <th>Nazadnje spremenjen</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($codeTypes as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{!! link_to_route('codeTypes.show', $item->name, ['id' => $item->id]) !!}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->updated_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection