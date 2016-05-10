@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">{{ $code->name }}</span>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-body">
                    @if(!empty($code->description))
                        <h4>OPIS:</h4> {{ $code->description }} <br><br><br><br>
                    @endif
                    @if($manuals->count()!=0)
                        <h4>SEZNAM NAVODIL:</h4>
                            <table class="datatable table table-striped" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Ime</th>
                                    <th>Opis</th>
                                    <th>Povezava</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Ime</th>
                                    <th>Opis</th>
                                    <th>Povezava</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($manuals as $manual)
                                    <tr>
                                        <td>{{ $manual['name'] }}</td>
                                        <td>{{ $manual['description'] }}</td>
                                        <td>
                                            @if(!empty($manual['url_link']))
                                                <a href="{{$manual['url_link']}}" class="btn btn-primary form-control" target="_blank">VEČ</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <br><br><br><br>
                    @endif
                        @if($goodMedicals->count()!=0)
                            <h4>SEZNAM ZDRAVIL:</h4>
                            <table class="datatable table table-striped" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Ime</th>
                                    <th>Navodila</th>
                                    <th>Podrobnosti</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Ime</th>
                                    <th>Navodila</th>
                                    <th>Podrobnosti</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($goodMedicals as $goodMedical)
                                    <tr>
                                        <td>{{ $goodMedical['name'] }}</td>
                                        <td>@if(!empty($goodMedical['description']))
                                                <a href="{{$goodMedical['description']}}" class="btn btn-primary form-control" target="_blank">NAVODILA</a>
                                            @endif</td>
                                        <td>{!! link_to_route('code.publicDetail', 'PODROBNOSTI', ['code'=>$goodMedical], ['class' => 'btn btn-primary']) !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection