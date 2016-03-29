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
                        @if(!empty($array))
                            @foreach($array as $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td><a href="codeType/{{ $item['id']  }}">{{ $item['codeItemName'] }}</a></td>
                                    <td>{{ $item['codeItemDescription'] }}</td>
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