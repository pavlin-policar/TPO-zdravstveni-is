@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Seznam navodil in člankov</span>
        <div class="description">seznam vseh navodil in člankov o boleznih, zdravilih in dietah</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">

                    <div class="card-title">
                        {!! link_to_route('manuals.getCreate', 'Dodaj navodila oziroma članek', [], ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                <div class="card-body">
                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ime</th>
                            <th>Opis</th>
                            <th>URL</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Ime</th>
                            <th>Opis</th>
                            <th>URL</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($manuals as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{!! link_to_route('manuals.edit', $item->name, ['id' => $item->id]) !!}</td>
                                <td>{{ $item->description }}</td>
                                <td><a href="{{ $item->url_link }}">{{ $item->url_link }}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection