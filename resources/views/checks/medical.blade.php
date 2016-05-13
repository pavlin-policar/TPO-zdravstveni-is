@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card red card-header">
                    <div class="card-title">
                        <div class="title title-white">Zdravila</div>
                    </div>
                    <div class="fa fa-compress icon-arrow-right" id="glyphicon-medical"></div>
                </div>
                <div class="card-body no-padding" id="dash-medical">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Zdravilo: </th>
                                <th>Začetek jemanja: </th>
                                <th>Konec jemanja: </th>
                                <th>Opombe: </th>
                                <th>Podatki o zdravilu: </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($x=0; $x < count($medicals); $x++)
                                <tr>
                                    <td>{{ $medicals[$x]->name }}</td>
                                    <td>{{ date("d.m.Y H:i",strtotime($medicals[$x]->start)) }}</td>
                                    @if($medicals[$x]->end == null)
                                        <td></td>
                                    @else
                                        <td>{{ date("d.m.Y H:i",strtotime($medicals[$x]->end)) }}</td>
                                    @endif
                                    <td>{{ $medicals[$x]->note }}</td>
                                    <td><a href ='{{ $medicals[$x]->description }}' target="_blank">{{ $medicals[$x]->description }}</a></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection